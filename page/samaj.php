<?php


namespace xavoc\allsamaj;


class page_samaj extends \xepan\base\Page{
	public $title= "All Samaj Listing";

	function init(){
		parent::init();

		$this->add('xepan\hr\CRUD',null,null,['view/grid/samajlist'])->setModel('xavoc\allsamaj\Samaj');
	}
}