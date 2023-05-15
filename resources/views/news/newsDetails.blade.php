@extends('layouts.support_master')
@php $actionUrl=url('/storeSupportTicketInfo'); @endphp
@section('content')
    @section('title')
    @endsection
    <style>
        element.style {
            background-color: #f9fbfc !important;
        }
        body{
            background-color: #f9fbfc !important;
        }
    </style>
    <div class="container">
<div style="padding-left: 10px;">
    <h6><b>{{$newsDetails->news_title}}</b></h6>
</div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table width="614" border="0" align="center">
                    <tbody>
                    <tr>
                        <td valign="top" align="left">
                            <table class="" data-module-id="eml_int_banner" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                <tr>
                                    <td id="campaignImage" style="background-image:url('{{ asset('uploads/news_image/'.$newsDetails->news_image)}}');background-repeat:no-repeat;background-size:100% auto" class="mb-bnr tmpImage" data-browse="true" data-others="true" data-setheight="true" data-helptext="N/A" width="614" valign="middle" height="137" align="left">
                                        <table class="devicewidthinner tmpSwap" data-textalign="true" data-title="Text" width="97%" border="0" align="left">
                                            <tbody>
                                            <tr>
                                                <td style="padding:0 20px 0 35px;height:137px" class="height0" id="bannerTxt" valign="middle" align="left">
                                                    <table class="opd-l20" width="100%" border="0">
                                                        <tbody>
                                                        <tr class="tmpAddRemoveText">
                                                            <td class="fs18" style="font-family:'Georgia';font-size:24px;color:#fff;font-weight:bold" data-textalign="true" valign="top" align="left"> <span class="tmpTitle" data-font="defaultFontTitle24" data-personalization="false" disable-edtr-icon="Link,UnLink" data-char="28" data-helptext="28 char max">{{$newsDetails->news_title}} </span></td>
                                                        </tr>
                                                        <tr class="tmpAddRemoveText">
                                                            <td class="fs14" style="font-family:'Georgia';font-size:18px;color:#fff;padding-top:5px" data-textalign="true" valign="top" align="left"> <span class="tmpTitle" etitle="Sub Title" data-personalization="false" disable-edtr-icon="Link,UnLink" data-char="40" data-helptext="40 char max"> </span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table id="BodyTable" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                <tr>
                                    <td>
                                        <table class="edtrBtnParent" data-unique-id="UBE020" data-module-id="eml_int_ube020" width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#EDEFF1">
                                            <tbody>
                                            <tr>
                                                <td style="padding-left:20px;padding-right:20px;padding-bottom:10px" valign="top" align="left">
                                                    <table width="100%" border="0">
                                                        <tbody>
                                                        <tr>
                                                            <td style="border-bottom:1px solid #edeff1"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:20px" valign="top" align="left">
                                                                <table class="devicewidthinner" width="100%" border="0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="font-family:'Oracle Sans';font-size:16px;color:#000;padding-bottom:10px" class="fs14" valign="top" align="left">

                                                                            {!! $newsDetails->news_desc !!}
                                                                        </td>
                                                                    </tr>

                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

            </div>
        </div>
    </div>
@endsection

