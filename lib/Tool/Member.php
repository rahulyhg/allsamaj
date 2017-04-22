<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Member extends \xepan\cms\View_Tool {
	public $options=[
					'image_of_member'=>' ',
					'no_of_member'=>10,
	];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc/allsamaj/Model_Samaj');
				



	}

	function defaultTemplate(){
		return ['view/member'];
	}
}