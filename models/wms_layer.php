<?php

/*
 * Layers Model
 * 
 */

class Wms_layer_Model extends ORM {

    protected $table_name = 'wms_layer';
    var $db;

    /**
     * Get all active base layers
     * @return WMS_Layer_Model 
     */
    public function getBaseLayers() {
        return ORM::factory('wms_layer')->where(array('isBase' => 1, 'isActive' => 1))->find_all();
    }
    /**
     *Get all active layers
     * @return WMS_Layer_Model 
     */
    public function getOverlays() {
        return ORM::factory('wms_layer')->where(array('isBase' => 0, 'isActive' => 1))->find_all();
    }
    /**
     * Activate overlay layers only
     * @param boolean $on 
     */
    public function overlay($on = false) {
        $db = new Database();
        if ($on) {
            $db->query("UPDATE {$this->table_name} SET isActive=1 where isBase=0");
        } else {
            $db->query("UPDATE {$this->table_name} SET isActive=0 where isBase=0");
        }
    }
    
    /**
     * Turn off all the layers
     * @param boolean $on 
     */
    public function off($on = false) {
        $db = new Database();
        if ($on) {
            $db->query("UPDATE {$this->table_name} SET isActive=0 where 1=1");
        } else {
            $db->query("UPDATE {$this->table_name} SET isActive=1 where 1=1");
        }
    }

    /**
     * Activate All layers
     * @param boolean $on 
     */
    public function wms($on = false) {
        if ($on) {
            $this->off();
        }
    }

    /**
     * Get all active layers 
     * @return Array 
     */
    public function all() {
        $layers = array();
        $base_index = 0;
        $overlay_index = 0;
        $layer = $this->where('isActive', 1)->find_all();
        foreach ($layer as $l) {

            $a = array(
                'name' => $l->name,
                'title' => $l->title,
                'url' => $l->url,
                'isBase' => ($l->isBase == 1)
            );

            $layer_name = "";
            if ($a['isBase']) {
                if ($base_index == 0) {
                    $layer_name = "wms_base";
                } else {
                    $layer_name = "wms_base{$base_index}";
                }
                $base_index++;
            } else {
                if ($overlay_index == 0) {
                    $layer_name = "overlay";
                } else {
                    $layer_name = "overlay{$overlay_index}";
                }
                $overlay_index++;
            }

            $layers[$layer_name] = $a;
        }
        return $layers;
    }

}

?>
