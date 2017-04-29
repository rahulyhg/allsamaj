<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Committee extends \xepan\cms\View_Tool{
	public $options=[
					'show_image'=>'',
					'detail_url'=>'',
					'no_of_record'=>10,

	];	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc\allsamaj\Model_Committee');
		if($samaj_id)
			$m->addCondition('samaj_id',$samaj_id);

		$l = $this->add('CompleteLister',null,null,['view/committee']);

		$l->addHook('formatRow',function($l){
			if($this->options['detail_url']){
				$l->current_row_html['detail_url'] = $this->app->url($this->options['detail_url_page'],['committee_id'=>$l->model->id]);
			}
		});
		
		$l->setModel($m);			

		if($this->options['no_of_record']){
			$paginator = $l->add('Paginator',null,'paginator');
			$paginator->setRowsPerPage($this->options['no_of_record']);

		}
	}

	// function defaultTemplate(){
	// 	return ['view/committee'];
	// }
}