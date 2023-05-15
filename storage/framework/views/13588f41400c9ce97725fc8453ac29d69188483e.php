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
            <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Module" pageLink="<?php echo e(URL::route('creatModuleSetup')); ?>"
              data-toggle="tooltip" data-placement="left" title="Add New Module" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New</button>

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
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
              </li>
              <li>
                <a class="close-link"></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered custom-table-border">
                      <thead style="background-color: #0b58a2; color: white">
                      <tr>
                        <th>Sl</th>
                        <th>Module Name</th>
                        <th>Short Name</th>
                        <th>Module Name Bangla</th>
                        <th>Serial No</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($result->MODULE_NAME); ?></td>
                        <td><?php echo e($result->SHORT_NAME); ?></td>
                        <td><?php echo e($result->MODULE_NAME_BN); ?></td>
                        <td><?php echo e($result->SL_NO); ?></td>
                        <td><?php if($result->ACTIVE_STATUS==1): ?>
                          <label>
                            <span type="" class="btn btn-primary btn-sm">Active</span>
                          </label>
                          <?php else: ?>
                          <label>
                            <span type="" class="btn btn-danger btn-sm">Inactive</span>
                          </label>
                          <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                          <button type="button" class="btn btn-info btn-sm dynamicModal" pageTitle="Module Edit" pageLink="<?php echo e(url('/editemoduleSetup/'.$result->MODULE_ID)); ?>"
                            data-modal-size="modal-xl" data-toggle="tooltip" data-placement="top" title="Edit Module">
                            <i class="glyphicon glyphicon-edit"></i>
                          </button>
                        </td>
                      </tr>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/modules/index.blade.php ENDPATH**/ ?>