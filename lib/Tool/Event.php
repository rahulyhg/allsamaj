<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Event extends \xepan\cms\View_Tool {
	public $options=[
					'show_image'=>'',
					'detail_url'=>'',
					'no_of_column'=>' ',
					'no_of_record'=>10,

	];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$committee_id = $this->app->stickyGET('committee_id');
		$m = $this->add('xavoc/allsamaj/Model_Event');
		if($samaj_id)
			$m->addCondition('samaj_id',$samaj_id);
		if($committee_id)
			$m->addCondition('committee_id',$committee_id);
		// $m->addExpression('detail_url')->set(function($m,$q){
		// 	return $url;
		// });

		$grid = $this->add('xepan\hr\Grid',null,null,['view/event']);
		$grid->setModel($m);
		$grid->addHook('formatRow',function($g){
			if($this->options['no_of_column']){
				$g->current_row_html['col'] = $this->options['no_of_column'];
			}else{
				$g->current_row_html['col'] = "";
			}
			$g->current_row_html['content'] = $g->model['content'];
			$g->current_row_html['detail_url'] = $g->app->url($this->options['detail_url'],['event_id'=>$g->model->id]);
			
			$social_url = ['facebook_url','instagram_url','twitter_url','google_url','website_url'];
			foreach ($social_url as $key => $value) {
				if($g->model[$value]){

				}else{
					$g->current_row_html[$value.'_wrapper'] = "";
				}
			}

			if(!$this->options['show_image']){
				$g->current_row_html['image_wrapper'] = "";

			}

		});

		if($this->options['no_of_record']){
			// $paginator = $grid->add('Paginator',null,'paginator');
			// $paginator->setRowsPerPage($this->options['no_of_record']);
			$grid->addPaginator($this->options['no_of_record']);

			// $m->setLimit($this->options['no_of_record']);
		}


	}
}