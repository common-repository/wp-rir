<?php

/*
Plugin Name: wp-Rir
Plugin URI: http://neo22s.com/wp-rir
Description: Uses the service from http://rir.li to prevent you to do image hotlinking.
Version: 0.1
Author: Chema Garrido Díaz
Author URI: http://neo22s.com
*/

function wprir($text) {
	$file_pattern = '/([\[|<]rir[\]|>](.*?)[\[|<]\/rir[\]|>])/i';
	if (preg_match_all ($file_pattern, $text, $matches)) {
		for ($i = 0; $i < count($matches[0]); $i++) {
			$url_img = $matches[2][$i];
			$htmlcode = '<img src="http://rir.li/'.$url_img.'" alt="'.basename($url_img).'" title="'.basename($url_img).'" />';
			$text = str_replace($matches[0][$i], $htmlcode, $text);
		}
	}
	return $text;
}
add_filter('the_content', 'wprir', 1);
?>
