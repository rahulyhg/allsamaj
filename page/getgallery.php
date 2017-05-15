<?php

namespace xavoc\allsamaj;

class page_getgallery extends \Page{
	function init(){
		parent::init();

		$c = $this->add('xavoc\allsamaj\Model_CarouselCategory');

		$rows = $c->getRows(['id','name']);
		$option = "<option value='0'>Please Select </option>";
		foreach ($rows as $row) {
			$option .= "<option value='".$row['id']."'>".$row['name']."</option>";
		}

		echo $option;
		exit;
	}
}