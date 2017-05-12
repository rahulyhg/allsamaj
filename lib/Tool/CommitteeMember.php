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
		$committee_id = $this->app->stickyGET('committee_id');
		$m = $this->add('xavoc/allsamaj/Model_CommitteeMember');
		if($samaj_id)
			$m->addCondition('samaj_id',$samaj_id);
		if($committee_id)
			$m->addCondition('committee_id',$committee_id);

		$grid = $this->add('CompleteLister',null,null,['view/committeemember']);
		$grid->setModel($m);		



	}

	// function defaultTemplate(){
	// 	return ['view/committeemember'];
	// }
}