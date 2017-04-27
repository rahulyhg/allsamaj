<?php


namespace xavoc\allsamaj;

class Tool_SamajNews extends \xepan\cms\View_Tool {

	public $options=[
					'detail_url_page'=>null

	];
	
	function init(){
		parent::init();
		
		$samaj_id = $this->app->stickyGET('samaj_id');
		$n = $this->add('xavoc\allsamaj\Model_News');
		if($samaj_id){
			$n->addCondition('samaj_id',$samaj_id);		
		}
		$lister = $this->add('CompleteLister',null,null,['view/samajnews1']);

		$lister->addHook('formatRow',function($l){
			if($this->options['detail_url_page']){
				$l->current_row_html['news_details_page_url'] = $this->options['detail_url_page'];
			}			
		});
		
		$lister->setModel($n);
	}

	// function defaultTemplate(){
	// 	return ['view/samajnews1'];
	// }
}