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
                
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                            <button class="btn btn-md btn-success" id="add-user"> <span class="fa fa-user-plus"></span> Add User (添加用戶)</button>
                    </div>
                </div>
                
                <div class="table-responsive m-t-30">
                    <table id="data-table" data-order='[[1,"asc"]]' class="table table-bordered table-hover nowrap">
                        <thead>
                            <tr class="white">
                                <th># <br> (數)</th>
                                <th>First Name <br> (名字)</th>
                                <th>Last Name <br> (姓)</th>
                                <th>Email Address <br> (電子郵件地址)</th>
                                <th>User Type <br> (用戶類型)</th>
                                <th>User Branch <br> (用戶分支)</th>
                                <th>Status <br> (狀態)</th>   
                                <th>Action <br> (行動)</th>                                 
                            </tr>
                        </thead>
                        <tbody id="user-systems">
                            <!-- ajax -->
                        </tbody>
                    </table>
                </div>
                
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
		
        <!-- SYSTEM USERS MODAL (ADD/EDIT) -->
        <?php include(APPPATH.'views/modals/users_sysmodal.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/users/adding-user.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/users/edit-user.js'); ?>"></script>
    
</body>
</html>