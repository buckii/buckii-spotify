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
<link href="css/generated/style.css" type="text/css" rel="stylesheet" media="all" />
</head>
<body>
  <div id="wrapper" role="application">

    <div id="now-playing" class="loading">
      <h1>Now Playing:</h1>
      <p>
        <span id="track-title"></span>
        <span id="track-artist"></span>
        <span id="track-album"></span>
      </p>
      <div class="loading-indicator">Loading track information</div>
    </div>

    <ul id="controls">
      <li><a href="#" id="prev-track" role="button" data-command="previous">Previous</a></li>
      <li class="play"><a href="#" id="play-pause" role="button" data-command="play/pause">Play/Pause</a></li>
      <li><a href="#" id="next-track" role="button" data-command="next">Next</a></li>
      <li><a href="#" id="shuffle" role="button" data-command="shuffle">Shuffle</a></li>
      <li><a href="#" id="repeat" role="button" data-command="repeat">Repeat</a></li>
      <li class="volume"><input name="volume" id="volume" type="range" min="0" max="100" step="1" /></li>
    </ul><!-- #controls -->

  </div><!-- #wrapper -->
<script type="text/javascript" src="js/jquery.min.js?v=2.0.3"></script>
<script type="text/javascript" src="js/bii-spotify.js"></script>
</body>
</html>