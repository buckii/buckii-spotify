<?php
/**
 * Main application class for interfacing with Spotify
 * @package Buckii Spotify
 * @author Buckeye Interactive
 */
class Buckii_Spotify {

  /**
   * @param str Absolute server path to the Spotify Control script file
   */
  protected $spotify_control;

  /**
   * Class constructor
   */
  public function __construct() {
    $this->spotify_control = ABSPATH . '/lib/SpotifyControl/SpotifyControl.scpt';

    set_exception_handler( array( &$this, 'error' ) );
  }

  /**
   * Check application requirements and return an array of results
   * @return array
   */
  public function check_requirements() {
    $messages = array();

    // Do we have Spotify Control?
    if ( ! $this->check_spotify_controller() ) {
      $messages[] = array(
        'class' => 'error',
        'message' => 'Could not detect Spotify Control. <pre><code>$ cd ' . ABSPATH
          . PHP_EOL . '$ git submodule init && git submodule update</code></pre>'
      );
    }

    return $messages;
  }

  /**
   * Ensure that the Spotify Controller application is present
   * @return bool
   */
  public function check_spotify_controller() {
    return (boolean) $this->exec( 'info' );
  }

  /**
   * Display an error message
   * @param Exception $e
   * @return void
   */
  public function error( Exception $e ) {
    printf( '<p class="message error">%s</p>', $e->getMessage() );
    return;
  }

  /**
   * Execute a shell command on the local server
   * @param str $cmd The shell command to execute
   * @return mixed
   */
  public function exec( $cmd='' ) {
    $cmd = sprintf( 'osascript %s %s', $this->spotify_control, escapeshellcmd( $cmd ) );
    $response;

    try {
      $response = shell_exec( $cmd );
    } catch ( Exception $e ) {
      throw new Exception( sprintf( 'Error while running `%s`: %s', $cmd, $e->getMessage() ) );
    }

    return $response;
  }

  /**
   * Return information about the current track
   * @return array
   */
  public function get_track_info() {
    $info = $this->exec( 'info' );
    $regex = array(
      'artist' => 'Artist',
      'track' => 'Track',
      'album' => 'Album',
      'duration' => 'Duration',
      'status' => 'Player'
    );
    $data = array();
    foreach ( $regex as $key=>$pattern ) {
      $data[ $key ] = ( preg_match( sprintf( '/%s:\s+(.+)/', $pattern ), $info, $match ) ? $match['1'] : '' );
    }

    // Just return the formatted time for duration
    $data['duration'] = preg_replace( '/\s\(.+$/', '', $data['duration'] );

    // Clean up the data
    $data = array_map( 'trim', $data );
    return $data;
  }

}