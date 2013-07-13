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
  currentTrack,
  pollInterval,
  volumeTimeout,

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
        if ( cmd !== 'info' ) {
          loadTrackData();
        }
      },
    });
    return response;
  },

  loadTrackData = function () {
    var nowPlaying = $('#now-playing'),
    buttons = {
      shuffle: $('#shuffle'),
      repeat: $('#repeat'),
      volume: $('#volume')
    },
    track = sendCommand( 'info' );

    // Track info
    if ( track && ( ! currentTrack || track.track !== currentTrack.track ) ) {
      nowPlaying.addClass( 'loading' );
      $('#track-title').html( track.track );
      $('#track-artist').html( track.artist );
      $('#track-album').html( track.album );
      currentTrack = track;
      nowPlaying.removeClass( 'loading' );
    }

    // Status
    buttons.shuffle.toggleClass( 'active', Boolean( track.shuffle ) );
    buttons.repeat.toggleClass( 'active', Boolean( track.repeat ) );
    buttons.volume.val( track.volume );

    return true;
  },

  /**
   * Start or stop polling for track changes
   * @param bool start Should we be polling?
   * @param int frequency Number of milliseconds between polls
   * @return bool
   */
  polling = function ( start, frequency ) {
    if ( start ) {
      this.pollInterval = window.setInterval( loadTrackData, frequency || 5000 );
    } else {
      window.clearInterval( this.pollInterval );
    }
    return ( start );
  };

  /**
   * Reveal public methods
   */
  return {
    sendCommand: sendCommand,
    loadTrackData: loadTrackData,
    polling: polling,
    volumeTimeout: volumeTimeout
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

  // Volume slider
  $('#volume').on( 'change', function () {
    var vol = $(this);
    clearTimeout( spotify.volumeTimeout );
    spotify.volumeTimeout = setTimeout( function () {
      spotify.sendCommand( 'volume ' + vol.val() );
    }, 300 );
  });

  // Keyboard controls
  $( document ).on( 'keydown', function ( e ) {
    var keycodes = {
      32: 'play/pause', // Spacebar
      37: 'previous', // Left
      39: 'next' // Right
    }
    if ( keycodes[ e.keyCode ] ) {
      spotify.sendCommand( keycodes[ e.keyCode ] );
    }
  });

  // Load the current track information
  spotify.loadTrackData(); // This will open Spotify if it's not already open...
  spotify.polling( true, 5000 );
});