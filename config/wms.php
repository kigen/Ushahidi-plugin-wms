<?php

/*
 * Author: @kigen
 * Config file
 */


/*
 * Define all layers to be added to ushahidi maps
 * @title : Title of the map
 * @name: if WMS Layer from geoserver :- It is the name of the layer 
 * @base: True if it is a base layer
 */
 
$config['layers'] = array(
    'wms_base' => array(
        'title' => "World Base Layer",
        'name' => "topp:world",
        'base' => TRUE
    )	
	,
	   'za_veg' => array(
        'title' => "South Africa vegetation",
        'name' => "za:za_vegetation",
        'base' => FALSE
    )
	,
    'state_population' => array(
        'title' => "USA State Population",
        'name' => "topp:states",
        'base' => FALSE
    )
	
);


//WMS server url:
//default: Opengeo's geoserver demo
$config['service_url'] ="http://demo.opengeo.org/geoserver/wms";

?>
