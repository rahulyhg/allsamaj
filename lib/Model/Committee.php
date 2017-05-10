<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Model_Committee extends \xepan\base\Model_Table{
	public $table = "allsamaj_committee";
	// public $acl=false;
	public $acl_type="Committee";
	public $actions= [
				'Active'=>['view','edit','delete','member','deactivate'],
				'InActive'=>['view','edit','delete','activate'],
				];
	function init()	{
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->addField('name');
		$this->addField('status')->enum(['Active','InActive'])->defaultValue('Active');
		$this->addField('created_at')->type('date')->defaultValue($this->app->now);
		$this->addField('description')->type('text');
		$this->hasmany('xavoc\allsamaj\CommitteeMember','committee_id');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->addExpression('member_count')->set(function($m,$q){
			return $m->refSQL('xavoc\allsamaj\CommitteeMember')->count();
		});
	}

	function page_member($page){
		
		$cmember_model = $this->add('xavoc\allsamaj\Model_CommitteeMember');
		$cmember_model->addCondition('committee_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD',null,null,['view/grid/committee-member']);
		$crud->setModel($cmember_model);
	}

}