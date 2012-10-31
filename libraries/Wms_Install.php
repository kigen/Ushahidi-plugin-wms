<?php

/*
 * Author: @kigen
 * Install the Plugin
 * Pre preparations
 */

class Wms_Install {

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Setup all required tables 
     */
    public function run_install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `wms_layer` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(255) NOT NULL,
		`title` varchar(255) NOT NULL,
		`url` varchar(255) NOT NULL,
		`isBase` tinyint(1) NOT NULL,
		`isActive` tinyint(1) NOT NULL,
		PRIMARY KEY (`id`)
		);");

		$this->db->query("DROP TABLE IF EXISTS `wms_settings`;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `wms_settings` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`key` varchar(50) NOT NULL,
		`value` varchar(50) NOT NULL,
		PRIMARY KEY (`id`)
		);");

		$this->db->query("INSERT INTO `wms_settings` (`id`, `key`, `value`) VALUES
		(1, 'wms', 'FALSE'),
		(2, 'overlay', 'FALSE'),
		(3, 'off', 'TRUE'),
		(4, 'last_base', 'osm_mapnik');");
        
       
        return true;
    }

    /**
     * reset the map settings to default map.
     */
    public function uninstall() {
        //Clean UP
		
		   $layer_id = ORM::factory('wms_settings')->lastBase();
           $this->db->query("UPDATE " . Kohana::config('database.default.table_prefix') . 'settings SET value=\''.$layer_id.'\' WHERE `key`=\'default_map\'');
       
		
                $sql ="DROP TABLE TABLE IF EXISTS `wms_layer`; 
                       DROP TABLE TABLE IF EXISTS `wms_settings`;";
        
        $this->db->query($sql); 
    }

}

?>
