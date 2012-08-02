<?php
/*
 * Author: @kigen
 * Install the Plugin
 * Pre preparations
 */


class Wms_Install {
 
  
    public function __construct()
    {
        $this->db =  new Database();
    }
 
    /**
     * update default map settings field.
     */
    public function run_install()
    {
        //Register the baselayer name..
		$this->db->query("UPDATE ".Kohana::config('database.default.table_prefix').'settings SET value=\'wms_base\' WHERE `key`=\'default_map\'');
		//Set the default zoom level higher
		$this->db->query("UPDATE ".Kohana::config('database.default.table_prefix').'settings SET value =\'5\' WHERE `key`=\'default_zoom\'');
    }
 
    /**
     * reset the map settings to default map.
     */
    public function uninstall()
    {
		  $this->db->query("UPDATE ".Kohana::config('database.default.table_prefix').'settings SET value value=\'osm_tah\' WHERE `key`=\'default_map\'');

    }
}
?>
