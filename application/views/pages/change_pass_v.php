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
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-user fa-fw"></i> Change Password</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php if($error = $this->session->flashdata('success_msg')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> <?= $error ?>
                </div>
            <?php endif; ?>
            <?php if($error = $this->session->flashdata('error_msg')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?= $error ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-green">
                <div class="panel-heading">
                    <i class="fa fa-key"></i> Change Password
                </div>
                <div class="panel-body">
                    <?= form_open('ChangePass/updatepass') ?>
                        <div class="row">
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="user_pass" value="<?= set_value('user_pass') ?>" class="form-control" placeholder="Enter Old Password" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_pass" value="<?= set_value('new_pass') ?>" class="form-control" placeholder="Enter New Password" required>
                                   
                                </div>
                            </div>
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Repeat New Password</label>
                                    <input type="password" name="conf_pass" value="<?= set_value('conf_pass') ?>" class="form-control" placeholder="Repeat New Password" required>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-key"></i> Change Password</button>
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