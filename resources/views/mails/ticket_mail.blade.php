<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Attachment</title>
</head>
<body style="margin:0px; padding:0px; border: 0 none; font-size: 14px; font-family: verdana, sans-serif; background-color: #efefef;">

<table style="    border-collapse: collapse; width: 750px;  border: 1px #ccc solid; background: #fff; font-size: 11px; font-family: verdana, sans-serif;" align="center">
    <!-- This is the very top blue part of the template. Replace colors and image/logo in the lines below. Best image size would be 308x55 or similar. -->
    <tbody>
    <tr style="  color: #fff; background: #1B3073;  ">
        <td   style="padding: 9px;   width: 250px;">
            <!-- This is the sentence right under the image/logo. -->
            <p style="width:100%; color: #ccc;margin-top:0px;margin-bottom:0px; font-size: 16px;">New Ticket </p>

        </td>
        <!-- <td  style="padding: 9px;width: 500px;">
        <p style="font-size: 16px;margin-bottom:0px;color: #ccc;display: inline-block; float: right; text-align:right; margin: 0px;"></p> Ticket NO :: <?php //echo $ticket_id;?>
            </td> -->
        <td style="padding: 9px; color: #fff; background: #1B3073; width: 500px;">
            <p style="font-size: 16px; color: #ccc; display: inline-block; float: right; text-align:right; margin: 0px;">Ticket No :: {{$results->ticket_no}}</p>
        </td>
    </tr>

    <tr style="padding: 10px;">


        <td style="width: 250px; vertical-align: top;">
            <div style="margin:15px 8px 15px;padding: 9px; border: 1px #ccc solid;">
                <strong style="font-size: 13px; color: #1B3073;">Module Name: </strong><?php //echo $ticket_id;?>
                <hr style="height: 1px; color: #ccc;" />
                {{$results->module_name}} <br/>
                <br/><br/>
                <strong style="font-size: 13px; color: #1B3073;">Ticket Details: </strong><?php //echo $ticket_id;?>
                <hr style="height: 1px; color: #ccc;" />
                <strong style="font-size: 12px;    line-height: 15px;">Priority:</strong> {{$results->priority_name}} <br/>
                <strong style="font-size: 12px;    line-height: 15px;">Status:</strong> {{$results->ticket_status}}<br/>
                <strong style="font-size: 12px;    line-height: 15px;">Type:</strong> <br/>
                <strong style="font-size: 12px;    line-height: 15px;">Ticket Date:</strong>  <br/>
                <br/><br/>
                <strong style="font-size: 13px; color: #1B3073;">Requester Information:</strong><hr/>
                <strong style="font-size: 12px; line-height: 15px;">Created By:</strong> <br/>
                <strong style="font-size: 12px; line-height: 15px;">Designation:</strong> <br/>
                <strong style="font-size: 12px; line-height: 15px;">Contact No:</strong> <br/>
                <strong style="font-size: 12px; line-height: 15px;">Email:</strong> <br/>
                {{--<strong style="font-size: 12px; line-height: 15px;">Mode of Request:</strong> <br/>--}}
                <strong style="font-size: 12px; line-height: 15px;">Mode of Request:</strong> <br/>

                <br />
                <br/>
            </div>
        </td>
        <td style="width: 500px;  vertical-align: top;">
            <div style="margin:15px 8px 15px;padding: 9px; ">
                <strong style="font-size: 13px;">Title:</strong> {{$results->ticket_title}}<br />
                <hr />
                <strong style="font-size: 13px;">Description:</strong>
                <p style="font-size: 11px;">{{$results->ticket_desc}}</p>
            </div>
        </td>
    </tr>

    <tr>
        <td colspan="" style="padding: 9px; color: #fff; background: #1B3073;">
            <p style="display: inline-block; float: left; font-size: 16px; color: #ccc; margin: 0px;">NPOLY</p>

        </td>
        <td style="padding: 9px; color: #fff; background: #1B3073;">
            <p style="display: inline-block; float: right; text-align:right; margin: 0px;">Copyright &copy; {{ date('Y') }}. NPOLY GROUP. All rights reserved.<br /><small>Please do not reply this email.</small></p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
