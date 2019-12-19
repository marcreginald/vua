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
                
                <div class="table-responsive m-t-30">
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                        <thead>
                            <tr class="white">
                                <th>REQUEST# <br> (申請號碼)</th>
                                <th>BATCH# <br> (批號)</th>
                                <th>TOTAL RECORDS <br> (總記錄)</th>
                                <th>LETTER DATE <br> (信函日期)</th>
                                <th>ARRIVAL <br> (到達)</th>
                                <th>FLIGHT/CRUISE NAME <br> (飛行/巡航 名稱)</th>   
                                <th>CREATED BY <br> (由...製作)</th>                                 
                                <th>DATE GENERATED <br> (生成日期)</th>
                                <!-- <th>ACTION</th> -->
                            </tr>
                        </thead>
                        <tbody id="inprocess-list" style="text-transform: capitalize;">
                        </tbody>
                    </table>
                </div>
                
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
		
        <!-- SELECTION OF GROUPS -->
        <?php include(APPPATH.'views/modals/change_grp.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/visa/inprocess.js'); ?>"></script>
    
</body>
</html>