<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>


    <style>
        tbody > tr{
            cursor:pointer;
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

			<!-- TEMP BREADCRUMB -->
            <?= $breadcrumb; ?>

			<!-- TEMP H1 HEADER -->
            <?= $header; ?>
            
            <div class="panel">
                    <div class="row">
                        <button> Status </button>
                        <button> Delete </button>
                        <button> Re-group </button>
                    </div>
                    
                    
                        <div class="reponsive">

                            <!-- begin table -->
                            <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th  data-sorting="disabled"><input type="checkbox" name="record[]" value="1" /> All</th>
                                        <th>BATCH#</th>
                                        <th>TRANS #</th>
                                        <th>FULL NAME</th>
                                        <th>GENDER</th>
                                        <th>PASSPORT #</th>
                                        <th>ARRIVAL</th>                                    
                                        <th>FLIGHT/VOYAGE #</th>
                                        <th>STATUS</th>
                                        <th>DATE SENT</th>
                                    </tr>
                                </thead>
                                <tbody id="inbox-list"> 
                                    <tr> 
                                        <td><input type="checkbox" name="record[]" value="1" /> </td>
                                        <td><u id="row-inbox" data-btchid="20180001">20180001</u></td>
                                        <td>00001</td>
                                        <td>Hon. Jaime H. Morente</td>
                                        <td>M</td>
                                        <td>E01956800</td>
                                        <td>Feb-2-1991</td>
                                        <td>M2166646</td>
                                        <td>New</td>
                                        <td>Jan 29 2018 9:30 am</td>
                                    </tr>
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
    
    <script>
        datatable('data-table');
        var $INBXLIST = $('#inbox-list');
        $INBXLIST.on('click', '#row-inbox', function(e){
            e.preventDefault();
            window.open(SITE_BASEPATH+'/compose/', '_blank');
        });
    </script>
</body>
</html>