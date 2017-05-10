<?php


namespace xavoc\allsamaj;


class page_news extends \xepan\base\Page{
	public $title= "All Samaj News";

	function init(){
		parent::init();

		$this->add('xepan\hr\CRUD',null,null,['view/grid/news'])->setModel('xavoc\allsamaj\News');
	}
}