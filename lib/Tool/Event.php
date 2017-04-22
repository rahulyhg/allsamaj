<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Event extends \xepan\cms\View_Tool {
	public $options=[
					'show_search_bar'=>true,
					'image'=>' ',
					'event_detail'=>' ',

	];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc/allsamaj/Model_Samaj');
				



	}

	function defaultTemplate(){
		return ['view/event'];
	}
}