<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>
    <style>
        /* hiding the black background-modal specifier */
        .modal-backdrop.in {
            opacity: -3.7 !important;
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
            
            <div class="panel">
                    
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <button class="btn btn-md btn-inverse" onclick="history.back()"> <span class="fa fa-mail-reply"></span> Back (背部)</button>
                        <button class="btn btn-md btn-primary" id="btn-savevisatransac"> <span class="fa fa-save"></span> Save Draft (保存草稿)</button>
                    </div>

                    <div class="col-md-1 col-lg-1 pull-right hd">
                        <button class="btn btn-md pull-right btn-success" id="btn-savesend"> <span class="fa fa-send"></span> Send (發送)</button>
                    </div>

                </div> <!--btn(back, saveDraft, send)-->
                
                <hr>

                <?= form_open_multipart('', array('novalidate' => true, 'id' => 'frm-visatransaction')); ?>

                <div class="row m-t-20">

                    <div class="col-md-12 col-lg-12">
                        <fieldset>
                            <legend> Applicant Information (申請人信息)</legend>
                            
                            <div class="row">
                                
                                <div class="col-sm-7 col-md-7 col-lg-7" style="width: 53.333333%;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-sm">
                                                <label> Last Name (姓)<span class="text-danger" title="Field required">*</span> </label>
                                                <input type="text" class="form-control input-sm field-text" name="va_lname" id="va-lname" required>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group-sm">
                                                <label> First Name (名字)<span class="text-danger" title="Field required">*</span> </label>
                                                <input type="text" class="form-control input-sm field-text" name="va_fname" id="va-fname" required>
                                            </div>
                                        </div>
                                    </div> <!--lname, fname-->
                                    
                                    <div class="row m-t-10">
                                        <div class="col-md-3 col-lg-3">
                                            <div class="fom-group-sm" style="white-space: nowrap;">
                                                <label> Gender (性別)</label>
                                                <select class="form-control input-sm" name="va_gender" id="va-gender">
                                                    <option value="">Select Gender (选择性别)</option>
                                                    <option value="M">Male (男)</option>
                                                    <option value="F">Female (女)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-3" style="">
                                            <div class="form-group-sm" style="white-space: nowrap;">
                                                <label> Date of Birth (出生日期)</label>
                                                <div class="input-group date" id="datetimepicker1">
                                                    <input type="text" class="form-control" placeholder="個月-天-年" name="va_dob" id="va-dob">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5 col-lg-5">
                                            <div class="form-group-sm">
                                                <label> Passport Number (護照號)<span class="text-danger" title="Field required">*</span> </label>
                                                <input type="text" class="form-control input-sm field-passnum" name="va_passportnum" id="passport" required>
                                            </div>
                                        </div>
                                    </div> <!-- gender, dob, passport --> 
                                    <br/>
                                    <hr/>
                                        <h1 style="font-size: 18px;">Guidelines on uploading your Passport</h1>
                                    <hr/>
                                     <div class="form-group">
                                                <p>Kindly remember the following before attaching the passport to this application: </n></p>
                                                <label><span class="text-danger" title="Field required">*</span> Please upload a copy of your passport in PNG, JPEG, or JPG format, no larger than 5MB in size.</label>
                                                <label><span class="text-danger" title="Field required">*</span> The image must be high quality, unobstructed, and correct. </label><br/>
                                                <label><span class="text-danger" title="Field required">*</span> The image must show a full document page with both sides of the card. </label><br/>
                                                <label><span class="text-danger" title="Field required">*</span> The biometrics details must be clear, complete, and readable. </label><br/>
                                                
                                            </div>
                                            <div class="form-group-sm text-center">
                                                <img src="<?= base_url('uploads/guide-lines.jpg') ?>" alt="">
                                            </div>
                                </div>
                                <!--     width: 432px; -->
                                <div class="col-sm-5 col-md-5 col-lg-5">
                                    <label> <strong> Passport Image </strong> (護照圖像)</label><br>
                                    
                                    <div class="form-group-sm text-center">
                                        <img alt="User default image" class="img chk" style="height: 294px; width: 478px;" id="img-passport" src="<?= base_url('uploads/passport.png') ?>">
                                        <input id="in-passport" type="file" name="attached_passport" class="m-t-5 m-l-5" accept="image/x-png,image/jpeg"/>
                                    </div>
                                </div>
                            </div>
                            
                        </fieldset>
                    </div>

                </div> <!--Information-->

                <?= form_close(); ?>

            </div>
            
            <!-- TEMP THEME-PANEL(NOTIFICATION) -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
		
        <!-- PREVIEW MODAL -->
        <?php include(APPPATH.'views/modals/image_preview.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <!-- CUSTOM ELEVATE ZOOM (not in use shit)-->
    <script src="<?= base_url('assets/plugins/elevatezoom/jquery.elevatezoom.js'); ?>"></script>

    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/transac/create.js'); ?>"></script>
    
</body>
</html>