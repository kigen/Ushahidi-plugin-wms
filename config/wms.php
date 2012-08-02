<?php

/*
 * Author: @kigen
 * Config file
 */

//Register all layers here...
$config['layers'] = array(
    'wms_base' => array(
        'title' => "World Base Layer",
        'name' => "topp:world",
        'base' => TRUE
    ),
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
