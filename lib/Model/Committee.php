<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Model_Committee extends \xepan\base\Model_Table{
	public $table = "allsamaj_committee";
	function init()	{
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->hasmany('xavoc\allsamaj\CommitteeMember','committee_id');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}