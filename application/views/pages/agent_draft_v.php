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
                   <button class="btn btn-danger btn-md" id="btn-discard" title="Discarding transaction"><span class="fa fa-trash"></span> Discard (丟棄)</button>

                   <button class="btn btn-success btn-md" id="vt-create" onclick="location.href='transacnew'" title="Create new Visa Applicant Transaction"><span class="fa fa-pencil"></span> Create (創建)</button>

                   <button class="btn btn-info btn-md" title="Send in batch" id="btn-sendbatch"><span class="fa fa-rocket"></span> Send (發送)</button>
               </div>

                <div class="reponsive m-t-15">

                    <!-- begin table -->
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                        <thead>
                            <tr class="white">
                                <th data-sorting="disabled"> <input type="checkbox" id="chk-all"> ALL <br> (所有)</th>
                                <th>#. <br> (數)</th>
                                <th>TRANSACTION # <br> (交易號)</th>
                                <th>FULL NAME <br> (全名)</th>
                                <th>GENDER <br> (性別)</th>
                                <th>DATE OF BIRTH <br> (出生日期)</th>
                                <th>PASSPORT NO. <br> (護照號)</th>                                    
                                <th>LAST MODIFIED <br> (上一次更改)</th>
                            </tr>
                        </thead>
                        <tbody id="agentdrafted-list" style="text-transform: capitalize;">
                        </tbody>
                    </table>
                    <!-- end table -->

                </div>
            </div>
            
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER_SEC -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
		
		<!-- MODAL FOR SENDING -->
        <?php include(APPPATH.'views/modals/sending_batch.php'); ?>
        <?php include(APPPATH.'views/modals/user_confirmation.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/draftagent/draftagent.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/draftagent/sending-batch.js'); ?>"></script>
</body>
</html>