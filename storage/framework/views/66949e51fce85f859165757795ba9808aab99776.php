<table class="table table-responsive ">
    <tbody><tr class="info">
        <td colspan="2">
            <b>Ticket Assign Info</b>
            <?php if($result->ticket_status !='230'): ?>
            <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="<?php echo e(url('/editAssignInfo')); ?>" href="#">
                <i class="glyphicon glyphicon-pencil"></i> Edit
            </a>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td> Assign To </td>
        <td>
           <?php if(!empty($result->employee_id)): ?>
               <?php
               $empName = DB::selectOne("select employee_name from npoly_employees where employee_id = $result->employee_id");
               echo $empName->employee_name;
               ?>
            <?php else: ?>

            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td> Assign Date </td>
        <td>
            <?php if(!empty($result->assign_date)): ?>
                <?php echo e(date('d-M-Y',strtotime($result->assign_date))); ?>

            <?php else: ?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td> Forecast Date </td>
        <td>
            <?php if(!empty($result->forecast_date)): ?>
                <?php echo e(date('d-M-Y',strtotime($result->forecast_date))); ?>

            <?php else: ?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td> Work Station </td>
        <td>
            <p>
                <?php if(!empty($result->work_station)): ?>
                    <?php if($result->work_station =='1'): ?>
                        In House
                    <?php else: ?>
                        Out Side Office
                        <?php endif; ?>
                <?php else: ?>
                <?php endif; ?>
            </p>
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


<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support/ticket_assign_info.blade.php ENDPATH**/ ?>