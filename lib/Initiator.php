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
        $m->addItem(['Location Management','icon'=>' fa fa-file-image-o'],'xavoc_allsamaj_location');
        
    	return $this;
    }

    function setup_frontend(){
    	return $this;
    }
}