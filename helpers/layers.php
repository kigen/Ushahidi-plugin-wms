<?php

/*
 * Author: @kigen
 * It support the plugin in:
 * - generating WMS Layer js code
 * - Creating mockup Base Layer Objects
 * 
 */

class layers {
    /*
     * Generate Map layer definition javascript code.   
     */

    public static function get_layer($var_name, $layer) {


        $isbase = ($layer['isBase']) ? "true" : "false";
        return $var_name .
                "= new OpenLayers.Layer.WMS(
                            '" . $layer['title'] . "','{$layer['url']}' ,
                            {
                                LAYERS: '{$layer['name']}',
                                transparent: 'true',
                                tiled: true,
                                styles:\"\"
                            },
                            {
                                buffer: 0,
                                sphericalMercator: true,
                                singleTile: true,
                                displayOutsideMaxExtent: true,
                                isBaseLayer: {$isbase}
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

    public static function get_layer_object($layer_name, $layers, $baseType = null) {

        $isbase = ($layers['isBase']) ? 1 : 0;
        $layer = new stdClass();
        $layer->active = TRUE;
        $layer->name = "{$layer_name}";
        if ($baseType == null) {
            $layer->openlayers = "WMS";
        } else {
            $layer->openlayers = $baseType;
        }
        $layer->title = $layers['title'];
        $layer->description = 'WMS Layer';
        $layer->api_url = $layers['url'];
        $layer->data = array(
            'baselayer' => $isbase,
            'attribution' => '',
            'url' => $layers['url'],
            'type' => ''
        );
        $layer->wms_params = array(
            'format' => 'image/png',
            'layers' => $layers['name'],
            'tiled' => TRUE
        );

        return $layer;
    }

}

?>
