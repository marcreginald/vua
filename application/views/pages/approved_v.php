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
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group-sm">
                                <label class="control-label">From (從)</label>
                                <input type="text" class="form-control input-md" id="approve-from" value="<?= date('m-d-Y', strtotime('-1 months')); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group-sm">
                                <label class="control-label">To (至)</label>
                                <input type="text" class="form-control input-md" id="approve-to" value="<?= date('m-d-Y'); ?>">
                            </div>
                            
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-primary btn-md m-t-20" id="btn-searchapprove-rql"> <span class="fa fa-search"> </span> Search (搜索)</button>
                        </div>

                    </div> <!--setter for the from/to -->
                    
                    <div class="row m-t-15">
                        <div class="col-md-12 col-lg-12">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                           <td> REQUEST# <br> (申請號碼)</td>
                                           <td> BATCH# <br> (批號)</td>
                                           <td> TOTAL RECORDS <br> (記錄總數)</td>
                                           <td> LETTER DATE <br> (信函日期)</td>
                                           <td> ARRIVAL DATE <br> (到達日期)</td>
                                           <td> FLIGHT/CRUISE NAME <br> (飛行/巡航 名稱)</td>
                                           <td> CREATED BY <br> (由...製作)</td>
                                           <td> DATE GENERATED <br> (生成日期)</td>
                                            <!-- <td> ACTION</td> -->
                                        </tr>
                                    </thead>

                                    <tbody id="rql-logs" style="text-transform: capitalize;">
                                        <!-- ajax_content -->
                                    </tbody>
                                </table>
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

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/visa/approved.js'); ?>"></script>
</body>
</html>