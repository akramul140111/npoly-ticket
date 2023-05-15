<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

    table.dataTable tbody tr td {
        word-wrap: break-word;
        word-break: break-all;
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
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Module Link"
                            pageLink="<?php echo e(URL::route('createModuleLinkSetup')); ?>" data-toggle="tooltip"
                            data-placement="left" title="Add New Module" data-target=".bs-example-modal-lg"
                            data-modal-size="modal-xl">Add New</button>
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
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable"
                                        class="table table-striped table-bordered custom-table-border">
                                        <thead style="background-color: #0b58a2; color: white">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Link Name</th>
                                                <th>Module Name</th>
                                                <th>Link Uri</th>
                                                <th> Url Class</th>
                                                <th>Url Function</th>
                                                <th>Url Name</th>
                                                <th>Url Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($moduleLinks)): ?>
                                            <?php $__currentLoopData = $moduleLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $moduleLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($moduleLink->SA_MLINK_NAME); ?></td>
                                                <td><?php echo e($moduleLink->moduleName); ?></td>
                                                <td><?php echo e($moduleLink->URL_URI); ?></td>
                                                <td style="width: 25%"><?php echo e($moduleLink->url_class); ?></td>
                                                <td><?php echo e($moduleLink->url_function); ?></td>
                                                <td><?php echo e($moduleLink->url_name); ?></td>
                                                <td><?php echo e($moduleLink->url_type); ?></td>

                                                <td style="width: 9%"><?php if($moduleLink->STATUS==1): ?>
                                                    <label>
                                                        <span type="button" class="btn btn-primary btn-sm">Active</span>
                                                    </label>
                                                    <?php else: ?>
                                                    <label>
                                                        <span type="button"
                                                            class="btn btn-danger btn-sm">Inactive</span>
                                                    </label>
                                                    <?php endif; ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                        pageTitle="Module Edit"
                                                        pageLink="<?php echo e(url('/editModuleLinkSetup/'.$moduleLink->SA_MLINKS_ID)); ?>"
                                                        data-modal-size="modal-xl" data-toggle="tooltip"
                                                        data-placement="top" title="Edit Module Link">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/modules_links/index.blade.php ENDPATH**/ ?>