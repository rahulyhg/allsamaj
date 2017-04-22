<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Model_CommitteeMember extends \xepan\base\Model_Table{
	public $table = "allsamaj_committee_member";
	function init()	{
		parent::init();

		$this->hasOne('xavoc\allsamaj\Committee','committee_id');
		$this->hasOne('xavoc\allsamaj\Member','member_id');
		$this->addField('name');
		$this->addField('post');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}