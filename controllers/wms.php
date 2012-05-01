<?php
/*
 * Author: @kigen
 */

class Wms_Controller extends Controller {

     
    public function regsiter_map_layers() {

        $layers = Event::$data;
        
        //Reset ushahidi default layer object definitions
        $layers = array();
        
        //Read layer config values from [plugin config]
        $layer_list = Kohana::config('wms.layers');       
        
        
        //biuld dummy layer objects 
        // The importance of this is to make sure that all your alyers will be added to 
        // map.addlayers([------->layers added here-------])
        
        foreach ($layer_list as $key =>$layer) {        
            $layers[$key] = layers::get_layer_object($key);
        }
        
      
        Event::$data = $layers;
    }

    public function modify_layer_code() {
        $js = Event::$data;
        
        //TODO: Move this configuration to database 
         $layer_list = Kohana::config('wms.layers');
       
        $wms_server = Kohana::config('wms.service_url');
         
        $js = "var base_url = \"{$wms_server}\";\n\n";

        //Attach extra code to manipulate map to proper projection
        // TODO: Bounds can be read from database.. 
        
          $js.= "var bounds = new OpenLayers.Bounds(
          33.909, -4.67,
          41.897, 5.018
          );
          map.maxExtend = bounds;\n\n";
         

        $js .= "map.projection = new OpenLayers.Projection(\"EPSG:4326\");
            \n\n
            ";
       
       
        //Add layers as per above configuration.
        foreach ($layer_list as $key =>$layer) {

            if ($layer['base']) {
                $js.= layers::get_layer($key, $layer['name'], $layer['title'], "true");
            } else {
                $js.= layers::get_layer($key, $layer['name'], $layer['title']);
            }
        }
        
        /*
         * Add other layers here...
         * $js .=""; but must register layer var in register_map_layers
         */
        
        $js .="
                //map.zoomToMaxExtent();
              ";
        //send back the results
        Event::$data = $js;
    }

}

?>
