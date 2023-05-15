 <?php $__env->startSection('content'); ?> <?php $__env->startSection('title'); ?> <?php $__env->stopSection(); ?>
<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

</style>
<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo e($header['pageTitle']); ?></h3>
            </div>
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Create New User"
                            pageLink="<?php echo e(url('/createUser')); ?>" data-modal-size="modal-xl" data-toggle="tooltip"
                            data-placement="top" title="Create User">
                            Create User
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        

                        

                       <!-- <div class="row" style="padding-top:15px">
                            <div class="col-sm-12">
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Course*</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select  class="form-control searchCourseType required" id="searchCourseType">
                                                <option value="">---Select---</option>
                                                <?php $__currentLoopData = $courseTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($c->LOOKUP_DATA_ID); ?>"><?php echo e($c->LOOKUP_DATA_NAME); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Faculty</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select  class="form-control searchDept required" id="searchDept">
                                                <option value="">---Select---</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Dept</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select  class="form-control searchCourse required" id="searchCourse">
                                            <option value="">---Select---</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <div style="display: block; color:#FFF">
                                            <a id="btnSearch" class="form-control btn btn-info">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        


                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="searchResultUser">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).on('click', '#multiselect_rightSelected', function () {
        if (confirm("Are You Sure?")) {
            var module_ids = $('#multiselectModule').val();
            // alertify.alert(module_ids)
            $.ajax({
                type: "POST",
                url: "/addModules",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "module_ids": module_ids
                },
                success: function (data) {
                    //    $("#multi-select-add-single-ids").html("");
                    //  $("#selectable-target").html(data);

                }

            });
        } else {
            return false;
        }
    });


    $(document).on('click', '#multiselect_leftSelected', function () {
        if (confirm("Are You Sure?")) {
            var module_ids_delete = $('#multiselecSelectedtModule').val();
            // alertify.alert(module_ids)
            $.ajax({
                type: "POST",
                url: "/deleteModules",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "module_ids_delete": module_ids_delete
                },
                success: function (data) {
                    //    $("#multi-select-add-single-ids").html("");
                    //  $("#selectable-target").html(data);

                }

            });
        } else {
            return false;
        }
    });

    // user searching clone from block list page

    // $(document).on('change', '#searchCourse444', function () {
    //     var type = $('#searchCourseType').val();
    //     var dept = $('#searchDept').val();
    //     var course = $('#searchCourse').val();

    //     if(type=='' || dept=='' || course==''){
    //         alertify.alert('Please, select all the fields.');
    //         return false;
    //     }else{
    //         getUser(type,dept,course);
    //     }
    // });
    // getUser(type='',dept='',course='');

    // search on user list
    $('#btnSearch').click(function(){
        var type = $('#searchCourseType').val();    // as course
        var dept = $('#searchDept').val();          // as faculty
        var course = $('#searchCourse').val();      // as dept

        if(type==''){
            alertify.alert('Please select course');
            return false;
        }else{
            getUser(type,dept,course);
        }
    });

    getUser(type='',dept='',course='');

    // get user list, with search or without search
    function getUser(type='',dept='',course=''){

        if(type=='') type=0;
        if(dept=='') dept=0;
        if(course=='') course=0;

        $('.ajaxLoaderFormLoad').show();
        $.ajax({
            type: 'GET',
            url: '<?php echo e(url("/searchUser")); ?>/'+type+'/'+dept+'/'+course,
            success: function (data) {
                $('.ajaxLoaderFormLoad').hide();
                $('#searchResultUser').html(data);
                $('#datatable').dataTable();
            }
        });
    }


    // get faculty, department by course
    var CT = $('#searchCourseType');
    var D = $('#searchDept');
    var CN = $('#searchCourse');
    D.html('<option value="">--select--</option>');
    CN.html('<option value="">--select--</option>');
    CT.change(function(){
        //$('#searchResultUser').html('');
        D.html('<option value="">--select--</option>');
        CN.html('<option value="">--select--</option>');
        var CTV = CT.val();
        if(CTV!=''){
            $.ajax({type: 'GET', url: '<?php echo e(url("/block/getDept")); ?>/'+CTV, success: function (data) {D.html(data);}});
        }
    });

    // get department by faculty
    var D = $('#searchDept');
    var CN = $('#searchCourse');
    CN.html('<option value="">--select--</option>')
    D.change(function(){
        //$('#searchResultUser').html('');
        CN.html('<option value="">--select--</option>');
        var DV = D.val();
        if(DV!=''){
            $.ajax({type: 'GET', url: '<?php echo e(url("/block/getCourse")); ?>/'+DV, success: function (data) {CN.html(data);}});
        }
    });

</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/new_user/index.blade.php ENDPATH**/ ?>