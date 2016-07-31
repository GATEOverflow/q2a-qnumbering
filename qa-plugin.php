<?php



if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_layer('qa-qnumbering-layer.php', 'Question Numbering');
qa_register_plugin_module('module', 'qa-qnumbering-admin.php', 'qa_qnumbering_admin', 'Question Numbering Admin');

/*
   Omit PHP closing tag to help avoid accidental output
 */
