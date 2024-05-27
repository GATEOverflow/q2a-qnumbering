<?php

class qa_html_theme_layer extends qa_html_theme_base {

	public function head_css()
	{
		qa_html_theme_base::head_css();
		
		/* DEPRECATED
			if(qa_opt('qnumbering_plugin_enable')){
			//	if(!defined ('DONUT_THEME_BASE_DIR')){
			//		$this->output('<script async src="https://use.fontawesome.com/422af95f45.js"></script>');
			//	}
				$this->output('<style>'.qa_opt('qnumbering_plugin_css').'</style>');			
			}
		*/
		
		$this->output('
			<link rel="preload" as="style" href="'.QA_HTML_THEME_LAYER_URLTOROOT.'css/qnumbering.min.css?v=1" onload="this.onload=null;this.rel=\'stylesheet\'">
			<noscript><link rel="stylesheet" href="'.QA_HTML_THEME_LAYER_URLTOROOT.'css/qnumbering.min.css?v=1"></noscript>
		');
	}
	
	// Convert question counter to a variable instead of a function parameter,
	// to prevent rewriting functions and preserve theme modifications.
	protected $qNumber = 1;
	
	public function q_list_items($q_items)
	{
		// Don't know if this if statement is necessary, 
		// but will leave it here since you've added this yersterday.
		if($this-> template == 'questions') 
		{
		
			if (isset($_GET['start'])) {
				$this -> qNumber = $_GET['start'] + 1;
				$i = $_GET['start'] + 2;
			} else {
				$i = 2;
			}
			
			// Start normal q_list_items function
			foreach ($q_items as $q_item){
				$this->q_list_item($q_item);
				$this->qNumber = $i++; // ADD +1 to question Number
			}
		}
		else {
			qa_html_theme_base::q_list_items($q_items);
		}
	}
	
	// Create a separate function to make it easier to move around
	function q_number_output()
	{
		// Don't know if this if statement is necessary, 
		// but will leave it here since you've added this yersterday.
		if($this-> template == 'questions') 
		{
			// Get question number
			$qNumber = $this->qNumber;
			
			if (qa_opt('qnumbering_native_tooltip')) {
				$this->output('
					<div class="qa-question-list-count">
						<span class="q-number-data" title="'.qa_opt('qnumbering_plugin_tooltip').' '.$qNumber.'">'.$qNumber.'</span>
					</div>
				');
			} else {
				$this->output('
					<div class="qa-question-list-count">
						<span class="q-number-data">#'.$qNumber.'</span>
						<span class="q-number-pad" style="display:none;">'.qa_opt('qnumbering_plugin_tooltip').' '.$qNumber.'</span>
					</div>
				');
			}
		}
	}
	
	function q_item_stats($q_item)
	{
		// Output the qNumberCounter
		$this->q_number_output();
		qa_html_theme_base::q_item_stats($q_item);
	}
	
	function post_meta($post, $class, $prefix = null, $separator = '<br/>')
	{
		qa_html_theme_base::post_meta($post, $class, $prefix, $separator);
		if(!defined ('DONUT_THEME_BASE_DIR'))
			$this->view_count_numbering($post);
	}
	
	function view_count_numbering($post)
	{
		if ( !empty( $post['views'] ) ) {
			$this->output( '<span class="qa-q-item-meta">' );
			if(defined ('DONUT_THEME_BASE_DIR'))
				$this->output( ' | <i class="fa fa-eye"></i>' );
			$this->output_split( @$post['views'], 'q-item-view' );
			$this->output( '</span>' );
		}

	}

}

