<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>
    <!-- JUNK VIEW (Manager & Admin) -->
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
                   <div class="col-md-3 col-lg-3">
                       <button class="btn btn-danger btn-md" id="btn-discardjunk" title="The transaction will be deleted"> <span class="fa fa-times"> </span> Discard (丟棄)</button>
                   </div>
                </div>
               
                <div class="reponsive m-t-15">

                    <!-- begin table -->
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                        <thead>
                            <tr class="white">
                                <th data-sorting="disabled"><input type="checkbox" id="chk-all"/> ALL <br> (所有)</th>
                                <!-- <th>#</th> -->
                                <th>TRANSACTION # <br> (交易號)</th>
                                <th>FULL NAME <br> (全名)</th>
                                <th>GENDER <br> (性別)</th>
                                <th>DATE OF BIRTH <br> (出生日期)</th>
                                <th>PASSPORT # <br> (護照號)</th>                                    
                                <th>FLIGHT # <br> (航班號)</th>
                                <th>ARRIVAL <br> (到達日期)</th>
                                <th>DATE CREATED <br> (創建日期)</th>
                            </tr>
                        </thead>
                        <tbody id="tbod-junk" style="text-transform: capitalize;">
                            
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
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/junk/junk.js'); ?>"></script>
</body>
</html>