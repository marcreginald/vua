<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>

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
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap" style="font-style: normal !important;">
                        <thead>
                            <tr class="white">
                            <th> # <br> (數)</th>
                            <th> BATCH# <br> (批號)</th>
                            <th> SENDER <br> (寄件人)</th>
                            <th> DATE SENT <br> (日期發送)</th>
                            <th> TOTAL RECORDS <br> (總記錄)</th>
                            <th> PENDING <br> (有待)</th>                                    
                            <th> VERIFIED <br> (驗證)</th>
                            <th> STATUS <br> (狀態)</th>
                            <th> ACTION <br> (行動)</th>
                            </tr>
                        </thead>
                        <tbody id="mgr-batchlist" style="text-transform: capitalize; ">
                        <!-- ajax to the server -->
                        </tbody>

                    </table>
                    <!-- end table -->

                </div>
                
            </div>
            
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->

	</div>
	<!-- end page container -->
   
   <?php include(APPPATH.'views/modals/showtransac_batch.php'); ?>">
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/batchrec/batchrec.js'); ?>"></script>
</body>
</html>