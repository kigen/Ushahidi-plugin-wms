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
        $this->db->query("UPDATE ".Kohana::config('database.default.table_prefix').'settings SET default_map=\'wms_base\' WHERE id=1');

    }
 
    /**
     * reset the map settings to default map.
     */
    public function uninstall()
    {
          $this->db->query("UPDATE ".Kohana::config('database.default.table_prefix').'settings SET default_map=\'osm_tah\' where id=1');

    }
}
?>
