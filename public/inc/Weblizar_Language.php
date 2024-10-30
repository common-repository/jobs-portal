<?php

defined( 'ABSPATH' ) || die();

class Weblizar_Language {

	public static function load_translation() {
		 load_plugin_textdomain( WEBLIZAR_DOMAIN, false, basename( WEBLIZAR_PLUGIN_DIR_PATH ) . '/languages' );
	}
}
