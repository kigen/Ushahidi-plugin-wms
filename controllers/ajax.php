<?php

/*
 * 
 * Handle all Ajax related requests 
 * 
 */

class Ajax_Controller extends Template_Controller {

    public $template = 'ajax';

    /**
     * Delete layers
     * @param int $id 
     */     
    function delete($id) {
        $resp = array('success'=>false,'id'=>$id);
        if(ORM::factory('wms_layer',$id)->delete()){
                $resp = array('success'=>true,'id'=>$id);         
        }
        $this->template->content = json_encode($resp);
    } 
  
}

?>
