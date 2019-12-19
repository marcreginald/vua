    <span id="uplaod-path" class="hd"><?= base_url(); ?></span>
    <!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url('assets/plugins/jquery/jquery-1.9.1.min.js');?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js');?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>"></script>
	<script src="<?= base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-cookie/jquery.cookie.js');?>"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?= base_url('assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js');?>"></script>
	<!-- any additional js files here -->

	<script src="<?= base_url('assets/plugins/datatables/media/js/jquery.datatables.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/media/js/datatables.bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/extensions/responsive/js/datatables.responsive.min.js'); ?>"></script>

    <!-- begin select2 -->
	<script src="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js'); ?>"></script>
	<!-- end select2 -->

	<!-- datepciker js -->
	<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
    
    <!-- masking -->
    
    <!-- moment -->
    <script src="<?= base_url('assets/plugins/datetimepicker/build/moment.js') ?>"></script>

    <!-- datetimepicker -->
    <script src="<?= base_url('assets/plugins/datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/apps.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/vua-design.js'); ?>"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
    	
    	$(function(){ 
    		App.init(); 
    		Vuadesign.init(); // CUSTOM :)
    	});

        // location.protocol+"//"+location.hostname+"/vua"
		var SITE_BASEPATH = location.protocol+"//"+location.hostname+":"+location.port;
    
    </script>

    <!-- parsley -->
    <script src="<?= base_url('assets/plugins/parsley/dist/parsley.js'); ?>"></script>

    <!-- gritter-->
	<script src="<?= base_url('assets/plugins/gritter/js/jquery.gritter.js'); ?>"></script>

