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
                                <label class="col-md-1 control-label">From</label>
                                <input type="text" class="form-control input-md" id="rql-from" value="<?= date('m-d-Y', strtotime('-1 months')); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group-sm">
                                <label class="col-md-1 control-label">To</label>
                                <input type="text" class="form-control input-md" id="rql-to" value="<?= date('m-d-Y'); ?>">
                            </div>
                            
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-primary btn-md m-t-20" id="btn-searchrql"> <span class="fa fa-search"> </span> Search </button>
                        </div>

                    </div> <!--setter for the from/to -->
                    
                    <div class="row m-t-15">
                        <div class="col-md-12 col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                           <td> REQUEST# </td>
                                           <td> BATCH# </td>
                                           <td> TOTAL RECORDS </td>
                                           <td> LETTER DATE </td>
                                           <td> ARRIVAL DATE </td>
                                           <td> FLIGHT/VOYAGE# </td>
                                           <td> CREATED BY </td>
                                           <td> DATE GENERATED </td>
                                           <td> ACTION</td> 
                                        </tr>
                                    </thead>

                                    <tbody id="rql-logs">
                                        <!-- ajax_content -->
                                    </tbody>
                                </table>
                    
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
    <script src="<?= base_url('assets/js/pages/rqllogs/rqllogs.js'); ?>"></script>
</body>
</html>