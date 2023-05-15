<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Task Report</title>
    <style>


        .cell {
            border-collapse: collapse;
            border: 1px solid #ddd;
            padding: 5px 10px;
            margin-right: 5px;

        }

        .table {
            border-collapse: collapse;
            border-style: hidden;


        }

        .table tr:last-child td {
            border-bottom: none;
        }

    </style>
</head>
<body style="margin:0px; padding:0px; border: 0 none;width: 100%; font-size: 14px; font-family: verdana, sans-serif; background-color: #efefef;">
<table style="border-collapse: collapse;   border: 1px #ccc solid; background: #fff; font-size: 11px; font-family: verdana, sans-serif;" align="center">
    <tbody>
    <tr>
        <td style="padding: 9px; color: #fff; background: #1B3073;" colspan="2">
            <!-- This is the sentence right under the image/logo. -->
            <p style=" color: #ccc;margin-top:0px;margin-bottom:0px; font-size: 16px;">
                Task Assign Info :: <?php echo date('d-F-Y'); ?>
            </p>
        </td>



    </tr>
    <tr>
        <td style="padding: 9px ;">
            <!-- This is the sentence right under the image/logo. -->
            <table border="0" cellpading="0" cellspacing="0">
                <tr>
                    <td>
                        <b>
                            Professional Information
                        </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo e($empInfo->employee_name); ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo e($empInfo->department_name); ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo e($empInfo->designation_name); ?>

                    </td>
                </tr>
            </table>
        </td>
        <td></td>
        <!-- Address info -->
    </tr>

    <tr>
        <td   style="padding: 9px;">
            <!-- This is the sentence right under the image/logo. -->
            <p style="margin-top:0px;margin-bottom:0px; font-size: 16px;"># Task Details :</p>
        </td>

        <td style="padding: 9px;float: right !important; text-align: right; ">
  <span style="font-size: 16px;display: inline-block; float: right !important; text-align: right !important; clear: both; ">

 </span>
        </td>
    </tr>

    <tr >
        <td colspan="2" style="padding: 9px" >
            <table border="1" cellpading="0" cellspacing="0" >
                <tr style="background-color:#d1d1e0">
                    <th>Project</th>
                    <th>Task title</th>
                    <th>Priority</th>
                    <th>Task Status (%)</th>
                    <th>Assigned By</th>
                    <th>Assigned Date</th>
                    <th>Forecast Date</th>
                </tr>

                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding-left: 5px;"><?php echo e($value->project_name); ?></td>
                        <td style="padding-left: 5px;"><?php echo e($value->task_title); ?></td>
                        <td style="padding-left: 5px;"><?php echo e('3- Standard'); ?></td>
                        <td style="text-align:center;"><?php echo e($value->task_complete); ?></td>
                        <td style="text-align:center;">
                            <?php
                                $assignBy = DB::table('npoly_employees')->select('employee_name')->where('employee_id',$value->assign_by)->first();
                                echo $assignBy->employee_name;
                            ?>
                        </td>
                        <td style="text-align:center;"><?php echo e(date('d-M-y',strtotime($value->assign_date))); ?></td>
                        <td style="text-align:center;"><?php echo e(!empty($value->forecast_date)?date('d-M-y',strtotime($value->forecast_date)):''); ?></td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <br><br><br><br>

        </td>
    </tr>

    <tr>
        <td colspan="" style="padding: 9px; color: #fff; background: #1B3073;">
            <p style="display: inline-block; float: left; font-size: 16px; color: #ccc; margin: 0px;">NPOLY Group</p>
        </td>
        <td style="padding: 9px; color: #fff; background: #1B3073;">
            <p style="display: inline-block; float: right; text-align:right; margin: 0px;">
                Copyright &copy; 2023. NPOLY GROUP. All rights reserved.<br /><small>Please do not reply this email.</small>
            </p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/emails/task_assign_mail.blade.php ENDPATH**/ ?>