# Buckii Spotify

Recently we've been using [a shared Spotify playlist](spotify:user:1262854537:playlist:6z7cRWdFJUHrmSlijrrh2V) in the office so each team member can contribute to the office soundtrack. Right now we're running Spotify on a Mac Mini in the office, connected to a bluetooth speaker. So far the setup is working well *except* when we need to quickly pause the music.

Those of us with SSH access to the Mini have been using [Spotify Control](https://github.com/dronir/SpotifyControl) to play or pause the music as needed (phone calls, client visits, etc.) but that requires that you have an open tunnel to the Mini; ain't nobody got time for that!

Buckii Spotify lets us control Spotify on the Mini through a web interface flexible enough to be installed on our phones (by saving the bookmark to the home screen).

## Installation

Clone this repository into a directory that's being served by Apache on the Spotify machine, then download Spotify Control into the lib/ directory by running:

```bash
$ git submodule init && git submodule update
```

Launch index.php and follow the setup steps.

**Note:** This whole thing works best when the target machine has a static IP address.