<table class="table table-responsive ">
    <tbody><tr class="info">
        <td colspan="2">
            <b>Ticket Status Info</b>
            <?php if($result->ticket_status !='230'): ?>
            <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="<?php echo e(url('/editStatusInfo')); ?>" href="#">
                <i class="glyphicon glyphicon-pencil"></i> Edit
            </a>
             <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>Status </td>
        <td><?php echo e($result->ticketStatus); ?></td>
    </tr>
    <tr>
        <td>Type </td>
        <td><?php echo e($result->requestType); ?></td>
    </tr>
    <tr>
        <td> Priority </td>
        <td><?php echo e($result->priorityName); ?></td>
    </tr>
    <tr>
        <td>Request Mode </td>
        <td>
            <p><?php echo e($result->requestMode); ?></p>
        </td>
    </tr>
    <tr>
        <td>Resolution </td>
        <td>
            <p><?php echo e($result->resolution); ?></p>
        </td>
    </tr>
    <tr>
        <td>Remarks </td>
        <td>
            <p><?php echo e($result->remarks); ?></p>
        </td>
    </tr>
    </tbody></table>

<script>
    $('#edit_ticket_info').click(function () {

        var ticketId = $("#ticketId").val();
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: "POST",
            url: action_uri,
            data: { ticketId:ticketId,_token:'<?php echo e(csrf_token()); ?>'},
            success: function (data){
                $('.ticket-content').html(data);
            }
        });
    });
</script>


<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support/ticket_status_info.blade.php ENDPATH**/ ?>