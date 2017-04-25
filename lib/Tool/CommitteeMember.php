<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_CommitteeMember extends \xepan\cms\View_Tool {
	public $options=[
					'show_search_bar'=>true,
					'no_of_committee_members'=>10,
					'show_image'=>true,
	];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc/allsamaj/Model_Samaj');

		$grid = $this->add('xepan\hr\Grid',null,null,['view/committeemember']);
				



	}

	function defaultTemplate(){
		return ['view/committeemember'];
	}
}