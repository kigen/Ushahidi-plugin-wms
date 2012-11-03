<script type="text/javascript">
    $(document).ready(function (){

    })
    var baseLayerCount = 0;
    var overLayerCount = 0;
    var html='';
    function addlayer(type){

        if(type=='base'){
            baseLayerCount++;
            html = '<tr id="baselayer'+baseLayerCount+'">'+
                '<td><input width="auto" type="text" name="layerName[]" id="name'+baseLayerCount+'"/></td>'+
                '<td><input type="text" name="layerTitle[]" id="title'+baseLayerCount+'"/></td>'+
                '<td><input type="text" name="layerUrl[]" id="url'+baseLayerCount+'"/></td>'+
                '<input type="hidden" name="isBase[]" value="1" />'+
                '<input type="hidden" name="flag[]" value="new" />'+
                '<input type="hidden" name="id[]" value="-1" />'+
                '<td><a onclick="removelayer(\'baselayer'+baseLayerCount+'\')" id="remove'+baseLayerCount+'" href="#remove">Remove</a></td></tr>';
            
            $("#baseHolder").append($(html));

        }else{
            overLayerCount++;
            html = '<tr id="overlayer'+overLayerCount+'">'+
                '<td><input type="text" name="layerName[]" id="name'+overLayerCount+'"/></td>'+
                '<td><input type="text" name="layerTitle[]" id="title'+overLayerCount+'"/></td>'+
                '<td><input type="text" name="layerUrl[]" id="url'+overLayerCount+'"/></td>'+
                '<input type="hidden" name="isBase[]" value="0" />'+
                '<input type="hidden" name="flag[]" value="new" />'+
                '<input type="hidden" name="id[]" value="-1" />'+
                '<td><a onclick="removelayer(\'overlayer'+overLayerCount+'\')" id="remove'+overLayerCount+'" href="#remove">Remove</a></td></tr>';
            
            $("#overlayHolder").append($(html));

        }

        return true;

    }

    function removelayer(layer){
         $("#"+layer).remove();
    }

    function editlayer(layer,type){
           //Layer ID
        var id  = parseInt(layer);
        $layerRow = $("#"+layer)[0];
        var layer_name =  $layerRow.children[0].innerHTML;
        var layer_title =  $layerRow.children[1].innerHTML;
        var layer_url =  $layerRow.children[2].innerHTML;
        var layer_id = id;
        
        //Spawn input fields
        $layerRow.children[0].innerHTML = '<input type="text" name="layerName[]" value="'+layer_name+'"/></td>'
        $layerRow.children[1].innerHTML = '<input type="text" name="layerTitle[]" value="'+layer_title+'"/></td>'
        $layerRow.children[2].innerHTML = '<input type="text" name="layerUrl[]" value="'+layer_url+'"/></td>'+
                                          '<input type="hidden" name="isBase[]" value="-1" />'+
                                          '<input type="hidden" name="id[]" value="'+layer_id+'"/>'+
                                          '<input type="hidden" name="flag[]" value="edit" />';
            
        
        
    }

    function deletelayer(layer){

        //Layer ID
        var id  = parseInt(layer);

        $.ajax({
            type:"POST",
            url: '<?php echo url::base(); ?>ajax/delete/'+id,
            dataType: 'json',
            success: function (data){
                if(data.success){
                    $("#"+layer).remove();
                }
            }
        })
        
       
    }



</script>

<div >

    <h2>
        WMS Settings
    </h2>


    <div class="tabs">
        <ul class="tabset">
            <li>
                <a href="<?php echo url::base(); ?>/admin/wms_settings">General</a>
                <a class="active" href="<?php echo url::base(); ?>/admin/wms_settings/layers">Layers</a>
            </li>
        </ul>
    </div>


    <div class="sms_holder">
        <?php echo form::open(); ?>

        <div id="base" >
            <h2>
                Base Layer
            </h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Layer Name (eg world:map)</th>
                        <th>Layer Title (eg World Map)</th>
                        <th>Url (eg http://localhost:8080/geoserver/wms)</th>
                        <th>
                            <a id="add" onclick="addlayer('base')" href="#add">Add Layer</a>
                        </th>
                    </tr>
                </thead>
                <tbody id="baseHolder">
                    <?php
                    $baselayers = ORM::factory('wms_layer')->getBaseLayers();
                    foreach ($baselayers as $baselayer):
                        ?>
                        <tr id="<?php echo $baselayer->id; ?>dbbaselayer">
                            <td><?php echo $baselayer->name; ?></td>
                            <td><?php echo $baselayer->title; ?></td>
                            <td><?php echo $baselayer->url; ?></td>
                            <td>
                                <a onclick="editlayer('<?php echo $baselayer->id; ?>dbbaselayer')" id="edit<?php echo $baselayer->id; ?>" href="#edit">Edit</a>
                                &nbsp;|&nbsp;
                                <a onclick="deletelayer('<?php echo $baselayer->id; ?>dbbaselayer')" id="remove<?php echo $baselayer->id; ?>" href="#remove">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



        <div id="overlay" >
            <h2>
                Overlay Layer
            </h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Layer Name (eg world:map)</th>
                        <th>Layer Title (eg World Map)</th>
                        <th>Url (eg http://localhost:8080/geoserver/wms)</th>

                        <th>
                            <a id="add" onclick="addlayer('overlay')" href="#add">Add Layer</a>
                        </th>
                    </tr>
                </thead>
                <tbody id="overlayHolder">



                    <?php
                    $overlayers = ORM::factory('wms_layer')->getOverlays();

                    foreach ($overlayers as $overlayer):
                        ?>
                        <tr id="<?php echo $overlayer->id; ?>dboverlayer">
                            <td><?php echo $overlayer->name; ?></td>
                            <td><?php echo $overlayer->title; ?></td>
                            <td><?php echo $overlayer->url; ?></td>
                            <td>
                                 <a onclick="editlayer('<?php echo $overlayer->id; ?>dboverlayer')" id="edit<?php echo $overlayer->id; ?>" href="#edit">Edit</a>
                                &nbsp;|&nbsp;
                                <a onclick="deletelayer('<?php echo $overlayer->id; ?>dboverlayer')" id="remove<?php echo $overlayer->id; ?>" href="#remove">Delete</a>
                            
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



        <div class="deleted">

        </div>
        <br/>
        <?php echo form::submit("submit", 'Save Layers'); ?>



        <?php echo form::close(); ?>
    </div>
</div>