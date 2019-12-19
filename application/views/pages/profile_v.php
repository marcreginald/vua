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
           
            <div id="page-wrapper">
    <div class="row">
       
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-green">    
                <div class="panel-body">
                    <?= form_open('Profile') ?>
                        <div class="row">
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="firstname" value="<?= $set_value('') ?>" class="form-control" readonly>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="mobile" value="<?= $user_dat['lastname'] ?>" class="form-control" readonly>
                                  
                                </div>
                            </div>

                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="mobile" value="<?= $this->session->userdata('MOBILE') ?>" class="form-control">
                                  
                                </div>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-floppy-o"></i> Update Profile</button>
                            </div>
                        </div>
                    </form>
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

</body>
</html>