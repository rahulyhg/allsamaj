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
		$this->addField('mail_id');

		$this->add('xepan/filestore/Field_Image','image_id');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}