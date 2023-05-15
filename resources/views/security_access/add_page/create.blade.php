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
                                    <th><strong> Read</strong></th>
                                    <th><strong> Update</strong></th>
                                    <th><strong> Delete</strong></th>
                                    <th><strong>Status</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $module)
                                <div class="panel">
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
                                        ->get();
                                   @endphp
                                    @foreach($moduleLinks as $moduleLink)

                                    <tr id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingOne" data-parent="#accordion">
                                        <td class="text-right"> {{$moduleLink->SA_MLINK_NAME}} </td>
                                        <td>
                                            <label class="switch">                                           
                                            <input class="switchCreate" name="status"  id="CREATE" value="{{$moduleLink->CREATE}}" @if($moduleLink->CREATE==1) checked @endif  type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">                                           
                                            <input class="switchRead" name="status"  id="READ" value="{{$moduleLink->READ}}" @if($moduleLink->READ==1) checked @endif  type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">                                           
                                            <input class="switchUpdate"  id="UPDATE" value="{{$moduleLink->UPDATE}}" @if($moduleLink->UPDATE==1) checked @endif  type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">                                          
                                            <input class="switchDelete"  id="DELETE" value="{{$moduleLink->DELETE}}" @if($moduleLink->DELETE==1) checked @endif  type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                        <input type="hidden"  class="SA_MLINKS"  value="{{$moduleLink->SA_MLINKS_ID}}" />
                                            <label class="switch">    
                                            <input class="switchStatus" id="STATUS" value="{{$moduleLink->STATUS}}" @if($moduleLink->STATUS==1) checked @endif  type="checkbox" />
                                                <!-- <input type="checkbox" checked> -->
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </div>
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

$(document).off("change", "#DELETE").on("change", "#DELETE", function () {
    //alertify.alert('dd')
    var thisRowU = $(this).closest('tr');
    var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
    var setDelete = thisRowU.find('#DELETE').val();
    $.ajax({
            type: "POST",
            url: "changePageLinkDelete",
            data: {"_token": "{{ csrf_token()}}","setDelete": setDelete, "SA_MLINKS_ID": SA_MLINKS_ID},
            success: function (result) {
                //alertify.alert(result);
            }
        });

}); 
$(document).off("change", "#READ").on("change", "#READ", function () {
    //alertify.alert('dd')
    var thisRowU = $(this).closest('tr');
    var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
    var setRead = thisRowU.find('#READ').val();
    $.ajax({
            type: "POST",
            url: "changePageLinkRead",
            data: {"_token": "{{ csrf_token()}}","setRead": setRead, "SA_MLINKS_ID": SA_MLINKS_ID},
            success: function (result) {
                //alertify.alert(result);
            }
        });

}); 

$(document).off("change", "#CREATE").on("change", "#CREATE", function () {
    //alertify.alert('dd')
    var thisRowU = $(this).closest('tr');
    var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
    var setCreate = thisRowU.find('#CREATE').val();
    $.ajax({
            type: "POST",
            url: "changePageLinkCreate",
            data: {"_token": "{{ csrf_token()}}","setCreate": setCreate, "SA_MLINKS_ID": SA_MLINKS_ID},
            success: function (result) {
                //alertify.alert(result);
            }
        });

});



$(document).off("change", "#UPDATE").on("change", "#UPDATE", function () {
    //alertify.alert('dd')
    var thisRowU = $(this).closest('tr');
    var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
    var setUpdate = thisRowU.find('#UPDATE').val();
    $.ajax({
            type: "POST",
            url: "updatePageLink",
            data: {"_token": "{{ csrf_token()}}","setUpdate": setUpdate, "SA_MLINKS_ID": SA_MLINKS_ID},
            success: function (result) {
                //alertify.alert(result);
            }
        });

});

$(document).off("change", ".switchStatus").on("change", ".switchStatus", function () {
    var thisRow = $(this).closest('tr');
    var SA_MLINKS_ID = thisRow.find('.SA_MLINKS').val()
    var setVaue = thisRow.find('.switchStatus').val()
    $.ajax({
            type: "POST",
            url: "changePageLinkStatus",
            data: {"_token": "{{ csrf_token()}}","setVaue": setVaue, "SA_MLINKS_ID": SA_MLINKS_ID},
            success: function (result) {
                if(result == 'Success'){
                    return;
                }else{
                    return;
                }
            }
        });

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
