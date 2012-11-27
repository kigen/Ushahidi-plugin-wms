<?php

/**
 * Description of Wms_Settings
 *
 * @author Seth
 */
class Wms_Settings_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    function index() {
        $this->template->content = View::factory('admin/settings');
        if ($_POST) {
            $post = Validation::factory($_POST);

            ORM::factory('wms_layer')->off(true);
            switch ($post->mapConfig) {
                case 'overlay':
                    // Save config
                    ORM::factory('wms_settings')->overlay();

                    //Turn on only overlay layers
                    ORM::factory('wms_layer')->overlay(true);
                    $this->base(FALSE);
                    break;
                case 'wms':
                    //Save config
                    ORM::factory('wms_settings')->wms();
                    //Turn on all layers (base/overlay)
                    ORM::factory('wms_layer')->off();
                    $this->base(TRUE);
                    break;
                case 'off':
                    //Save config
                    ORM::factory('wms_settings')->off();
                    $this->base(FALSE);
                    //Turn off all layers
                    //ORM::factory('wms_layer')->off(true);
                    break;
            }
        }
    }

    function layers() {
        $this->template->content = View::factory('admin/layers');
        if ($_POST) {
            $post = Validation::factory($_POST);
            $i = 0;
            if (isset($post->layerName)) {
                foreach ($post->layerName as $l) {

                    $Layer;
                    switch ($post->flag[$i]) {

                        case 'new':
                            $Layer = ORM::factory('wms_layer');
                            $Layer->isBase = $post->isBase[$i];

                            break;
                        case 'edit':
                            $Layer = ORM::factory('wms_layer', $post->id[$i]);
                            break;
                    }
                    $Layer->name = $post->layerName[$i];
                    $Layer->title = $post->layerTitle[$i];
                    $Layer->url = $post->layerUrl[$i];
                    $Layer->isActive = 1;
                    $Layer->save();
                    $i++;
                }
            }
        }
    }

    /**
     * Switch base layers
     * @param boolean $on 
     */
    function base($on = TRUE) {

        if ($on) {
            //Register the baselayer name..
            $default_map = ORM::factory('settings')->where('key', 'default_map')->find();
            $this->db->query("UPDATE wms_settings SET value='{$default_map->value}' where `key`='last_base'");
            $this->db->query("UPDATE " . Kohana::config('database.default.table_prefix') . 'settings SET value=\'wms_base\' WHERE `key`=\'default_map\'');
        } else {

            $layer_id = ORM::factory('wms_settings')->lastBase();
            $this->db->query("UPDATE " . Kohana::config('database.default.table_prefix') . 'settings SET value=\'' . $layer_id . '\' WHERE `key`=\'default_map\'');
        }
    }

}

?>
