<?php

/*
 * Author: @kigen
 * Enable WMS Layer on to ushahidi.
 */


class wms {

    public function __construct() {
        // Hook into routing
        Event::add('system.pre_controller', array($this, 'add'));
    }

    public function add() {
        /*
         * Evil :-( Work-around
         * Register this action filter Event::run('ushahidi_filter.map_base_layers_code', $js); inside
         * application/helper/map.php line 100 
         * before return $js 
         */
        Event::add('ushahidi_filter.map_base_layers', array("Wms_Controller", 'regsiter_map_layers'));
        Event::add('ushahidi_filter.map_base_layers_code', array("Wms_Controller", 'modify_layer_code'));
    }    

    
}

new wms;
?>
