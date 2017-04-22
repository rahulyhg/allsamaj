<?php


namespace xavoc\allsamaj;

class Tool_SamajLister extends \xepan\cms\View_Tool {
	
	function init(){
		parent::init();
		
		$samaj_model = $this->add('xavoc\allsamaj\Model_Samaj');
		$lister = $this->add('CompleteLister',null,null,['view/samajlister']);

		$lister->setModel($samaj_model);
	}
}