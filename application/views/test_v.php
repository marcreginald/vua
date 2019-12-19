<!DOCTYPE html>
<html lang="en">
<head>
    <!-- EACH SENDED TRANSACTION TO THE MANAGER TYPE USER -->
    <?php include(APPPATH.'views/templates/header.php'); ?>
    
    <style>
        .select2-selection__rendered{
            text-transform: uppercase !important;
        }
        
        #mod-changegrp > div > div > div.modal-body > div:nth-child(2) > div > span{
            width: 193px !important;
        }
    </style>
    
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url('assets/plugins/pace/pace.min.js'); ?>"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #page-loader -->
	<div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">

        <!-- TEMP HEADER -->
        <?php include(APPPATH.'views/templates/header_sec.php'); ?>

        <!-- TEMP SIDEBAR-->
        <?php include(APPPATH.'views/templates/sidebar_sec.php'); ?>

		<!-- begin #content -->
		<div id="content" class="content">

			<!-- TEMP H1 HEADER -->
            <?= $header; ?>
            
            <div class="row">
                <div class="col-md-2 col-md-push-10 col-lg-2 col-lg-push-10" style="margin-left: 4%;">
                    <button class="btn btn-sm btn-primary" id="btn-regroup" style="width: 120px; height: 32px;"> <span class="fa fa-object-ungroup"></span> Re-Group (重組)</button>
                </div>
            </div>
                        
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="nav nav-tabs">
                      <li id="pendingtab" title="List of pending Transaction"><a data-toggle="tab" href="#pending"> <b>PENDING</b> </a></li>
                      <li title="List of verified Transaction"><a data-toggle="tab" href="#verified"> <b>VERIFIED</b> </a></li>
                    </ul>

                    <div class="tab-content">
                     
                      <div id="pending" class="tab-pane in active" style="display:">
                        
                        <div class="table-responsive m-t-30">
                            <table id="data-table-pending" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                                <thead>
                                    <tr class="white">
                                        <th># <br>(數) </th>
                                        <th>TRANS # <br>(交易號) </th>
                                        <th>ARRIVAL <br>(到達) </th>                                 
                                        <th>BATCH # <br>(批號) </th>
                                        <th>SENDER <br>(寄件人) </th>
                                        <th>FULLNAME <br>(全名) </th>
                                        <th>GENDER <br>(性別) </th>
                                        <th>PASSPORT NO. <br>(護照號) </th>   
                                        <th>FLIGHT/CRUISE NAME <br>(航班號/ 巡航 名稱 ) </th>
                                        <th>STATUS <br>(狀態) </th>
                                        <th>DATE SENT <br>(日期發送) </th>
                                    </tr>
                                </thead>
                                <tbody id="agent-sentlist-pending">
                                 <!-- ajax -->
                                </tbody>
                            </table>
                        </div>
                        
                      </div> <!--#pending-->
                      
                      <div id="verified" class="tab-pane fade">
                           
                            <div class="table-responsive m-t-30">
                                <table id="data-table-verified" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                                    <thead>
                                        <tr class="white">
                                            <th data-sorting="disabled"><input type="checkbox" id="check-all-verified"/> ALL <br>(所有) </th>
                                            <th># <br>(數) </th>
                                            <th>TRANS # <br>(交易號) </th>
                                            <th>ARRIVAL <br>(到達) </th>
                                            <th>BATCH # <br>(批號) </th>
                                            <th>SENDER <br>(寄件人) </th>
                                            <th>FULLNAME <br>(全名) </th>
                                            <th>GENDER <br>(性別) </th>
                                            <th>PASSPORT NO. <br>(護照號) </th>   
                                            <th>FLIGHT/CRUISE NAME <br>(航班號/ 巡航 名稱 ) </th>
                                            <th>STATUS <br>(狀態) </th>
                                            <th>DATE SENT <br>(日期發送) </th>
                                        </tr>
                                    </thead>
                                    <tbody id="agent-sentlist-verified">
                                     <!-- ajax -->
                                    </tbody>
                                </table>
                           </div>
                          
                      </div>
                      
                    </div>
                </div>
            </div>
           
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
		
        <!-- MODAL FOR SWITCHING GROUP -->
        <?php include(APPPATH.'views/modals/change_grp.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/inbox/inbox.js'); ?>"></script>
    
    
</body>
</html>