<?php
/**
 * Main view and application controller
 * @package Buckii Spotify
 * @author Buckeye Interactive
 */

define( 'ABSPATH', dirname( __FILE__ ) );
require_once ABSPATH . '/app/application.php';
$spotify = new Buckii_Spotify;

if ( isset( $_POST['action'] ) ) {
  $action = $_POST['action'];
  if ( $action == 'info' ) {
    die( json_encode( $spotify->get_track_info() ) );

  } else {
    die( json_encode( $spotify->exec( $action ) ) );
  }
}

?><!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buckii Spotify</title>
</head>
<body>
  <div id="wrapper">
    <h1>Buckii Spotify</h1>

  <?php if ( $requirements = $spotify->check_requirements ) : ?>
    <h2>Check requirements</h2>
    <ol id="requirement-check">
    <?php foreach ( $requirements as $msg ) : ?>
      <li class="<?php echo $msg['class']; ?>"><?php echo $msg['message']; ?></li>
    <?php endforeach; ?>
    </ol>
  <?php endif; ?>

  </div>
</body>
</html>