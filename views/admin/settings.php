<script type="text/javascript">
    $(document).ready(function (){
       
    })   
    function wms(val){
        console.log(val);
    }
    function overlay(val){
        console.log(val);
    }
    function off(val){
        console.log(val);
    }
   
</script>

<div>

    <h2>
        WMS Settings
    </h2>


    <div class="tabs">
        <ul class="tabset">
            <li> 
                <a class="active" href="<?php echo url::base(); ?>admin/wms_settings">General</a>
                <a  href="<?php echo url::base(); ?>admin/wms_settings/layers">Layers</a>
            </li>
        </ul>
    </div>     
<div id="settings" class="settings_holder">
    
    <?php echo form::open(); ?>
    <span>
            <h4>
                How would you like to setup your layers?
            </h4>
        </span>
   
        
    <p>
      
        <input id="wmsCheck" <?php echo (ORM::factory('wms_settings')->isWms())?  'checked="checked"' : "" ;?> value="wms" name="mapConfig" onchange="wms(this)" type="radio" />
         <?php echo form::label('Full WMS'); ?><br/>
       <span>
            WMS Layers will be used both as base Layer and Overlay layers
        </span>
         <br/>
         
           <input id="overlayCheck" <?php echo (ORM::factory('wms_settings')->isOverlay())?  'checked="checked"' : "" ;?>   value="overlay" name="mapConfig" onchange="overlay(this)" type="radio" />
<?php echo form::label('Overlays Only:') ?><br/>
       
        <span>
            This allows you to add wms layers as overlays only:
        </span>
        

        <br/>
        <input id="offCheck"  <?php echo (ORM::factory('wms_settings')->isOff())?  'checked="checked"' : "" ;?>   value="off" name="mapConfig" onchange="off(this)" type="radio" /> <?php echo form::label('OFF'); ?><br/>
       <span>
            Turns off the Plugin, turns on the default OpenStreet maps
        </span>

    </p>

  
    <?php echo form::submit("submit", 'Save Settings'); ?>



    <?php echo form::close(); ?>

</div>
    
</div>
