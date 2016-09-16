<?php

class qa_qlist_iframe_page {

	var $directory;
	var $urltoroot;


	function load_module($directory, $urltoroot)
	{
		$this->directory=$directory;
		$this->urltoroot=$urltoroot;
	}


	function suggest_requests() // for display in admin interface
	{
		return array(
			array(
				'title' => 'QList iframe',
				'request' => 'iframe',
				'nav' => 'none', // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
			),
		);
	}


	function match_request($request)
	{
		$requestparts = qa_request_parts();

		return ( !empty( $requestparts )
			&& @$requestparts[0] === 'iframe'
			&& @$requestparts[1] === 'list'
			&& !empty( $requestparts[2] )
		);
	}


	function process_request($request)
	{
		$tag = qa_request_part(2);

		if ( !strlen( $tag ) ) {
			return include QA_INCLUDE_DIR . 'qa-page-not-found.php';
		}

		qa_set_template( 'iframe' );

		return require QA_PLUGIN_DIR . '/q2a-qlist-iframe/list.php';
	}

}


/*
	Omit PHP closing tag to help avoid accidental output
*/
