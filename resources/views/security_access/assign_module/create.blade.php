@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeBlock'); @endphp

<div class="flash-message"></div>
<div class="col-md-12 col-sm-12 col-lg-12">
    <div class="x_panel">
    <div class="container">

<div class="row">
 <div class="col-md-4 col-sm-4 col-lg-4">
     <p>All Module</p>    
    <select name="from[]" id="multiselectModule" class="form-control getMultipleSelectValue" size="8">
    @foreach($moules as $moule)
      <option value="{{$moule->MODULE_ID}}">{{$moule->MODULE_NAME}}</option>
      @endforeach
    </select>   
  </div>
  <div class="col-md-2 col-sm-2 col-lg-2">
  <p style="text-align:center">Action</p>
    <!-- <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button> -->
    <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
    <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
    <!-- <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button> -->
  </div>
  <div class="col-md-4 col-sm-4 col-lg-4">
  <p>Selected Module</p>
  
  <select name="from[]" id="multiselecSelectedtModule" class="form-control getMultipleSelectValue" size="8">
    @foreach($moulesIds as $moulesId)
      <option value="{{$moulesId->SA_MODULE_ID}}">{{$moulesId->SA_MODULE_NAME}}</option>
      @endforeach
    </select> 
    <!-- <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select> -->
  </div>
</div>

</div>
    </div>
</div>

<script>
  
$(document).off("click", "#multiselect_rightSelected").on("click", "#multiselect_rightSelected", function () {
    
    var module_ids = $('#multiselectModule').val();
    if(confirm("Are you want add this module!")){
    $.ajax({
            type: "POST",
            url: "addModulesInsert",
            data: {"_token": "{{ csrf_token()}}","module_ids": module_ids},
            success: function (result) {
                //alertify.alert(result);
            }
        });
      }

}); 

$(document).off("click", "#multiselect_leftSelected").on("click", "#multiselect_leftSelected", function () {
    
    var module_ids = $('#multiselecSelectedtModule').val();
    if(confirm("Are you want delete this module!")){
    $.ajax({
            type: "POST",
            url: "deleteModules",
            data: {"_token": "{{ csrf_token()}}","module_ids": module_ids},
            success: function (result) {
                //alertify.alert(result);
            }
        });
      }

});

</script>
<script src="{{ URL::asset('assets/custom_js/custom.js') }}"></script>