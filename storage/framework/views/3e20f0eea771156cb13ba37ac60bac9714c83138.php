<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

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
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Add Group"
                            pageLink="<?php echo e(URL::route('createLookupGrpup')); ?>" data-toggle="tooltip" data-placement="left"
                            title="Add New Group" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add Group</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo e($header['tableTitle']); ?> </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- start  accordion -->
                                <div class="" id="accordion">
                                    <?php $__currentLoopData = $lookupGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lookupGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="panel-heading" style="background: #F2F5F7;
                                    padding: 13px;
                                    width: 100%;
                                    display: block; height:35px; padding-top:1px;">

                                        <div id="heading<?php echo e($key+1); ?>">
                                            <a style="text-decoration: none" class="panel-heading btn btn-link"
                                                role="tab" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse<?php echo e($key+1); ?>" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h4 class="panel-title"><?php echo e($key+1); ?>.<?php echo e($lookupGroup->LOOKUP_GRP_NAME); ?>

                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                    <hr style="margin-bottom: 0px;">
                                    <div id="collapse<?php echo e($key+1); ?>" class="panel-collapse collapse in "
                                        data-parent="#accordion" role="tabpanel" aria-labelledby="heading<?php echo e($key+1); ?>">

                                        <div class="panel">
                                            <table id="datatable"
                                                class="table table-striped table-bordered dataTable no-footer"
                                                role="grid" aria-describedby="datatable_info" width="100%"
                                                style="width: 100%;">
                                                <button style="margin-right: 16px;margin-top: 5px" type="button"
                                                    class="btn btn-danger btn-sm dynamicModal pull-right "
                                                    pageTitle="Add Group Item"
                                                    pageLink="<?php echo e(url('createLookupGroupItem/'.$lookupGroup->LOOKUP_GRP_ID.'/'.$lookupGroup->USE_CHAR_NUMB)); ?>"
                                                    data-toggle="tooltip" data-placement="left" title="Add Group Item"
                                                    data-target=".bs-example-modal-lg" style="margin-top: 10px;"
                                                    data-modal-size="modal-xl">Add
                                                    More
                                                </button>
                                                <thead>
                                                    <tr>
                                                        <!-- <th>#</th> -->

                                                        <th>Item Name</th>
                                                        <?php if($lookupGroup->USE_CHAR_NUMB=='C'): ?>
                                                        <!-- <th>Short Name(C)</th> -->
                                                        <?php else: ?>
                                                        <!-- <th>Short Name(N)</th> -->
                                                        <?php endif; ?>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $lookupGroupItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lookupGroupItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($lookupGroup->LOOKUP_GRP_ID == $lookupGroupItem->LOOKUP_GRP_ID): ?>
                                                    <tr>
                                                        <!-- <th><?php echo e($key+1); ?></th> -->

                                                        <td><?php echo e($lookupGroupItem->LOOKUP_DATA_NAME); ?></td>
                                                        <?php if($lookupGroup->USE_CHAR_NUMB=='C'): ?>
                                                        <!-- <td> <?php echo e($lookupGroupItem->CHAR_LOOKUP); ?></td> -->
                                                        <?php else: ?>
                                                        <!-- <td> <?php echo e($lookupGroupItem->NUMB_LOOKUP); ?></td> -->
                                                        <?php endif; ?>
                                                        <td><?php if($lookupGroupItem->ACTIVE_FLAG==1): ?>
                                                            <label>
                                                                <span class="btn btn-primary btn-sm">Active</span>
                                                            </label>
                                                            <?php else: ?>
                                                            <label>
                                                                <span class="btn btn-danger btn-sm">Inactive</span>
                                                            </label>
                                                            <?php endif; ?></td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-info btn-sm dynamicModal"
                                                                pageTitle="Edit Group item"
                                                                pageLink="<?php echo e(url('editLookupGroupItem/'.$lookupGroupItem->LOOKUP_DATA_ID.'/'.$lookupGroup->USE_CHAR_NUMB)); ?>"
                                                                data-modal-size="modal-xl" data-toggle="tooltip"
                                                                data-placement="top" title="Edit Group Item">
                                                                <i class="glyphicon glyphicon-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!-- end of accordion -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/lookup/index.blade.php ENDPATH**/ ?>