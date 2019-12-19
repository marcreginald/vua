<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>
    
    <style>
        /* hiding the black background-modal specifier */
        /*.modal-backdrop.in {
            opacity: -3.7 !important;
        }   */
        
        /* trying the media queryness :D */
        @media only screen and (max-width: 770px){
            #va-gender-edit{
                /* width: 24%; */
                /* display: table-cell; */
                width: 169px;
            }
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
                    <div class="col-md-4 col-lg-4">
                        <button class="btn btn-md btn-inverse" onclick="window.history.back()"> <span class="fa fa-mail-reply"></span> Back (背部) </button>
                        <button class="btn btn-md btn-primary" id="btn-edittransac"> <span class="fa fa-pencil"></span> Update Draft (更新草案)</button>
                    </div>

                </div> <!--btn(back, saveDraft, send)-->

                <?= form_open_multipart('', array('novalidate' => true, 'id' => 'frm-visatransaction-edit')); ?>
                    
                   <div class="row m-t-20">
                        
                        <div class="col-md-12 col-lg-12">
                            
                            <fieldset>
                                <legend> Applicant Information (申請人信息)</legend>
                                <input type="hidden" name="trans_no" id="trans-no" value="<?= $transac_dat->trans_no; ?>">
                                <input type="hidden" name="trans_id" id="trans-id" value="<?= $transac_dat->id; ?>">
                                <div class="row">
                                    
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <label> Last Name (姓)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm field-text" name="va_lname" id="va-lname-edit" value="<?= $transac_dat->va_lname; ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <label> First Name (名字)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm field-text" name="va_fname" id="va-fname-edit" value="<?= $transac_dat->va_fname; ?>" required>
                                                </div>
                                            </div>
                                        </div> <!--lname, fname-->
                                    
                                        <div class="row m-t-10">
                                            <div class="col-md-3 col-lg-3">
                                                <div class="fom-group-sm" style="whitespace:nowrap;">
                                                    <label> Gender (性別)</label>
                                                    <select class="form-control input-sm" name="va_gender" id="va-gender-edit" value="<?= $transac_dat->gender; ?>">
                                                        <option value="">Select Gender ()</option>
                                                        <option value="M" <?= ($transac_dat->va_gender == 'M') ? 'selected' : ''?> >Male</option>
                                                        <option value="F" <?= ($transac_dat->va_gender == 'F') ? 'selected' : ''?> >Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3" style="">
                                                <div class="form-group-sm" style="white-space: nowrap;">
                                                    <label> Date of Birth (出生日期)</label>
                                                    <div class="input-group date" id="datetimepicker1">
                                                        <input type="text" class="form-control" name="va_dob" id="va-dob-edit" value="<?= $dob; ?>" placeholder="個月-天-年">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group-sm">
                                                    <label style="margin-left: 2%;"> Passport Number (護照號)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm field-passnum" name="va_passportnum" id="passport-edit" value="<?= $transac_dat->va_passportnum; ?>" required>
                                                </div>
                                            </div>
                                        </div> <!-- gender, dob, passport --> 
                                    </div>
                                
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label> <strong> Passport Image (護照圖像)</strong> </label><br>
                                    <div class="form-group-sm text-center" style="white-space:nowrap;">
                                        <img src="<?= base_url($transac_dat->attached_passport); ?>" alt="User default image" class="img chk" style="height: 294px; width: 525px;" id="img-passport-edit">
                                        <input type="hidden" name="old_passport" value="<?= $transac_dat->attached_passport; ?>">
                                        <!-- storing the server location of the old passport name -->
                                        <input id="in-passport-edit" type="file" name="attached_passport" class="m-t-5 m-l-5" accept="image/x-png,image/jpeg"/>
                                    </div>
                                </div>
                                
                                </div> <!--mainRow-->
                                
                            </fieldset>
                            
                        </div>
                        
                    </div>
                    
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
        
        <!-- UPDATE CONFIRMATION -->
        <?php include(APPPATH.'views/modals/user_confirmation.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/transac/create.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/transac/edit.js'); ?>"></script>

</body>
</html>