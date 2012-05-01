<?php

/*
 * Author: @kigen
 * Config file
 */


//Register all layers here...
$config['layers'] = array(
    'wms_base' => array(
        'title' => "Administrative Units",
        'name' => "admin",
        'base' => TRUE
    ),
    'roads' => array(
        'title' => "Roads",
        'name' => "roads",
        'base' => FALSE
    ),
    'towns' => array(
        'title' => "Towns",
        'name' => "centers",
        'base' => FALSE
    )
	
);


//WMS server url:
//default: Opengeo's geoserver demo
$config['service_url'] ="http://localhost:8080/geoserver/wms";

?>
