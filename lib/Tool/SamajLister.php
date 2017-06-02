<?php


namespace xavoc\allsamaj;

class Tool_SamajLister extends \xepan\cms\View_Tool {
	public $options=[
					'show_search_bar'=>true,
					'no_of_record_on_page'=>10,
					'no_of_column'=>4,
					'detail_url_page'=>null,
					'include_featured_samaj_also'=>false,
					'show_city_list'=>'udaipur'
	];


	function init(){
		parent::init();
		
		$filter_samaj = $this->app->stickyGET('search');
		$samaj_model = $this->add('xavoc\allsamaj\Model_Samaj');

		$order_by="id desc";
		if($this->options['include_featured_samaj_also']==='yes'){
			$order_by = "is_featured desc, id desc";
		}
		$samaj_model->addCondition('status','Active');

		$samaj_model->setOrder($order_by);

		if($filter_samaj){
			// $item->addExpression('Relevance')->set('MATCH(search_string) AGAINST ("'.$_GET['search'].'" IN NATURAL LANGUAGE MODE)');
			$samaj_model->addExpression('Relevance')->set(function($m, $q){
				return $q->expr('MATCH([0]) AGAINST ("[1]" IN NATURAL LANGUAGE MODE)',[$q->getField('search_string'),$_GET['search']]);
			});
			$samaj_model->addCondition('Relevance','>',0);
	 		$samaj_model->setOrder('Relevance','Desc');
		}
		
		// if($fliter_samaj)
		// 	$samaj_model->addCondition('id',$fliter_samaj);
		$view = $this->add('View');
		$lister = $view->add('CompleteLister',null,null,['view/samajlister']);
		
		$lister->addHook('formatRow',function($l){
			if($this->options['no_of_column']){
				$l->current_row_html['col'] = $this->options['no_of_column'];
			}else{
				$l->current_row_html['col'] = "";
			}

			if($this->options['detail_url_page']){
				$l->current_row_html['detail_url_page'] = $this->app->url($this->options['detail_url_page'],['samaj_id'=>$l->model->id]);
			}			
		});

		$lister->setModel($samaj_model);

		if($this->options['no_of_record_on_page']){
			$paginator = $lister->add('Paginator',null,'paginator');
			$paginator->setRowsPerPage($this->options['no_of_record_on_page']);

			// $samaj_model->setLimit($this->options['no_of_record']);
		}

		$lister->add('xepan\cms\Controller_Tool_Optionhelper',['options'=>$this->options,'model'=>$samaj_model]);
	}
}