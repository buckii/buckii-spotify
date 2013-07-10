/**
 * Spotify scripting
 * @package Buckii Spotify
 * @author Buckeye Interactive
 */

/**
 * Our Spotify "model" for interfacing with the server-side application
 */
var Spotify = function () {
  "use strict";

  var $ = jQuery,

  /**
   * Send a command to Spotify
   * @param str cmd The command to pass
   * @return str The stdout response
   */
  sendCommand = function ( cmd ) {
    var response;

    $.ajax({
      url: 'index.php',
      type: 'post',
      data: {
        action: cmd
      },
      async: false,
      dataType: 'json',
      success: function ( ajaxresponse ) {
        response = ajaxresponse;
      },
    });
    return response;
  },

  loadTrackData = function () {
    var nowPlaying = $('#now-playing'),
    track;

    nowPlaying.addClass( 'loading' );
    if ( track = this.sendCommand( 'info' ) ) {
      $('#track-title').text( track.track );
      $('#track-artist').html( track.artist );
      $('#track-album').html( track.album );
      nowPlaying.removeClass( 'loading' );
    }
    return true;
  };

  /**
   * Reveal public methods
   */
  return {
    sendCommand: sendCommand,
    loadTrackData: loadTrackData
  }
};

/** Scripts to run on page load */
jQuery( function ( $ ) {
  "use strict";

  // Swap out the js hook on <html>
  $('html').removeClass( 'no-js' ).addClass( 'js' );

  // Instantiate our Spotify controller
  var spotify = new Spotify;
  $('#controls').on( 'click', 'a:not(.disabled)', function ( e ) {
    var btn = $( this );
    e.preventDefault();
    if ( btn.data( 'command' ) ) {
      spotify.sendCommand( btn.data( 'command' ) );
    }
  });

  // Load the current track information
  spotify.loadTrackData();
});