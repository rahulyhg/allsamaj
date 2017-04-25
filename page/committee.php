<?php

namespace xavoc\allsamaj;

/**
* 
*/
class page_committee extends \xepan\base\Page{
	public $title = "Samaj Committees";
	function init(){
		parent::init();

		$this->add('xepan\hr\CRUD')->setModel('xavoc\allsamaj\Committee');

	}
}