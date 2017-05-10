<?php

namespace xavoc\allsamaj;

/**
* 
*/
class page_committeemember extends \xepan\base\Page{
	public $title = "Samaj Committees";
	function init(){
		parent::init();

		$committee_id = $this->app->stickyGET('committee_id');
		
		$committee_member = $this->add('xavoc\allsamaj\Model_CommitteeMember');
		if($committee_id)
			$committee_member->addCondition('committee_id',$committee_id);
		$crud = $this->add('xepan\hr\CRUD',null,null,['view/grid/committee-member']);
		$crud->setModel($committee_member);

	}
}