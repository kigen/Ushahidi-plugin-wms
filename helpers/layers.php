<?php

/*
 * Author: @kigen
 * It support the plgin in:
 * - generating WMS Layer js code
 * - Creating mockup Base Layer Objects
 * 
 */

class layers {
   
    
    /*
     * Generate Map layer definition javascript code.   
     */

    public static function get_layer($var_name, $layer_name, $layer_title, $is_base_Layer="false") {


        return $var_name .
                "= new OpenLayers.Layer.WMS(
                            '" . $layer_title . "',base_url ,
                            {
                                LAYERS: '{$layer_name}',
                                transparent: 'true',
                                tilesOrigin : map.maxExtent.left + ',' + map.maxExtent.bottom
                            },
                            {
                                buffer: 0,
                                singleTile: true,
                                displayOutsideMaxExtent: true,
                                isBaseLayer: {$is_base_Layer}
                            } 
                        );
                        \n\n
                        ";
    }

    
    
    /*
     * Generate a Layer object to mock ushahidi layers Objects 
     * in [applicatio/helpers/map] 
     * (only useful for layer name recognition)
     */

    public static function get_layer_object($layer_name) {
        $layer = new stdClass();
        $layer->active = TRUE;
        $layer->openlayers = "WMS";
        $layer->title = 'OSM Tiles@Home';
        $layer->name = $layer_name;
        $layer->data = array(
            'baselayer' => TRUE,
            'type' => 'WMS'
        );
        return $layer;
    }
    

}

?>
