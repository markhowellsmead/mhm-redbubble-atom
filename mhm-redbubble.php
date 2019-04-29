<?php
/*
Plugin Name: Redbubble via API
Plugin URI: #
Description: #
Author: Mark Howells-Mead
Version: 0.0.1
Author URI: https://sayhello.ch/
*/

namespace MarkHowellsMead;

add_shortcode('redbubble', function($atts){

	require_once('src/AtomParser/AtomParser.php');

	$url = "https://www.redbubble.com/people/mhowellsmead/portfolio.atom";

	$parser = new AtomParser($url);

	return $parser->getFrom($url);

});
