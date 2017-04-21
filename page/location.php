<?php


namespace xavoc\allsamaj;


class page_location extends \xepan\base\Page{
	public $title= "Location Management";

	function init(){
		parent::init();

		$tabs = $this->add('Tabs');

		$tabs->addTab('City')
					->add('xepan\hr\CRUD')->setModel('xavoc\allsamaj\City');
		$tabs->addTab('State')
				->add('xepan\hr\CRUD')->setModel('xavoc\allsamaj\State');
		$tabs->addTab('Country')
				->add('xepan\hr\CRUD')->setModel('xavoc\allsamaj\Country');
	}
}