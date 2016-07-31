<?php

class qa_html_theme_layer extends qa_html_theme_base {

	function head_custom()
	{
		qa_html_theme_base::head_custom();
		if(qa_opt('qnumbering_plugin_enable'))
			$this->output('<style type="text/css">'.qa_opt('qnumbering_plugin_css').'</style>');			
	}


	public function q_list_items($q_items)
	{
		if(qa_opt('qnumbering_plugin_enable')) {
			$i=0;
			foreach ($q_items as $q_item){
				$this->q_list_item1($q_item, $i++);
			}
		}
		else {
			qa_html_theme_base::q_list_items($q_items);
		}
	}
	public function q_list_item1($q_item, $i)
	{

		$this->output( '<div class="qa-q-list-item row' . rtrim( ' ' . @$q_item['classes'] ) . '" ' . @$q_item['tags'] . '>' );



		$this->q_item_stats1($q_item, $i);
		$this->q_item_main($q_item);
		$this->q_item_clear();

		$this->output('</div> <!-- END qa-q-list-item -->', '');
	}
	function q_item_stats1($q_item, $i)
	{
		$this->output('<div class="qa-q-item-stats">');

		$this->voting($q_item);
		$this->a_count($q_item);
		$i++;
		$this->output('<div class="qa-question-list-count">'.$i.'</div>');

		$this->output('</div>');
	}


}

