<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Event extends \xepan\cms\View_Tool {
	public $options=[
					'show_search_bar'=>true,
					'image'=>'',
					'detail_page'=>'',

	];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc/allsamaj/Model_Event');

		// $m->addExpression('detail_url')->set(function($m,$q){
		// 	return $url;
		// });

		$grid = $this->add('xepan\hr\Grid',null,null,['view/event']);
		$grid->setModel($m);
		$grid->addHook('formatRow',function($g){
			$g->current_row_html['content'] = $g->model['content'];
			$g->current_row_html['detail_url'] = $g->app->url($this->options['detail_page'],['event_id'=>$g->model->id]);
			
			$social_url = ['facebook_url','instagram_url','twitter_url','google_url'];
			foreach ($social_url as $key => $value) {
				if($g->model[$value]){

				}else{
					$g->current_row_html[$value.'_wrapper'] = "";
				}
			}

		});


	}
}