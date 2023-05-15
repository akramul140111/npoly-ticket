
             <div class="navbar nav_title" style="border: 0;">
             <a href="{{url('/home')}}" class="site_title"><img class="img-circl"  height="100%"  style="background:white" src="{{url('images/Logo.png')}}"> <span></span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              @php
              $userGrp = Auth::user();
               $USERGRPId = $userGrp['USERGRP_ID'];
               $USERLVL_ID = $userGrp['USERLVL_ID'];

              $sessionInfo = Auth::user();
              $sessionUserGroup = $sessionInfo['USERGRP_ID'];
              $modules_back = DB::table('sa_modules')
              ->where('sa_modules.ACTIVE_STATUS', 1)
             // ->where('sa_modules.ACTIVE_STATUS', 1)
              ->whereIn('MODULE_ID',function($query){
                $query->select('SA_MODULE_ID')
                ->from('sa_uglw_mlink')
                ->where('USERGRP_ID', Auth::user()->USERGRP_ID)
                ->where('UG_LEVEL_ID', Auth::user()->USERLVL_ID);
                })
              ->orderBy('sa_modules.SL_NO', 'asc')
              ->get();

              $modules = DB::select(DB::raw("SELECT m.* FROM sa_modules m
                        WHERE m.ACTIVE_STATUS=1
                        AND m.MODULE_ID  IN (SELECT l.SA_MODULE_ID
                        FROM sa_uglw_mlink l WHERE l.SA_MODULE_ID=m.MODULE_ID
                        AND l.USERGRP_ID= $USERGRPId
                        AND l.UG_LEVEL_ID= $USERLVL_ID
                        AND l.STATUS=1)
                        ORDER BY m.SL_NO"));
              @endphp
              <!-- user group 1 for admin -->


              <ul class="nav side-menu">
               @foreach($modules as $module)
               @php
                $modulesLinks = DB::table('sa_uglw_mlink')
                ->leftJoin('sa_org_mlinks','sa_uglw_mlink.SA_MLINKS_ID','=','sa_org_mlinks.SA_MLINKS_ID')
                ->where('sa_uglw_mlink.USERGRP_ID', $USERGRPId)
                ->where('sa_uglw_mlink.UG_LEVEL_ID', $USERLVL_ID)
                ->where('sa_uglw_mlink.SA_MODULE_ID', $module->MODULE_ID)
                ->where('sa_uglw_mlink.STATUS', 1)
                ->where('sa_org_mlinks.STATUS',1)
                ->where('sa_org_mlinks.SA_MLINK_NAME', '!=','')
                ->orderBy('sa_org_mlinks.SL_NO', 'asc')
                ->get();
                $modulesLinks_ppp = DB::select(DB::raw("SELECT * FROM `sa_uglw_mlink`
                  LEFT JOIN `sa_org_mlinks` ON `sa_uglw_mlink`.`SA_MLINKS_ID` = `sa_org_mlinks`.`SA_MLINKS_ID`
                  WHERE `sa_uglw_mlink`.`USERGRP_ID` = 3 AND `sa_uglw_mlink`.`UG_LEVEL_ID` = 7
                  AND `sa_uglw_mlink`.`SA_MODULE_ID` = 3 AND `sa_uglw_mlink`.`STATUS` = 1
                  AND sa_uglw_mlink.LINK_ID != ''
                  ORDER BY `sa_org_mlinks`.`SL_NO` asc"));
               @endphp
                  <li>
                    <a>{{$module->MODULE_NAME}} <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              @foreach($modulesLinks as $modulesLink)
                             <li><a href="{{($modulesLink->URL_URI)}}">{{$modulesLink->SA_MLINK_NAME}}</a></li>
                              @endforeach
                     </ul>
                  </li>
                  @endforeach

                </ul>

              </div>
            </div>
