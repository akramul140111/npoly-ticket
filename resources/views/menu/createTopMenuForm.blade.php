@include('layouts.modalFormSubmit')
@php $actionUrl=url('/saveTomMenuInformation'); @endphp

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
                            <input class="form-control input-field-required-sign required" data-validate-length-range="6" data-validate-words="2" name="menu_name" placeholder="" />                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Description </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text"  name="menu_description"></div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Type <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="menu_type">
                                <option value="1">Top Menu</optin>
                                <option value="2">Upper Menu</optin>
                                <option value="2">Footer</optin>
                           </select>
                       </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select  class="form-control" name="active_status">
                                <option value="1">Active</optin>
                                <option value="0">Inactive</optin>
                           </select>
                       </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Menu Serial<span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <input type="number" name="menu_serial_id" class="form-control">
                       </div>
                    </div>
<!--
                     <button class="btn btn-secondary source" onclick="new PNotify({
                                  title: 'Regular Success',
                                  text: 'That thing that you were trying to do worked!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });">Success</button>            -->

                              <div class="clearfix"></div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button action="{{$actionUrl}}"  type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>

                </form>
            </div>
            <!-- <script src="{{ URL::asset('assets/vendors/validator/multifield.js')}}"></script>
            <script src="{{ URL::asset('assets/vendors/validator/validator.js')}}"></script>   -->
        <script>
  
  </script>


