<?php
use \App\Models\academic_officer\BlockModel;
use \App\Models\TeaBlockPlacementModel;
use \App\Models\TeaBlockPlacementChdModel;
?>
@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=''; @endphp
<script>$('form').parsley();</script>
<?php $curDate = date('Y-m-d'); ?>
<?php ini_set('memory_limit', -1) ?>
  <div class="flash-message"></div>
    <div class="x_content">
        <!-- <div class="row">
            <div class="col-md-12 btn-box">
                <div class="col-md-2 col-sm-3">
                    <button class="btn btn-sm" style="background-color:#9CB381;">Green</button> = Complete
                </div>
                <div class="col-md-2 col-sm-3">
                    <button class="btn btn-sm" style="background-color:#FFAC40;">Orange</button> = Running
                </div>
                <div class="col-md-2 col-sm-3">
                    <button class="btn btn-sm" style="background-color:#f98997;">Red</button> = Gap/Failed
                </div>
                <div class="col-md-2 col-sm-3">
                    <button class="btn btn-sm" style="background-color:#FFFFFF;">White</button> = Incomplete
                </div>
            </div>
        </div> -->
        <div class="row">
            <table class="assign-head-tbl">
                <tr>
                    <td>Name: <span class="indt">{{$infoStudent->students_name}}</span></td>
                    <td>ID: <span class="indt">{{$infoStudent->email}}</span></td>
                    <td>Session: <span class="indt">{{$infoStudent->SESSION}}</span></td>
                    <td>Batch: <span class="indt">{{$infoStudent->BATCH}}</span></td>
                    <td>Parent Course: <span class="indt">{{$infoStudent->COURSE_TYPE}}</span></td>
                </tr>
            </table>
        </div>
        <form id="AssignBlockPlacement" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        
        <table class="table table-bordered dataTable text-align-center" id="assign-tbl">
            <tbody>
                <tr class="row1">
                    <th colspan="10" style="text-align:center" class="tbl-header-span">
                        <?php
                        if($student_id){
                            $info = DB::table('stu_students_information')->select('course_name')->where('student_id', $student_id)->first();
                            if(!empty($info) && !empty($cc = $info->course_name)){
                                $data = DB::table('sa_lookup_data')->select('LOOKUP_DATA_NAME')->where('LOOKUP_DATA_ID', $cc)->first();
                                if($data)
                                    echo 'Department: '. $data->LOOKUP_DATA_NAME;
                            }
                        }
                        ?>
                    </th>
                </tr>
                <tr class="row2">
                    @if($blocks)
                        <!-- <input type="text" id="" value=""> -->
                        @if(sizeof($blocks) > 0)
                            <script>$('.tbl-header-span').attr('colspan',{{sizeof($blocks)}});</script>
                        @endif
                        @foreach ($blocks as $block)
                            
                            <td>
                                {{$block->BLOCK_NAME}}<br>
                                {{($block->duration_from)? date("M y", strtotime($block->duration_from)):''}}
                               <i style="color:red" class="fa fa-long-arrow-right"></i> 
                                {{($block->duration_to)? date("M y", strtotime($block->duration_to)):''}}
                            </td>
                        @endforeach
                    @endif
                </tr>
                <tr class="row9">
                    @if($blocks)
                        @foreach ($blocks as $block)
                            <td>
                                <?php

                                    $subBlock = DB::table('aca_create_sub_block as dt1')
                                    ->leftJoin('sa_lookup_data as dt2', 'dt1.department', '=', 'dt2.LOOKUP_DATA_ID')
                                    ->Where('dt1.block_id', '=',$block->block_id)
                                    //->select('dt1.*','dt2.LOOKUP_DATA_NAME AS DEPARTMENT','dt1.place_course AS PCOURSE_ID')
                                    ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS DEPARTMENT','dt1.place_course AS PCOURSE_ID','dt1.place_department AS PDEPT_ID')
                                    ->get();

                                    if($subBlock){
                                        $rowSize = 100/count($subBlock);
                                        $t = 1;
                                        foreach ($subBlock as $sb){  
                                            
                                            //echo $sb->sub_block_id;

                                            // sub block data
                                            if(!empty($sb->duration_from) && !empty($sb->duration_to)){
                                                $date1 = date('d-M', strtotime($sb->duration_from));
                                                $date2 = date('d-M', strtotime($sb->duration_to));


                                                // block data in sub block part
                                                if(!empty($sb->block_id) && $blockData = BlockModel::where(['block_id' => $sb->block_id])->first()){
                                                    ?>                                                
                                                    <input type="hidden" name="place_department[]" value="{{$sb->PDEPT_ID}}">
                                                    <input type="hidden" name="place_course[]" value="{{$sb->PCOURSE_ID}}">
                                                    <input type="hidden" name="duration_start[]" value="{{$blockData->duration_from}}">
                                                    <input type="hidden" name="duration_end[]" value="{{$blockData->duration_to}}">
                                                    <input type="hidden" name="phase[]" value="{{$blockData->phase}}">
                                                    <input type="hidden" name="current_block_ID[]" value="{{$blockData->block_id}}">
                                                    <input type="hidden" name="sub_block_id[]" value="{{$sb->sub_block_id}}">
                                                    <input type="hidden" name="has_sub[]" value="{{$sb->has_sub}}">
                                                    <input type="hidden" name="duration_start_sub_block[]" value="{{$sb->duration_from}}">
                                                    <input type="hidden" name="duration_end_sub_block[]" value="{{$sb->duration_to}}">
                                                    <?php
                                                    $blockID = $blockData->block_id;

                                                    $sbChecking = TeaBlockPlacementChdModel::where(['sub_block' => $sb->sub_block_id, 'current_block' => $blockID, 'student_id' => $student_id])->select('clearance_status','id')->first();
                                                                       
                                                    if($sbChecking){                                                        
                                                        ?>

                                                        @php
                                                        $clearanceInfo = DB::table('tea_block_clearance')->where('block_placement_chd_id', $sbChecking->id)->select('*')->first();
                                                        @endphp                                                        
                                                        
                                                        @if(!empty($clearanceInfo) && $clearanceInfo->eoba_status==1)   
                                                        
                                                        <?php
                                                        //echo '<pre>';
                                                        //var_dump($clearanceInfo->eoba_status);
                                                        ?>

                                                            @if($sbChecking->clearance_status==2)
                                                                <script>
                                                                    // Gap color - light red
                                                                    //$("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#F98997"});
                                                                </script> 
                                                            @elseif($sbChecking->clearance_status==1)
                                                                <script>
                                                                    // complete color - green
                                                                    //$("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#9CB381"});
                                                                </script>
                                                            @else
                                                                <script>
                                                                    // running color - orange
                                                                    $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFAC40"});
                                                                </script> 
                                                            @endif
                                                            
                                                        @else

                                                            <script>
                                                                // running color - orange
                                                                $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFAC40"});
                                                            </script> 

                                                        @endif

                                                        
                                                        <!-- @if($sbChecking->clearance_status==2)
                                                            <script>
                                                                // Gap color - light red
                                                                $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#F98997"});
                                                            </script> 
                                                        @elseif($sbChecking->clearance_status==1)
                                                            <script>
                                                                // complete color - green
                                                                $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#9CB381"});
                                                            </script>
                                                        @else
                                                            <script>
                                                                // running color - orange
                                                                $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFAC40"});
                                                            </script> 
                                                        @endif -->

                                                    <?php
                                                    }else{
                                                        
                                                        if(strtotime($curDate) >= strtotime($sb->duration_from) && strtotime($curDate) <= strtotime($sb->duration_to)){
                                                            ?>
                                                            <script>
                                                                // Current Color
                                                                //$("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFAC40"});
                                                                //elementColor("#tabBag_{{$blockID}}_{{$t}}","#FFAC40");
                                                            </script>
                                                        <?php
                                                        }else{ ?>
                                                            
                                                            <script>
                                                                // NO TBL DATA
                                                                //$("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFFFFF"});
                                                            </script>

                                                        <?php

                                                        }
                                                        
                                                        
                                                    }
                                                }


                                                ?>
                                                <div id="tabBag_{{$blockID}}_{{$t}}" style="float:left; border:1px solid #DDDDDD;padding: 12px 2px !important;width:<?=$rowSize?>%">
                                                   {{$date1}} <i style="color:green" class="fa fa-long-arrow-right"></i>  {{$date2}}
                                                </div>
                                                <?php
                                            }
                                            $t=$t+1;
                                        }
                                    }
                                ?>
                            </td>
                        @endforeach
                    @endif
                </tr>
                <tr class="row9">
                    @if($blocks)
                        @foreach ($blocks as $block)
                            <td>
                                <?php
                                    $subBlock = DB::table('aca_create_sub_block as dt1')
                                    ->leftJoin('sa_lookup_data as dt2', 'dt1.place_course', '=', 'dt2.LOOKUP_DATA_ID')
                                    ->leftJoin('sa_lookup_data as dt3', 'dt1.place_department', '=', 'dt3.LOOKUP_DATA_ID')
                                    ->Where('dt1.block_id', '=',$block->block_id)
                                    ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS PLACE_COURSE','dt3.LOOKUP_DATA_NAME AS PLACE_DEPARTMENT')
                                    ->get();

                                    if($subBlock){
                                        $rowSize = 100/count($subBlock);
                                        $t = 1;
                                        foreach ($subBlock as $sb){     
                                            
                                            
                                            // START IN SB TEMP

                                            if(!empty($sb->duration_from) && !empty($sb->duration_to)){

                                                

                                                // block data in sub block part
                                                if(!empty($sb->block_id) && $blockData = BlockModel::where(['block_id' => $sb->block_id])->first()){
                                                    
                                                    $blockID = $blockData->block_id;

                                                    $sbChecking = TeaBlockPlacementChdModel::where(['sub_block' => $sb->sub_block_id, 'current_block' => $blockID, 'student_id' => $student_id])->first();
                                                    if($sbChecking){                                                  
                                                        ?>
                                                        <script>
                                                            // HAVE TBL DATA
                                                            //$("#tabBag_{{$blockID}}_DD_{{$t}}").css({"background-color": "#9CB381"});
                                                        </script>

                                                    <?php
                                                    }else{ // NO TBL DATA

                                                        if(strtotime($curDate) >= strtotime($sb->duration_from) && strtotime($curDate) <= strtotime($sb->duration_to)){?>
                                                            <script>
                                                                //$("#tabBag_{{$blockID}}_DD_{{$t}}").css({"background-color": "#FFAC40"});
                                                            </script>
                                                            <?php
                                                        }else{ ?>
                                                            
                                                            <script>
                                                                // NO TBL DATA
                                                                //$("#tabBag_{{$blockID}}_DD_{{$t}}").css({"background-color": "#FFFFFF"});
                                                            </script>

                                                            <?php
                                                        }





                                                    
                                                    }
                                                }?>
                                                
                                                <!-- Sub Block Data -->
                                                <div id="tabBag_{{$blockID}}_DD_{{$t}}" style="font-size:10px;font-weight:bold;word-break: break-all;float:left; padding: 6px 2px !important;border:1px solid #ccc;width:<?=$rowSize?>%">
                                                    <?php
                                                    /*if($sb->has_sub==1){
                                                        //echo $sb->DEPARTMENT;
                                                        if($sb->DEPARTMENT){
                                                            echo nl2br(str_replace(' ','<br>',$sb->DEPARTMENT));
                                                        }
                                                        
                                                    }else{
                                                        //echo $sb->PLACE_COURSE;
                                                        if($sb->PLACE_COURSE){
                                                            echo nl2br(str_replace(' ','<br>',$sb->PLACE_COURSE));
                                                        }
                                                    }*/

                                                    if($sb->PLACE_DEPARTMENT){
                                                        echo nl2br(str_replace(' ','<br>',$sb->PLACE_DEPARTMENT));
                                                    }
                                                    ?>
                                                </div>
                                                <?php

                                            }

                                            
                                            $t=$t+1;
                                            
                                            // END IN SB TEMP
                                            

                                            
                                        }
                                    }
                                ?>
                            </td>
                        @endforeach
                    @endif
                </tr>
                <tr class="row9">
                    @if($blocks)
                        @foreach ($blocks as $block)
                            <td>
                                <?php
                                    $subBlock = DB::table('aca_create_sub_block as dt1')
                                    ->leftJoin('sa_lookup_data as dt2', 'dt1.place_course', '=', 'dt2.LOOKUP_DATA_ID')
                                    ->leftJoin('sa_lookup_data as dt3', 'dt1.department', '=', 'dt3.LOOKUP_DATA_ID')
                                    ->Where('dt1.block_id', '=',$block->block_id)
                                    ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS PLACE_COURSE','dt3.LOOKUP_DATA_NAME AS DEPARTMENT')
                                    ->get();

                                    if($subBlock){
                                        $rowSize = 100/count($subBlock);
                                        $t = 1;
                                        foreach ($subBlock as $sb){     
                                            
                                            
                                            // START IN SB TEMP

                                            if(!empty($sb->duration_from) && !empty($sb->duration_to)){

                                                

                                                // block data in sub block part
                                                if(!empty($sb->block_id) && $blockData = BlockModel::where(['block_id' => $sb->block_id])->first()){
                                                    
                                                    $blockID = $blockData->block_id;

                                                    $sbChecking = TeaBlockPlacementChdModel::where(['sub_block' => $sb->sub_block_id, 'current_block' => $blockID, 'student_id' => $student_id])->first();
                                                    if($sbChecking){                                                  
                                                        ?>
                                                        <script>
                                                            // HAVE TBL DATA
                                                            //$("#tabBag_{{$blockID}}_DD_{{$t}}").css({"background-color": "#9CB381"});
                                                        </script>

                                                    <?php
                                                    }else{ // NO TBL DATA

                                                        if(strtotime($curDate) >= strtotime($sb->duration_from) && strtotime($curDate) <= strtotime($sb->duration_to)){?>
                                                            <script>
                                                                //$("#tabBag_{{$blockID}}_DD_{{$t}}").css({"background-color": "#FFAC40"});
                                                            </script>
                                                            <?php
                                                        }else{ ?>
                                                            
                                                            <script>
                                                                // NO TBL DATA
                                                                //$("#tabBag_{{$blockID}}_DD_{{$t}}").css({"background-color": "#FFFFFF"});
                                                            </script>

                                                            <?php
                                                        }





                                                    
                                                    }
                                                }?>
                                                
                                                <!-- Sub Block Data -->
                                                <div id="tabBag_{{$blockID}}_DD_{{$t}}" style="font-size:10px;font-weight:bold;word-break: break-all;float:left; padding: 6px 2px !important;border:1px solid #ccc;width:<?=$rowSize?>%">
                                                    <?php
                                                    /*if($sb->has_sub==1){
                                                        //echo $sb->DEPARTMENT;
                                                        if($sb->DEPARTMENT){
                                                            echo nl2br(str_replace(' ','<br>',$sb->DEPARTMENT));
                                                        }
                                                        
                                                    }else{
                                                        //echo $sb->PLACE_COURSE;
                                                        if($sb->PLACE_COURSE){
                                                            echo nl2br(str_replace(' ','<br>',$sb->PLACE_COURSE));
                                                        }
                                                    }*/

                                                    if($sb->PLACE_COURSE){
                                                        echo nl2br(str_replace(' ','<br>',$sb->PLACE_COURSE));
                                                    }
                                                    ?>
                                                </div>
                                                <?php

                                            }

                                            
                                            $t=$t+1;
                                            
                                            // END IN SB TEMP
                                            

                                            
                                        }
                                    }
                                ?>
                            </td>
                        @endforeach
                    @endif
                </tr>
                <tr class="row9">
                    @if($blocks)
                        @foreach ($blocks as $block)
                            <td>
                                <?php

                                    $subBlock = DB::table('aca_create_sub_block as dt1')
                                    ->leftJoin('sa_lookup_data as dt2', 'dt1.department', '=', 'dt2.LOOKUP_DATA_ID')
                                    ->Where('dt1.block_id', '=',$block->block_id)
                                    ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS DEPARTMENT')
                                    ->get();

                                    if($subBlock){
                                        $rowSize = 100/count($subBlock);
                                        $t = 1;
                                        foreach ($subBlock as $sb){


                                            
                                            // START IN SB TEMP

                                            if(!empty($sb->duration_from) && !empty($sb->duration_to)){
                                                $date1 = date('Y-m-d', strtotime($sb->duration_from));
                                                $date2 = date('Y-m-d', strtotime($sb->duration_to));  

                                                if(strtotime($curDate) >= strtotime($sb->duration_from) && strtotime($curDate) <= strtotime($sb->duration_to)){?>
                                                    <script>
                                                        //$("#tabBag_{{$blockID}}_EE_{{$t}}").css({"background-color": "#FFAC40"});
                                                    </script>
                                                    <?php
                                                }

                                                // block data in sub block part
                                                if(!empty($sb->block_id) && $blockData = BlockModel::where(['block_id' => $sb->block_id])->first()){
                                                    
                                                    $blockID = $blockData->block_id;

                                                    $sbChecking = TeaBlockPlacementChdModel::where(['sub_block' => $sb->sub_block_id, 'current_block' => $blockID, 'student_id' => $student_id])->first();
                                                    if($sbChecking){                                                    
                                                        ?>
                                                        <script>
                                                            // HAVE TBL DATA
                                                            //$("#tabBag_{{$blockID}}_EE_{{$t}}").css({"background-color": "#9CB381"});
                                                        </script>

                                                    <?php
                                                    }else{?>
                                                        <script>
                                                            // NO TBL DATA
                                                            //$("#tabBag_{{$blockID}}_EE_{{$t}}").css({"background-color": "#FFFFFF"});
                                                        </script>
                                                    <?php
                                                    }
                                                }?>
                                                
                                                <!-- Sub Block Data -->
                                                <div id="tabBag_{{$blockID}}_EE_{{$t}}" style="float:left; border:1px solid #ccc;padding: 6px 2px !important;width:<?=$rowSize?>%">
                                                    <?=numWeeks($date1, $date2).' weeks'?>
                                                </div>
                                                <?php

                                            }

                                            
                                            $t=$t+1;
                                            
                                            // END IN SB TEMP


                                        }
                                    }
                                ?>
                            </td>
                        @endforeach
                    @endif
                </tr>
                <tr class="row9" style="display:none">                    
                    @if($blocks)
                        @foreach ($blocks as $block)
                            <td style="background-color:#CDEDFC;">
                                <?php
                                    $subBlock = DB::table('aca_create_sub_block as dt1')
                                    ->leftJoin('sa_lookup_data as dt2', 'dt1.department', '=', 'dt2.LOOKUP_DATA_ID')
                                    ->Where('dt1.block_id', '=',$block->block_id)
                                    ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS DEPARTMENT')
                                    ->get();

                                    if($subBlock){
                                        $rowSize = 100/count($subBlock);
                                        $t = 1;
                                        foreach ($subBlock as $sb){

                                            
                                            $blockID = $sb->block_id;

                                            ?>
                                            <!-- Sub Block Data -->
                                            <div class="motherDiv " id="tabBag_{{$blockID}}_{{$t}}" style="float:left; padding: 1px 2px !important;width:<?=$rowSize?>%;">
                                                <input type="hidden" name="checkboxCheck[]" class="switchVal tabBag_{{$blockID}}_RP_{{$t}}" value="0" />
                                                <input type="checkbox" name="checkboxCheckCheck[]" class="switchStatus" id="tabBag_{{$blockID}}_RR_{{$t}}" >


                                                <?php
                                                if(!empty($sb->block_id) && $blockData = BlockModel::where(['block_id' => $sb->block_id])->first()){
                                                    
                                                    // $blockID = $blockData->block_id;

                                                    // This code is for assigned/submitted 
                                                    $sbChecking = TeaBlockPlacementChdModel::where(['sub_block' => $sb->sub_block_id, 'current_block' => $blockID, 'student_id' => $student_id])->first();
                                                    if($sbChecking){                                                    
                                                        ?>
                                                        <script>
                                                            //1 $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#9CB381"});
                                                            //$("#tabBag_{{$blockID}}_RR_{{$t}}").attr("disabled", true); //disable for all open
                                                        </script>

                                                    <?php
                                                    }else{ //submitted not found ?>

                                                        <!-- This code is for color & checkbox for current date range -->
                                                        @if(strtotime($curDate) >= strtotime($sb->duration_from) && strtotime($curDate) <= strtotime($sb->duration_to))
                                                        
                                                            <script>
                                                                //$("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFAC40"});
                                                                $("#tabBag_{{$blockID}}_RR_{{$t}}").attr("disabled", false);
                                                            </script>
                                                            <!-- <input type="checkbox" name="checkboxCheckCheck[]" class="switchStatus" > -->
                                                        @else
                                                        
                                                        <script>
                                                            $("#tabBag_{{$blockID}}_{{$t}}").css({"background-color": "#FFFFFF"});
                                                            //$("#tabBag_{{$blockID}}_RR_{{$t}}").attr("disabled", true); //disable for all open
                                                        </script>
                                                        @endif

                                                    <?php
                                                    }
                                                }?>

                                            


                                            </div>
                                            <?php
                                            
                                            $t=$t+1;
                                        }
                                    }
                                ?>
                            </td>
                        @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
        <!-- @if(count($blocks)>0)
        <div class="form-group">
            <div class="col-md-12 text-align-center">
                <input type="hidden" name="student_id" value="{{$student_id}}">
                <input type="hidden" name="department" value="{{$department}}">
                <input type="hidden" name="batch" value="{{$batch}}">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        @endif -->
            
        </form>
    </div>
    <style>
        #assign-tbl .row1 th{
            font-size: 18px;text-align: left;background-color: #DDDDDD;padding: 10px;
        }
        #assign-tbl .row2 td{
            padding: 10px 2px;
            font-weight:bold;
        }
        #assign-tbl .row3 td{
            padding: 12px 2px !important;
            font-weight: normal;
        }
        #assign-tbl .row9 td{
            padding: 0px !important;
            font-weight: normal;
        }
        #assign-tbl .row4 td{
            padding: 8px 2px;
            font-weight: normal;
        }
        #assign-tbl .row5 td{
            padding: 8px 2px;
            background-color:#CDEDFC;
        }
        .btn-box button{
            border: 1px solid #8a8989;
            width: 65px;
            font-weight: bold;
            border-radius: 0px
        }
        .btn-box{
            color: #232323;
            font-weight: bold;
        }
        #assign-tbl, #assign-tbl td{
            border: 1px solid #ccc !important;
            color: #000;
        }

        .x_content{
            overflow-x: auto;
        }

        #assign-tbl td, #assign-tbl th {
            border: 1px solid #DDDDDD !important;
        }
        .btn-box button:hover{
            cursor: initial;
        }
        .assign-head-tbl td{ padding:5px 10px; color:#2CBBA9; font-size: 15px;}
        .indt{color:#009899;}
    </style>

    <?php
    function numWeeks($dateOne, $dateTwo){
        //Create a DateTime object for the first date.
        $firstDate = new DateTime($dateOne);
        //Create a DateTime object for the second date.
        $secondDate = new DateTime($dateTwo);
        //Get the difference between the two dates in days.
        $differenceInDays = $firstDate->diff($secondDate)->days + 1;
        //Divide the days by 7
        $differenceInWeeks = $differenceInDays / 7;
        //Round down with floor and return the difference in weeks.
        return floor($differenceInWeeks);
    }
    ?>
    <script>
    //change status switch 1 or 0
    $(document).on("click", ".switchStatus").on("click", ".switchStatus", function () {
        $('input[type=checkbox][class=switchStatus]').change(function () {

            if ($(this).is(':checked')) {
                $(this).parents('div.motherDiv').find('.switchVal').val(1);
            }else{
                $(this).parents('div.motherDiv').find('.switchVal').val(0);
            }
        })
    });
    
    //set color
    // function elementColor(elementName, color){
    //     $("'"+elementName+"'").css({"background-color": + "'"+color+"'"});
    // }
    </script>