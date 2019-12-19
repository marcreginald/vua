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

        <!-- TEMP SIDEBAR
        <?php include(APPPATH.'views/templates/sidebar_sec.php'); ?> 
        -->

		<!-- begin #content -->
		<div id="content" class="content">

			<!-- TEMP H1 HEADER -->
            <?= $header; ?>
            
            <div class="panel">
                   
                <!-- <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <label title="Indicate the estimated arrival date"> <b><u><e>ARRIVAL</e></u></b> </label>
                    </div>
                </div>  -->
                   
                <div class="row">
                   <div class="col-md-2 col-lg-2">
                        <div class="form-group-sm">
                            <label class="control-label">From (從)</label>
                            <input type="text" class="form-control input-md" id="trans-from" value="<?= date('m-d-Y', strtotime('-1 month', time())); ?>" title="Arrival">
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="form-group-sm">
                            <label class="control-label">To (至)</label>
                            <input type="text" class="form-control input-md" id="trans-to" value="<?= date('m-d-Y'); ?>" title="Arrival">
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="form-group-sm">
                            <label class="control-label">Status (狀態)</label>
                            <select id="trans-stat" class="form-control input-md">
                                <option value="all">ALL (所有)</option>
                                <option value="processed">PROCESSED (處理)</option>
                                <option value="pending">PENDING (有待)</option>    
                                <option value="verified">VERIFIED (驗證)</option>
                                <option value="approved">APPROVED (批准)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <button class="btn btn-primary btn-md m-t-20" id="btn-searchtrans"> <span class="fa fa-search"> </span> Search </button>
                    </div>

                </div> <!--setting-->
                
                <div class="row m-t-20">
                   
                    <table class="table table-bordered table-hover">
                        <thead>
                           <tr class="white">
                                <th>#. <br> (數)</th>
                                <th>TRANS# <br> (交易號)</th>
                                <th>BATCH# <br> (批號)</th>
                                <th>FULL NAME <br> (全名)</th>
                                <th>GENDER <br> (性別)</th>
                                <th>PASSPORT# <br> (護照號)</th>
                                <th>ARRIVAL <br> (到達)</th>
                                <th>FLIGHT/CRUISE <br> (飛行/巡航)</th>
                                <th>STATUS <br> (狀態)</th>
                           </tr>
                        </thead>

                        <tbody id="tbod-transaclist" style="text-transform: capitalize;">
                            <!-- ajax the content -->
                        </tbody>
                    </table>
                    
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
    <script src="<?= base_url('assets/js/pages/transactions/translist.js'); ?>"></script>
</body>
</html>