<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>

    <!-- Manager Sent List by the agent -->
    
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
            
            <div class="panel">
                       
                <div class="reponsive">

                    <!-- begin table -->
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                        <thead>
                            <tr class="white">
                                <th> # <br> (數)</th>
                                <th> BATCH# <br> (批號)</th>
                                <th> TRAVEL TYPE <br> (旅行類型)</th>
                                <th> ARRIVAL <br> (到達)</th>
                                <th> AIRLINE/ CRUISE <br> (航空公司/ 巡航)</th>                                    
                                <th> FLIGHT NUMBER <br> (航班號)</th>
                                <th> DATE SENT <br> (日期發送) </th>
                                <th> STATUS <br> (狀態) </th>
                                <!-- <th> ACTION</th> -->
                            </tr>
                        </thead>
                        <tbody id="sent-translist" style="text-transform: capitalize;">
                            <!-- ajax to the server -->
                        </tbody>

                     </table>
                    <!-- end table -->

                </div>

            </div>
            
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
            
            <!-- TEMP FOOTER_SECTION-->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>
           
		</div>
		<!-- end #content -->
        		
        <!-- VIEWING THE ASSOCIATED VISA TRANSACTION ON THE BATCH -->
		<?php include(APPPATH.'views/modals/showtransac_batch.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/sent/sent.js'); ?>"></script>
</body>
</html>