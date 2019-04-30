<?php
/*
Plugin Name: Redbubble via API
Plugin URI: https://github.com/markhowellsmead/mhm-redbubble-atom/
Description: A WordPress plugin to load, parse and display Redbubble products from a valid, public Atom feed.
Author: Mark Howells-Mead
Version: 0.0.1
Author URI: https://sayhello.ch/
*/

namespace MarkHowellsMead;

add_shortcode('redbubble', function ($atts) {

	require_once('src/AtomParser/AtomParser.php');

	$url = "https://www.redbubble.com/people/mhowellsmead/portfolio.atom";

	$parser = new AtomParser($url);

	return $parser->getFrom($url);
});
