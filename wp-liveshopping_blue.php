<?php
/*
Plugin Name: Live-Shopping Blue
Description: This new blue widget enables you to display all relevant live shopping offers (guut, schutzgeld, preisbock, ibood) within your Wordpress blog in one single widget.
Author: liveshoppingwidgets.de
Version: 1.1
Plugin URI: http://www.liveshoppingwidgets.de/2008/10/15/blue-wordpress-live-shopping-widget-in-blau/
Author URI: http://www.liveshoppingwidgets.de/
*/

/*
    Copyright 2009 liveshoppingwidgets.de

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function widget_liveshoppingblue_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	if ( !function_exists('htmlspecialchars_decode') ){
	    function htmlspecialchars_decode($text){
	        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
	    }
	}

	if (!function_exists('attribute_escape')){
		function attribute_escape($text) {
			$safe_text = wp_specialchars($text, true);
			return apply_filters('attribute_escape', $safe_text, $text);
		}
	}

	class liveshoppingbluewidget
	{

		function display_widget( $args ){
			extract( $args );
			echo $before_widget;
			echo $before_title . 'Live-Shopping' . $after_title;

			//content hier rein <----
			echo '<br /><iframe style="width: 200px; height: 433px; margin: 0px; border: 0px none; overflow: hidden;" src="http://widget.liveshoppingwidgets.de/content.php?t=1&f=2" scrolling="no" frameborder="0" framespacing="0" ></iframe><br /><div style="font-size:9px;">powered by <a href="http://www.liveshoppingwidgets.de/">liveshoppingwidgets.de</a></div><br />';
			//content ende <----

			echo $after_widget;
		}

	}

	function widget_liveshoppingblue( $args ){
		global $liveshoppingbluewidget;
		$liveshoppingbluewidget->display_widget( $args );
	}

	function widget_liveshoppingblue_register() {
		global $wp_version;
		$name = 'Live-Shopping Blue';
		if ( '2.2' == $wp_version ){
			register_sidebar_widget($name, 'widget_liveshoppingblue', '', 1);
		}elseif ( function_exists( 'wp_register_sidebar_widget' ) ){
			$id = "liveshoppingblue-$i";
			$dims = array('width' => 700, 'height' => 580);
			$class = array( 'classname' => 'widget_liveshoppingblue' );
			$name = __('Live-Shopping Blue');
			wp_register_sidebar_widget($id, $name, 'widget_liveshoppingblue', $class, 1);
		}else{
			register_sidebar_widget($name, 'widget_liveshoppingblue', 1);
		}
	
	}

	$GLOBALS['liveshoppingbluewidget'] = new liveshoppingbluewidget();
	widget_liveshoppingblue_register();

}

add_action('widgets_init', 'widget_liveshoppingblue_init');

?>