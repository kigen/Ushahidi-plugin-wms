<?php

/**
 * 
 * Settings Model
 * 
 */
class Wms_settings_Model extends ORM {

    protected $table_name = 'wms_settings';

    public function isWms() {
        $setting = $this->where(array('key' => 'wms'))->find();

        if ($setting->value == "TRUE") {
            return true;
        } else {
            return false;
        }
    }

    public function isOff() {
        $setting = $this->where(array('key' => 'off'))->find();

        if ($setting->value == "TRUE") {
            return true;
        } else {
            return false;
        }
    }

    public function isOverlay() {
        $setting = $this->where(array('key' => 'overlay'))->find();

        if ($setting->value == "TRUE") {
            return true;
        } else {
            return false;
        }
    }

    //Auto switch between settings
    public function off() {


        $db = new Database();

        $db->query("UPDATE {$this->table_name} SET value ='TRUE' where `key` = 'off'");
        $db->query("UPDATE {$this->table_name} SET value='FALSE' where `key` = 'wms'");
        $db->query("UPDATE {$this->table_name} SET value='FALSE' where `key` = 'overlay'");
    }

    public function wms() {


        $db = new Database();

        $db->query("UPDATE {$this->table_name} SET value='FALSE' where `key` = 'off'");
        $db->query("UPDATE {$this->table_name} SET value='TRUE' where `key` = 'wms'");
        $db->query("UPDATE {$this->table_name} SET value='FALSE' where `key` = 'overlay'");
    }

    public function overlay() {


        $db = new Database();

        $db->query("UPDATE {$this->table_name} SET value='FALSE' where `key`='off'");
        $db->query("UPDATE {$this->table_name} SET value='FALSE' where `key`='wms'");
        $db->query("UPDATE {$this->table_name} SET value='TRUE' where `key`='overlay'");
    }

    public function lastBase() {
        $last_base = $this->where('key', 'last_base')->find();
        return $last_base->value;
    }

}

?>
