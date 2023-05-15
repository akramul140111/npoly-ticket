                <table class="table table-responsive ">
                    <tbody><tr class="info">
                        <td colspan="2">
                            <b>Ticket Basic Info</b>
                            <?php if($result->ticket_status !='230'): ?>
                            <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="<?php echo e(url('/editTicketInfo')); ?>" href="#">
                                <i class="glyphicon glyphicon-pencil"></i> Edit
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Client Name </td>
                        <td><?php echo e($result->client_name); ?></td>
                    </tr>
                    <tr>
                        <td> Project Name </td>
                        <td><?php echo e($result->project_name); ?></td>
                    </tr>
                    <tr>
                        <td> Ticket Title </td>
                        <td><?php echo e($result->ticket_title); ?></td>
                    </tr>
                    <tr>
                        <td> Ticket Description </td>
                        <td>
                            <p><?php echo e($result->ticket_desc); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Ticket Create Date and Time</td>
                        <td><?php echo e(date('d-M-Y H:i A',strtotime($result->created_at))); ?></td>

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


<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support/ticket_basic_info.blade.php ENDPATH**/ ?>