<?php

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../');
		exit;
	}

	require_once QA_INCLUDE_DIR.'db/selects.php';
	require_once QA_INCLUDE_DIR.'app/format.php';
	require_once QA_INCLUDE_DIR.'app/updates.php';
	require_once QA_INCLUDE_DIR.'util/string.php';

	$tag = qa_request_part(2); // picked up from qa-page.php
	$userid = null;

//	Find the questions with this tag

	$selectspec=qa_db_posts_basic_selectspec($userid, false);

	// use two tests here - one which can use the index, and the other which narrows it down exactly - then limit to 1 just in case
	$selectspec['source'] .= " JOIN (SELECT postid FROM ^posttags WHERE wordid=(SELECT wordid FROM ^words WHERE word=$ AND word=$ COLLATE utf8_bin LIMIT 1) ORDER BY postcreated DESC) y ON ^posts.postid=y.postid";
	$selectspec['source'] .= " WHERE ^posts.acount >= 1";
	array_push($selectspec['arguments'], $tag, qa_strtolower($tag));
	$selectspec['sortdesc']='created';

	// $selectspec = qa_db_tag_recent_qs_selectspec($userid, $tag, 0, false, 5);
	$questions = qa_db_select_with_pending( $selectspec );
	$questions = array_slice($questions, 0, 5);
	// error_log('questions selectspec: ' . serialize($selectspec));
	$usershtml = qa_userids_handles_html($questions);

//	Prepare content for theme

	$qa_content = qa_content_prepare(true);

	// $qa_content['title'] = qa_lang_html_sub('main/questions_tagged_x', qa_html($tag));

	if (!count($questions)) {
		$qa_content['q_list']['title'] = qa_lang_html('main/no_questions_found');
	}

	$qa_content['q_list']['qs'] = array();
	foreach ($questions as $postid => $question) {
		$qa_content['q_list']['qs'][] = qa_post_html_fields($question, $userid, qa_cookie_get(), $usershtml, null, qa_post_html_options($question));
	}

	return $qa_content;


/*
	Omit PHP closing tag to help avoid accidental output
*/
