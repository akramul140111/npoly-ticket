@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateMenuInfo',[$menu->menu_id]); @endphp
<style>
body {
    padding: 20px;
}
label {
    display: block;
}
input.error {
    border: 1px solid red;
}
label.error {
    font-weight: normal;
    color: red;
}
button {
    display: block;
    margin-top: 20px;
}
</style>
  <div class="flash-message"></div>
    <div class="x_content">
                <form id="informationForm" data-toggle="validator" role="form" method="post" action="{{$actionUrl}}"  class="form-label-left">
                @csrf
                    <!-- <span class="section">Create Top Menu</span> -->
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Name<span class="required input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control input-field-required-sign required" value="{{$menu->menu_name}}" data-validate-length-range="6" data-validate-words="2" name="menu_name" placeholder="" /></div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Description </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text"  value="{{$menu->menu_description}}" name="menu_description"></div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Type <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="menu_type">                      
                                <option value="1" {{$menu->menu_type==1?'selected':''}}>Top Menu</optin>
                                <option value="2" {{$menu->menu_type==1?'selected':''}}>Upper Menu</optin>
                                <option value="3"{{$menu->menu_type==1?'selected':''}}>Footer</optin>                              
                           </select>
                       </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="active_status">
                                <option value="1" {{$menu->activea_status==1?'selected':''}}>Active</optin>
                                <option value="0" {{$menu->active_status==0?'selected':''}}>Inactive</optin>
                           </select>
                       </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Serial<span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <input type="number" name="menu_serial_id" value="{{$menu->menu_serial_id}}" class="form-control">
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

