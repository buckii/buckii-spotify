<?php
/**
 * Spotify remote
 * @package Buckii Spotify
 * @author Buckeye Interactive
 */
?><!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buckii Spotify</title>
</head>
<body>
  <div id="wrapper" role="application">

    <div id="now-playing">
      <h1>Now Playing</h1>
      <p>
        <span id="track-title"></span>
        <span id="track-artist"></span>
        <span id="track-album"></span>
      </p>
    </div>

    <ul id="controls">
      <li><a href="#" id="prev-track" role="button" data-command="previous">Previous</a></li>
      <li><a href="#" id="play-pause" role="button" data-command="play/pause">Play/Pause</a></li>
      <li><a href="#" id="next-track" role="button" data-command="next">Next</a></li>
    </ul><!-- #controls -->

  </div><!-- #wrapper -->
<script type="text/javascript" src="js/jquery.min.js?v=2.0.3"></script>
<script type="text/javascript" src="js/bii-spotify.js"></script>
</body>
</html>