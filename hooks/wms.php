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
        //Check if the plugin has been turned off
        if (!ORM::factory('wms_settings')->isOff()) {
            Event::add('ushahidi_filter.map_base_layers', array("Wms_Controller", 'register_map_layers'));
            Event::add('ushahidi_filter.map_layers_js', array("Wms_Controller", 'modify_layer_code'));
        }
    }

}

new wms;
?>
