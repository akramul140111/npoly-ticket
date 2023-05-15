@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateSubMenuInfo',[$subMenus->sub_menu_id]); @endphp
<style>

</style>
  <div class="flash-message"></div>
    <div class="x_content">
                <form id="informationForm" data-toggle="validator" role="form" method="post" action="{{$actionUrl}}"  class="form-label-left">
                @csrf
                    <!-- <span class="section">Create Top Menu</span> -->
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu<span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="menu_id" id="main_menu">
                            <option value="">--select--</option>
                            @foreach($menus as $menuResult)
                                    <option value="{{$menuResult->menu_id}}" {{$menuResult->menu_id==$subMenus->menu_id?'selected':''}}>{{$menuResult->menu_name}}</option>
                                    @endforeach
                        </select>
                       </div>
                    </div>
                    <div class="field item form-group subMenuDiv">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Sub Menu<span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select  class="form-control" name="parent_id" id="sub_menu_id">
                                @foreach($subMenuList as $sbList)
                                    <option value="{{$sbList->sub_menu_id}}" @if($sbList->sub_menu_id ==$subMenus->parent_id) selected @endif>{{$sbList->sub_menu_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Sub Menu Name<span class="required input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control input-field-required-sign required" value="{{$subMenus->sub_menu_name}}" data-validate-length-range="6" data-validate-words="2" name="sub_menu_name" placeholder="" />                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Description </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text"  value="{{$subMenus->menu_description}}" name="menu_description"></div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Type <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="menu_type">                      
                                <!-- <option value="1" {{$subMenus->menu_type==1?'selected':''}}>Menu</optin> -->
                                <option value="2" {{$subMenus->menu_type==2?'selected':''}}>Upper Menu</optin>
                                <option value="3" {{$subMenus->menu_type==3?'selected':''}}>Sub Menu</optin>                                                               
                                <option value="5" {{$subMenus->menu_type==5?'selected':''}}>Dropdonw Sub Menu</optin>
                                <option value="4" {{$subMenus->menu_type==4?'selected':''}}>Menu Under Sub Menu</optin>
                                <option value="6"{{$subMenus->menu_type==6?'selected':''}}>Footer</optin>                              
                           </select>
                       </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="active_status">
                                <option value="1" {{$subMenus->activea_status==1?'selected':''}}>Active</optin>
                                <option value="0" {{$subMenus->active_status==0?'selected':''}}>Inactive</optin>
                           </select>
                       </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Serial<span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <input type="number" name="menu_serial_id" value="{{$subMenus->menu_serial_id}}" class="form-control">
                            <input type="hidden" id="parentID" value="{{$subMenus->parent_id}}">
                       </div>
                    </div>
                           <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button   type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>
                </form>
            </div>
        <script>  
  </script>

<script>
    $(document).ready(function () {
        var parentID = $('#parentID').val();
        if(parentID ==""){
            $('.subMenuDiv').hide();
        }
    })
</script>

<script>
    $(document).on('change','#main_menu',function () {
        var menuId = $(this).val();
        //var menuName = $("#main_menu option:selected").text();
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var my_url = '<?php echo url("/get_submenus"); ?>';
        $.ajax({
            url: my_url,
            type: 'post',
            //data: {menuId:menuId,_token:CSRF_TOKEN},
            data: {"menuId": menuId, "_token": "{{ csrf_token() }}"},
            dataType: 'json',
            success:function(response){
                var len = response.length;
                $("#sub_menu_id").empty();
                if(len == 0){
                    // $("#sub_menu_id").append("<option value='"+menuId+"'>"+menuName+"</option>");
                    $('.subMenuDiv').hide();
                }else{
                    $('.subMenuDiv').show();
                    for( var i = 0; i<len; i++){
                        var id = response[i]['sub_menu_id'];
                        var name = response[i]['sub_menu_name'];
                        if(i == 0) {
                            $("#sub_menu_id").html("<option value=''>Select One</option>");
                        }
                        $("#sub_menu_id").append("<option value='"+id+"'>"+name+"</option>");

                    }
                }

            }
        });
    })
</script>

