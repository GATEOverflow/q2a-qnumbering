<?php
class qa_qnumbering_admin {

	function option_default($option) {

		switch($option) {
			/* DEPRECATED
			
			case 'qnumbering_plugin_css':
				return '
					.qa-question-list-count {
						color: inherit;
						position: relative;
					}
					.q-number-pad {
						position: absolute;
						z-index: 2;
						-webkit-overflow-scrolling: touch;
						transition: opacity .25s cubic-bezier(.4,0,.2,1);
						will-change: opacity, visibility;
						margin: 0 12px;
						white-space: nowrap;
						opacity: 0;
						visibility: hidden;
						background-color: rgb(0 0 0 / 90%);
						color: #ffffff;
						font-size: .75rem;
						font-weight: initial;
						padding: 4px 8px;
						border-radius: 0.3rem;
						pointer-events: none;
						box-shadow: 0 1px 3px 0 rgb(60 64 67 / 30%), 0 4px 8px 3px rgb(60 64 67 / 15%);
					}
				';
			*/
			case 'qnumbering_plugin_tooltip':
				return 'List item number'; /* Default tootip text */
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
			qa_opt('qnumbering_native_tooltip', (bool)qa_post_text('qnumbering_native_tooltip'));
			$ok = qa_lang('admin/options_saved');

		}
		else if (qa_clicked('qnumbering_reset')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			qa_opt('qnumbering_native_tooltip', (bool)qa_post_text('0')); // Reset to zero, default value
			$ok = qa_lang('admin/options_reset');
		}

		$fields = array();

		$fields[] = array(
			'label' => 'Native tooltip',
			'note' => 'Show Browser Native tooltip instead of Custom tooltip to minimize excessive DOM elements',
			'type' => 'checkbox',
			'value' => qa_opt('qnumbering_native_tooltip'),
			'tags' => 'NAME="qnumbering_native_tooltip"',
		);
		
		$fields[] = array(
			'type' => 'blank',
		);
		
		$fields[] = array(
			'label' => 'Informational text when hovering the number',
			'type' => 'text',
			'value' => qa_opt('qnumbering_plugin_tooltip'), 
			'tags' => 'NAME="qnumbering_plugin_tooltip"',
		);
		
		/* DEPRECATED
		
			$fields[] = array(
				'rows' => 8,
				'label' => 'QNumbering CSS',
				'type' => 'textarea',
				'value' => qa_opt('qnumbering_plugin_css'),
				'tags' => 'NAME="qnumbering_plugin_css"',
			);
		
		*/

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

