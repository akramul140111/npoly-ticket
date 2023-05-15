<table id="datatable" class="table table-striped table-bordered dataTable"
       role="grid" aria-describedby="data-table-info" width="100%">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Technical SR #</th>
        <th>Product</th>
        <th>Severity</th>
        <th>Contact</th>
        <th>Status</th>
        <th>Last Update</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($key+1); ?></td>
            <td>
                <a style="color: #00b1ff" href="<?php echo e(url('/getTicketDetailsInfo/'.$value->id)); ?>" class=" btn dynamicModal" data-target=".bs-example-modal-lg" data-modal-size="modal-xl"><?php echo e($value->ticket_no); ?></a>

            </td>
            <td><?php echo e($value->module_name); ?></td>
            <td><?php echo e($value->priorityName); ?></td>
            <td>
                <?php if(!empty($value->contact_person)): ?>
                    <?php
                        $contactPerson = DB::selectOne("select employee_name from npoly_employees where employee_id = $value->contact_person");
                        echo $contactPerson->employee_name;
                    ?>
                <?php endif; ?>
            </td>
            <td><?php echo e($value->ticketStatus); ?></td>
            <td><?php if(!empty($value->updated_at)): ?><?php echo e(date('d-M-Y h:i:A',strtotime($value->updated_at))); ?><?php endif; ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>

<script>
    $(document).ready(function(){
        setTimeout(function() {
            $("<div style='padding-left: 30px !important;'><i class='fa fa-file-text-o btn changeTicketInfo' style='padding-left: 30px !important; margin-top: 10px'></i></div>").insertAfter(".dataTables_length");
        }, 100);
    })
</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support_user/getCloseTicket.blade.php ENDPATH**/ ?>