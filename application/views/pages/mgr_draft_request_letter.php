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
                
                <div class="row">
                   <div class="col-md-2 col-lg-2">
                       <button class="btn btn-danger btn-md" id="btn-discardrql" title="Click to remove selected request letter"> <span class="fa fa-times"> </span> Discard (丟棄)</button>
                   </div>
                </div>
                
                <div class="reponsive m-t-30">
                   
                    <!-- begin table -->
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                        <thead>
                            <tr class="white">
                                <th data-sorting="disabled"><input type="checkbox" id="check-all"/> ALL <br>(所有)</th>
                                <!--<th> #</th>-->
                                <th> REQUEST# <br> (申請號碼)</th>
                                <th> BATCH# <br> (批號)</th>
                                <th> TOTAL <br> (總)</th>
                                <th> LETTER DATE <br> (信函日期)</th>
                                <th> ARRIVAL DATE <br> (到達日期)</th>
                                <th> FLIGHT/CRUISE NAME <br> (飛行/ 巡航 名稱)</th>
                                <th> CREATED BY <br> (由...製作)</th>
                                <th> LAST SAVED <br> (最後保存)</th>
                                <!-- <th> ACTION</th> -->
                            </tr>
                        </thead>
                        <tbody id="mgr-draftedrequestl" style="text-transform: capitalize;">                                   
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
		<!-- <?php include(APPPATH.'views/modals/confirm_generation.php'); ?> -->
        <?php include(APPPATH.'views/modals/user_confirmation.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/mgrdraftrquestlet/mgrdraftrquestlet.js'); ?>"></script>
    
</body>
</html>