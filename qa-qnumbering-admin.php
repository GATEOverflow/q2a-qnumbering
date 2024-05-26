<?php
class qa_qnumbering_admin {

	function option_default($option) {

		switch($option) {
			case 'qnumbering_plugin_css':
				return '.qa-question-list-count {
    display: block;
    text-align: center;
    font-style: normal;
    font-weight: bold;
    color: cornflowerblue;
	clear: both;
}';
			default:
				return null;				
		}

	}

	function allow_template($template)
	{
		return ($template!='admin');
	}	   

	function admin_form(&$qa_content)
	{					   

		// Process form input

		$ok = null;

		if (qa_clicked('qnumbering_save')) {
			foreach($_POST as $i => $v) {

				qa_opt($i,$v);
			}

			$ok = qa_lang('admin/options_saved');


		}
		else if (qa_clicked('qnumbering_reset')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}

		$fields = array();


		$fields[] = array(
				'rows' => 8,
				'label' => 'QNumbering CSS',
				'type' => 'textarea',
				'value' => qa_opt('qnumbering_plugin_css'),
				'tags' => 'NAME="qnumbering_plugin_css"',
				);		   




		return array(		   
				'ok' => ($ok && !isset($error)) ? $ok : null,

				'fields' => $fields,
				'buttons' => array(
					array(
						'label' => qa_lang_html('main/save_button'),
						'tags' => 'NAME="qnumbering_save"',
					     ),
					array(
						'label' => qa_lang_html('admin/reset_options_button'),
						'tags' => 'NAME="qnumbering_reset"',
					     ),
					)
			    );
	}



}

