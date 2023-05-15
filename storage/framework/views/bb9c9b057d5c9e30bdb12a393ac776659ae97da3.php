<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="datatable"
                class="table table-striped table-bordered custom-table-border dataTable no-footer"
                role="grid" aria-describedby="datatable_info">
                <thead style="background-color: #0b58a2; color: white">
                    <tr>
                        <th class="center">#</th>
                        <th class="center">Name</th>
                        <th class="center">Phone</th>
                        <th class="center">User name</th>
                        <th class="center">Dept</th>
                        <th class="center">Email</th>
                        <th class="center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1?> <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($sl); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->contact_no); ?></td>
                        <td style="color:blue"><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->department); ?></td>
                        <td><?php echo e($user->email_address); ?></td>
                        <td>
                            <?php if($user->active_status == 1): ?>
                            <label>
                                <span type="" class="btn btn-primary btn-sm">Active</span>
                            </label>
                            <?php else: ?>
                            <label>
                                <span type="" class="btn btn-primary btn-sm">Inactive</span>
                            </label>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $sl++;?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/new_user/searchResult.blade.php ENDPATH**/ ?>