<?php

/*
	Plugin Name: QList iframe Plugin
	Plugin URI:
	Plugin Description: Question List for iframe
	Plugin Version: 1.0
	Plugin Date: 2016-09-15
	Plugin Author: 38qa.net
	Plugin Author URI: http://38qa.net/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.7
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

// page
qa_register_plugin_module('page', 'qa-qlist-iframe-page.php', 'qa_qlist_iframe_page', 'QList iframe Page');
// layer
qa_register_plugin_layer('qa-qlist-iframe-layer.php','QList iframe Layer');
