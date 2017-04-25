<?php

namespace xavoc\allsamaj;

class Initiator extends \Controller_Addon {
    public $addon_name = 'xavoc_allsamaj';

    function setup_admin(){

    	if($this->app->is_admin){
            $this->routePages('xavoc_allsamaj');
            $this->addLocation(array('template'=>'templates','js'=>'templates/js','css'=>['templates/css','templates/js']))
            ->setBaseURL('../shared/apps/xavoc/');
        }

        $m = $this->app->top_menu->addMenu('All Samaj');
        $m->addItem(['All Samaj','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_samaj');
        $m->addItem(['News','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_news');
        $m->addItem(['Committee','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_committee');
        $m->addItem(['Member','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_member');
        $m->addItem(['Committee Member','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_committeemember');
        $m->addItem(['Location Management','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_location');
        
    	return $this;
    }

    function setup_frontend(){
        $this->routePages('xavoc_allsamaj');
        $this->addLocation(array('template'=>'templates','js'=>'templates/js','css'=>['templates/css','templates/js']))
        ->setBaseURL('./shared/apps/xavoc/allsamaj/');

        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_SamajLister','AllSamaj');
        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_SamajDetail','AllSamaj');
        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_SamajNews','AllSamaj');
        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_Event','AllSamaj');
        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_CommitteeMember','AllSamaj');
        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_Member','AllSamaj');
        $this->app->exportFrontEndTool('xavoc\allsamaj\Tool_EventDetail','AllSamaj');

    	return $this;
    }
}