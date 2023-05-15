@section('content')
<?php ini_set('memory_limit', -1) ?>
<script>
    $('form').parsley();

</script>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 25px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
        
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: -10px !important;
        bottom: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

table td + td {
        text-align: center;
}
table td a {
        color:#1e7e34;
        font-size:15px;
        font-weight:bold;
}
table th {
        text-align: center;
}
</style>
<div class="flash-message"></div>
<div class="x_content">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <!-- start accordion -->
                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        <table class="table table-bordered custom-table-border">
                            <thead>
                                <tr>
                                    <th><strong> Module Name</strong> </th>
                                    <th><strong> Create</strong></th>
                                    <!-- <th><strong> Read</strong></th> -->
                                    <th><strong> Update</strong></th>
                                    <!-- <th><strong> Delete</strong></th> -->
                                    <th><strong>Status</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $module)
                               
                                    <tr>
                                        <td colspan="6">
                                            <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                              {{$module->MODULE_NAME}}
                                            </a>
                                        </td>
                                    </tr>
                                  @php
                                        $moduleLinks = DB::table('sa_org_mlinks')
                                        ->where('sa_org_mlinks.SA_MODULE_ID','=', $module->MODULE_ID)  
                                        ->where('sa_org_mlinks.ACTIVE_STATUS',1)
                                        ->where('sa_org_mlinks.STATUS',1)
                                        ->where('sa_org_mlinks.link_position', '=', 'L')
                                        ->get();
                                   @endphp
                                    @foreach($moduleLinks as $moduleLink)

                                    @php 
                                    $moduleLinksCheck = DB::table('sa_uglw_mlink')                                  
                                        ->where('sa_uglw_mlink.SA_MLINKS_ID', $moduleLink->SA_MLINKS_ID)
                                        ->where('sa_uglw_mlink.USERGRP_ID', $USERGRP_ID)
                                        ->where('sa_uglw_mlink.UG_LEVEL_ID', $UG_LEVEL_ID)
                                        ->first();  
                                        @endphp

                                    <tr id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingOne" data-parent="#accordion">
                                        <td class="text-right"> {{$moduleLink->SA_MLINK_NAME}} </td>
                                        <td>
                                            <label class="switch">                                           
                                            <input class="switchCreate" name="status"  id="CREATE" value="{{$moduleLink->CREATE}}"  <?php echo (!empty($moduleLinksCheck) ? ($moduleLinksCheck->CREATE == 1) ? "checked" : ""  : 0); ?>  type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <!-- <td>
                                            <label class="switch">                                           
                                            <input class="switchRead" name="status"  id="READ" value="{{$moduleLink->READ}}" <?php echo (!empty($moduleLinksCheck) ? ($moduleLinksCheck->READ == 1) ? "checked" : ""  : 0); ?>   type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td> -->
                                        <td>
                                            <label class="switch">                                           
                                            <input class="switchUpdate"  id="UPDATE" value="{{$moduleLink->UPDATE}}" <?php echo (!empty($moduleLinksCheck) ? ($moduleLinksCheck->UPDATE == 1) ? "checked" : ""  : 0); ?>   type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <!-- <td>
                                            <label class="switch">                                          
                                            <input class="switchDelete"  id="DELETE" value="{{$moduleLink->DELETE}}" <?php echo (!empty($moduleLinksCheck) ? ($moduleLinksCheck->DELETE == 1) ? "checked" : ""  : 0); ?>   type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td> -->
                                        <td>
                                        <input   type="hidden" class="SA_MLINKS"  id="" value="<?php if(!empty($moduleLinksCheck))  echo $moduleLinksCheck->SA_UGLWM_LINK; ?>"  />
                                        
                                        <input type="hidden" value="{{$moduleLink->SA_MLINKS_ID}}" class="SA_UGLWM_LINK">
                                        <input type="hidden" value="{{$module->MODULE_ID}}" class="MODULE_ID">
                                        <input type="hidden"  value="{{$moduleLink->SA_MLINKS_ID}}" />
                                        <input type="hidden" value="{{$moduleLink->LINK_ID}}" class="LINK_ID_A"> 
                                            <label class="switch">    
                                            <input class="switchStatus" id="STATUS" value="{{$moduleLink->STATUS}}" <?php echo (!empty($moduleLinksCheck) ? ($moduleLinksCheck->STATUS == 1) ? "checked" : ""  : 0); ?>  type="checkbox" />
                                                <!-- <input type="checkbox" checked> -->
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                              
                               
                            </tbody> 
                        </table>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


$(document).off("change", "#CREATE").on("change", "#CREATE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#CREATE').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        var groupName = $('#groupName').val();
        var userLevel = $('#userLevel').val();
        //alertify.alert(groupName)
        $.ajax({
            type: "POST",
            url: "modulePageLinkCreate",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK,
                "groupName" : groupName,
                "userLevel" : userLevel
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });

    
/*$(document).off("change", "#CREATE").on("change", "#CREATE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#CREATE').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        var groupName = $('#groupName').val();
        var userLevel = $('#userLevel').val();
        //alertify.alert(groupName)
        $.ajax({
            type: "POST",
            url: "modulePageLinkCreate",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK,
                "groupName" : groupName,
                "userLevel" : userLevel
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });*/



    $(document).off("change", "#READ").on("change", "#READ", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#READ').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        var groupName = $('#groupName').val();
        var userLevel = $('#userLevel').val();
        $.ajax({
            type: "POST",
            url: "modulePageLinkRead",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK,
                "groupName" : groupName,
                "userLevel" : userLevel
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });



    $(document).off("change", "#UPDATE").on("change", "#UPDATE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#UPDATE').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        var groupName = $('#groupName').val();
        var userLevel = $('#userLevel').val();
        $.ajax({
            type: "POST",
            url: "modulePageLinkUpdate",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK,
                "groupName" : groupName,
                "userLevel" : userLevel
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });


    

    $(document).off("change", "#STATUS_pp").on("change", "#STATUS_pp", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#STATUS').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        var groupName = $('#groupName').val();
        var userLevel = $('#userLevel').val();
        $.ajax({
            type: "POST",
            url: "modulePageLinkStatus",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK,
                "groupName" : groupName,
                "userLevel" : userLevel
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });


$(document).off("change", ".switchStatus").on("change", ".switchStatus", function () {
    var thisRow = $(this).closest('tr');
    var SA_MLINKS_ID = thisRow.find('.SA_MLINKS').val()
    var SA_UGLWM_LINK = thisRow.find('.SA_UGLWM_LINK').val();
    var setVaue = thisRow.find('.switchStatus').val()
    var groupName = $('#groupName').val();
    var userLevel = $('#userLevel').val(); 
    
        var LINK_ID = thisRow.find('.LINK_ID_A').val()      
      
        var MODULE_ID = thisRow.find('.MODULE_ID').val();
        if(thisRow.find('.SA_MLINKS').val() == ''){
              // alertify.alert()
    $.ajax({
            type: "POST",
            url: "insertPageLinkStatus",
            data: {"_token": "{{ csrf_token()}}","setVaue": setVaue, 
            "SA_MLINKS_ID": SA_MLINKS_ID,"groupName": groupName, "userLevel":userLevel,"MODULE_ID":MODULE_ID,"SA_UGLWM_LINK":SA_UGLWM_LINK},
            success: function (result) {
                if(result == 'Success'){
                    return;
                }else{
                    return;
                }
            }
        });

        }else{
            //alertify.alert('updaet');

        

    // alertify.alert()
    $.ajax({
            type: "POST",
            url: "changePageLinkStatus",
            data: {"_token": "{{ csrf_token()}}","setVaue": setVaue, 
            "SA_MLINKS_ID": SA_MLINKS_ID,"groupName": groupName, "userLevel":userLevel,"MODULE_ID":MODULE_ID,"SA_UGLWM_LINK":SA_UGLWM_LINK},
            success: function (result) {
                if(result == 'Success'){
                    return;
                }else{
                    return;
                }
            }
        });

    }

});



//change status switch 1 or 0
$(document).off("click", ".switchStatus").on("click", ".switchStatus", function () {
        $('input[type=checkbox][class=switchStatus]').change(function(){
            
            if($(this).is(':checked')){
                 $('input[type=checkbox][class=switchStatus]').val(1);
            }else{
                $('input[type=checkbox][class=switchStatus]').val(0);

            }
        })
});

//change delete switch 1 or 0
$(document).off("click", ".switchDelete").on("click", ".switchDelete", function () {
        $('input[type=checkbox][class=switchDelete]').change(function(){
            
            if($(this).is(':checked')){
                 $('input[type=checkbox][class=switchDelete]').val(1);
            }else{
                $('input[type=checkbox][class=switchDelete]').val(0);

            }
        })
});

//change update switch 1 or 0
$(document).off("click", ".switchUpdate").on("click", ".switchUpdate", function () {
        $('input[type=checkbox][class=switchUpdate]').change(function(){
            
            if($(this).is(':checked')){
                 $('input[type=checkbox][class=switchUpdate]').val(1);
            }else{
                $('input[type=checkbox][class=switchUpdate]').val(0);

            }
        })
});

//change read switch 1 or 0
$(document).off("click", ".switchRead").on("click", ".switchRead", function () {
        $('input[type=checkbox][class=switchRead]').change(function(){
            
            if($(this).is(':checked')){
                 $('input[type=checkbox][class=switchRead]').val(1);
            }else{
                $('input[type=checkbox][class=switchRead]').val(0);

            }
        })
});

//change create switch 1 or 0
$(document).off("click", ".switchCreate").on("click", ".switchCreate", function () {
        $('input[type=checkbox][class=switchCreate]').change(function(){
            
            if($(this).is(':checked')){
                 $('input[type=checkbox][class=switchCreate]').val(1);
            }else{
                $('input[type=checkbox][class=switchCreate]').val(0);

            }
        })
});




</script>
