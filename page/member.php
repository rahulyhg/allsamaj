<?php

namespace xavoc\allsamaj;

/**
* 
*/
class page_member extends \xepan\base\Page{
	public $title = "Samaj Member";
	function init(){
		parent::init();

		$this->add('xepan\hr\CRUD',null,null,['view/grid/member'])->setModel('xavoc\allsamaj\Member');
	}
}