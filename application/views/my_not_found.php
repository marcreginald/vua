<!DOCTYPE html>
<html lang="en">

<head>
	<?php include(APPPATH.'views/templates/header.php'); ?>
    <title> Not Found </title>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url('assets/plugins/pace/pace.min.js'); ?>"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-container">
        <!-- begin error -->
        <div class="error">
            <div class="error-code">404</div>
            <div class="error-content">
                <div class="error-message m-b-5">Oops... The page you're looking for doesn't exist.</div>
                <div class="error-desc m-b-20">
                   The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                </div>
                <div>
                    <a href="<?= site_url('login'); ?>" class="btn btn-danger btn-rounded">Go Login</a>
                </div>
            </div>
        </div>
        <!-- end error -->
	</div>

    <?php include(APPPATH.'views/templates/footer.php'); ?>

    <script src="<?= base_url('assets/js/unminify/demo.js'); ?>"></script>
    <script src="<?= base_url('assets/js/unminify/apps.js'); ?>"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <!-- ================== BEGIN CUSTOM LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            Demo.init();
        });
    </script>

</body>

</html>
