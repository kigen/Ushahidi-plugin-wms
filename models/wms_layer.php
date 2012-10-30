<?php

/*
 * Layers Model
 * 
 */

class Wms_layer_Model extends ORM {

    protected $table_name = 'wms_layer';
    var $db;

    public function getBaseLayers() {
        return ORM::factory('wms_layer')->where(array('isBase' => 1, 'isActive' => 1))->find_all();
    }

    public function getOverlays() {
        return ORM::factory('wms_layer')->where(array('isBase' => 0, 'isActive' => 1))->find_all();
    }

    public function overlay($on = false) {
        $db = new Database();
        if ($on) {
            $db->query("UPDATE {$this->table_name} SET isActive=1 where isBase=0");
        } else {
            $db->query("UPDATE {$this->table_name} SET isActive=0 where isBase=0");
        }
    }

    public function off($on = false) {
        $db = new Database();
        if ($on) {
            $db->query("UPDATE {$this->table_name} SET isActive=0 where 1=1");
        } else {
            $db->query("UPDATE {$this->table_name} SET isActive=1 where 1=1");
        }
    }

    public function wms($on = false) {
        if ($on) {
            $this->off();
        }
    }

    //Get all active layers 
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
                if ($base_index == 0) {
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
