<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>
    
    <style>
        body{
            background-color: #d5d8da !important;
        }
        
        /* to make the sidebar enabled in the dashboard view*/
        /*#sidebar-right{
            right: 0 !important;            
        }*/
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
                   
                    <!-- begin col-3 -->
                    <div class="col-sm-6 col-lg-3">
                       
                        <!-- begin widget -->
                        <a href="<?= site_url('draftagent'); ?>" style="color:inherit; text-decoration: none;">
                        <div class="widget widget-stat widget-stat-right bg-inverse text-white">
                            
                            <div class="widget-stat-icon"><i class="fa fa-pencil-square"></i></div>
                            <div class="widget-stat-info">
                                <div class="widget-stat-title">Draft Transaction</div>(交易草案)
                                <div class="widget-stat-number" id="total-draft">0</div>
                            </div>
                            <div class="widget-stat-progress hd">
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        </a>
                      
                        <!-- end widget -->

                    </div>
                    <!-- end col-3 -->
                    
                    <!-- begin col-3 -->
                    <div class="col-sm-6 col-lg-3">
                       
                        <!-- begin widget -->
                        <a href="<?= site_url('transactions'); ?>" style="color:inherit; text-decoration: none;">
                        <div class="widget widget-stat widget-stat-right bg-success text-white">
                          
                            <div class="widget-stat-icon"><i class="fa fa-envelope"></i></div>
                            <div class="widget-stat-info">
                                <div class="widget-stat-title">Pending Transaction</div> (待處理交易)
                                <div class="widget-stat-number" id="total-pending">0</div>
                            </div>
                            <div class="widget-stat-progress hd">
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div> 
                        </a>    
                        <!-- end widget -->
                    
                    </div>
                    <!-- end col-3 -->
                    
                    <!-- begin col-3 -->
                    <div class="col-sm-6 col-lg-3">
                        <!-- begin widget -->

                        <a href="<?= site_url('transactions'); ?>" style="color:inherit; text-decoration: none;">
                        <div class="widget widget-stat widget-stat-right bg-primary text-white">
                            <div class="widget-stat-icon"><i class="fa fa-check-square"></i></div>
                            <div class="widget-stat-info">
                                <div class="widget-stat-title">Verified Transaction</div> (驗證交易)
                                <div class="widget-stat-number" id="total-verified">0</div>
                            </div>
                            <div class="widget-stat-progress hd">
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        </a>
                        
                        <!-- end widget -->

                    </div>
                    <!-- end col-3 -->
                    
                    <!-- begin col-3 -->
                    <div class="col-sm-6 col-lg-3">
                       
                        <!-- begin widget -->
                        <a href="<?= site_url('transactions'); ?>" style="color:inherit; text-decoration: none;">
                        <div class="widget widget-stat widget-stat-right bg-info text-white">
                            <div class="widget-stat-icon"><i class="fa fa-thumbs-up"></i></div>
                            <div class="widget-stat-info">
                                <div class="widget-stat-title">Approved Transaction </div> (核准交易)
                                <div class="widget-stat-number" id="total-approved">0</div>
                            </div>
                            <div class="widget-stat-progress hd">
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>    
                        </a>
                        <!-- end widget -->

                    </div>
                    <!-- end col-3 -->
                 </div><!-- counter, transaction -->
                 
                 
                 <!-- begin row -->
                <div class="row">
                    <!-- begin col-4 -->
                    <div class="col-lg-4">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title">Recent Activities (近期活動)</h4>
                            </div>
                            <div class="panel-body" style="height: 288px;">
                                <div data-scrollbar="true" data-height="260px" id="recent-activities">
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-4 -->

                    <!-- begin col-4 -->
                    <div class="col-lg-4">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title">Active Users (活躍用戶)</h4>
                            </div>
                            <div class="panel-body">
                                <div data-scrollbar="true" data-height="250px" id="active-users">
                                    <!-- FORMAT_INTO JS-->
                                </div>
                            </div>
                            
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-4 -->

                    <!-- begin col-4 -->
                    <div class="col-lg-4">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title">Calendar (日曆)</h4>
                            </div>
                            <div class="panel-body">
                                <div id="datepicker-inline"></div>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-4 -->

                </div>
                <!-- end row -->
            
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
    <script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>

</body>
</html>