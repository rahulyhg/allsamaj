<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Model_CommitteeMember extends \xepan\base\Model_Table{
	public $table = "allsamaj_committee_member";
	public $acl=false;
	function init()	{
		parent::init();

		$this->hasOne('xavoc\allsamaj\Committee','committee_id');
		$this->hasOne('xavoc\allsamaj\Member','member_id');
		// $this->addField('name');
		$this->addField('post');
		// $this->addField('mail_id');

		
		$this->addExpression('samaj')->set($this->ref('committee_id')->fieldQuery('samaj'));
		$this->addExpression('contact_no')->set($this->refSQL('member_id')->fieldQuery('contact_no'));
		$this->addExpression('email')->set($this->refSQL('member_id')->fieldQuery('email'));
		$this->addExpression('image')->set($this->refSQL('member_id')->fieldQuery('image'));
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}