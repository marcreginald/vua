<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>

    <style>
        /*.modal-backdrop.in {
            opacity: -3.7 !important;
        }*/
        
        .image-upload > input
        {
            display: none;
        }
        
        .fa-file-image-o{
            font-size: 37px;
            /* border: thin solid blue; */
            /* margin-left: 35px; */
            margin-left: 130px;
            margin-top: 5%;
            cursor: pointer;
        }
        
        /* hiding the black background-modal specifier */
        /*.modal-backdrop.in {
            opacity: -3.7 !important;
        }*/
    
        .content{
            margin-left: 0 !important;
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
                        
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <table>
                                    <tr>
                                        
                                        <td rowspan="2"><img src="<?= base_url($transac_dat->senderpic); ?>" alt="Sender image" class="rounded float-left" width="75" height="75" style="border-radius:25px;"> </td>
                                        <td style="padding-left:10px;" valign="bottom"> <b style="text-transform:uppercase;font-size: 14px;">Sender (寄件人)</b> <br> <b> <?= $transac_dat->sender_name; ?> </b> <em> <?= $transac_dat->date_sent; ?> </em> </td>
                                    </tr>
                                    <tr >
                                        <td style="padding-left:10px;" valign="top"> <?= $transac_dat->sender_email; ?> </td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                                           
                        <!--<div class="row hd">
                             <div class="col-md-12 col-lg-12">
                             <h3 style="font-size: 19px"> Request to verify transaction#.  <strong style="text-transform:uppercase;"> <!?= $transac_dat->trans_no; ?> </strong></h3> 
                             </div>   
                        </div>-->
                                            
                    </div>
                    
                   <div class="col-sm-7 col-sm-offset-1 col-md-7 col-sm-offset-1 col-lg-7 col-lg-offset-1">
                        <div class="row m-t-5">
                            <!-- <div class="col-md-12 col-lg-12 col-chk"> -->
                            <!-- <div class="col-sm-3 col-md-3 col-lg-3 col-chk"> -->
                            <?php if($transac_dat->status != "VERIFIED"): ?>
                            <button class="btn btn-md btn-inverse" onclick="window.history.back()" style="margin-left: 52px;"> <span class="fa fa-mail-reply"></span> Back (背部)</button>
                            <?php endif; ?>
                            <!-- </div> -->

                            <!-- <div class="col-sm-2 col-sm-offset-1 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1 col-chk"> -->
                            <?php if($transac_dat->status != "VERIFIED"): ?>
                            <button class="btn btn-md btn-success" id="btn-verified"> <span class="fa fa-thumbs-up"></span> Verified (驗證)</button>
                            <?php endif; ?>
                            <!-- </div> -->

                            <!-- <div class="col-sm-3 col-md-3 col-lg-3 col-chk"> -->
                            <?php if($transac_dat->status != "VERIFIED"): ?>
                            <button class="btn btn-md btn-primary" id="btn-editclientinfo" style="margin-left: 5px;"> <span class="fa fa-pencil"></span> Update Draft (更新草案)</button>
                            <?php endif; ?>
                            <!-- </div> -->

                            <!-- <div class="col-sm-3 col-md-3 col-lg-3 col-chk"> -->
                            <?php if($transac_dat->status != "VERIFIED"): ?>
                            <button class="btn btn-md btn-danger" id="btn-junk"> <span class="fa fa-trash"></span> Move to Junk (轉到垃圾)</button>
                            <?php endif; ?>
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        
                    </div>
                    
                </div>
                <hr>
                <div class="row m-t-20">
                    <div class="div col-md-12 col-lg-12">
                        <?= form_open('', array('novalidate' => true, 'id' => 'frm-mgrvisatransaction')); ?>
                            <fieldset>
                                <legend> Applicant Information (申請人信息)</legend>

                                <div class="col-md-6 col-lg-6">
                                   
                                   <div class="row">
                                       <input type="hidden" id="trans-id" name="trans_id" value="<?= $transac_dat->trans_id; ?>">
                                       <input type="hidden" id="trans-no" name="trans_no" value="<?= $transac_dat->trans_no; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <label> Lastname (姓)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm" name="va_lname" id="va-lname-edit" value="<?= $transac_dat->lname; ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <label> Firstname (名字)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm" name="va_fname" id="va-fname-edit" value="<?= $transac_dat->fname; ?>" required>
                                                </div>
                                            </div>
                                        </div> <!--lanme, fname-->

                                        <div class="row m-t-10">
                                            <div class="col-md-3 col-lg-3">
                                                <div class="fom-group-sm" style="white-space:nowrap;">
                                                    <label> Gender (性別)<span class="text-danger" title="Field required">*</span> </label>
                                                    <select class="form-control input-sm" name="va_gender" id="va-gender-edit" value="<?= $transac_dat->gender; ?>">
                                                        <option value="M" <?= ($transac_dat->gender == 'M') ? 'selected' : ''?> >Male</option>
                                                        <option value="F" <?= ($transac_dat->gender == 'F') ? 'selected' : ''?> >Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3" style="">
                                                <div class="form-group-sm" style="white-space:nowrap;">
                                                    <label> Date of Birth (出生日期)<span class="text-danger" title="Field required">*</span></label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" placeholder="個月-天-年" name="va_dob" id="va-dob-edit" value="<?= $dob; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group-sm">
                                                    &nbsp; &nbsp; <label> Passport Number (護照號)<span class="text-danger" title="Field required">*</span></label>
                                                    <input type="text" class="form-control input-sm field-passnum" name="va_passportnum" id="passport-edit" value="<?= $transac_dat->passportnum; ?>" required>
                                                </div>
                                            </div>
                                      </div> <!--gender,dob,passportNum-->
                                      
                                    </div> <!--row1-->
                                    
                                    <div class="row m-t-20">
                                        <fieldset>
                                            <legend> Flight Details (航班詳情)</legend>
                                            
                                            <div class="row">
                                               
                                                <div class="col-sm-6">
                                                    <div class="form-group-sm">
                                                        <label> Arrival Date (到達日期)</label>
                                                        <input type="text" class="form-control" placeholder="mm-dd-yyyy" id="arrival" value="<?= $arrival; ?>" readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                     <div class="form-group-sm">
                                                        <label> Via (通過)<small>(Airline/Port) (航空公司/港口)</small></label>
                                                        <input type="text" class="form-control input-sm" id="via" value="<?= $transac_dat->via; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div> <!--row1-->
                                            
                                            <div class="row m-t-10">
                                                <div class="col-sm-6">
                                                    <div class="form-group-sm">
                                                        <label> Flight/Cruise Name (飛行/ 巡航 名稱) </label>
                                                        <input type="text" class="form-control input-sm" id="f-v-num" value="<?= $transac_dat->fov; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group-sm">
                                                        <label> Port of Entry (進口港)</label>
                                                        <input type="text" class="form-control input-sm" id="va-fname" value="<?= $transac_dat->poe; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div> <!--row2-->
                                            
                                        </fieldset>
                        
                                    </div>
                                    
                                    
                                </div> <!--client_information-->

                                <div class="col-md-6 col-l-6">
                                   
                                    <label> <strong> Passport Image (護照圖像)</strong> </label><br>
                                    <div class="form-group-sm text-center" style="white-space:nowrap;">
                                        <img src="<?= base_url($transac_dat->passport_pic); ?>" alt="User default image" class="img chk" style="height: 294px; width: 525px;" id="img-passport">
                                    </div>
                                    
                                </div> <!--passpotImg-->

                            </fieldset>

                        <?= form_close(); ?>
                    </div>
				</div>
                
            </div>
            
            <!-- TEMP THEME-PANEL(NOTIFICATION) -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
		
        <!-- PREVIEW MODAL -->
        <?php include(APPPATH.'views/modals/image_preview.php'); ?>
        
        <!-- VERIFICATION-CONFIRMATION MODAL -->
        <?php include(APPPATH.'views/modals/verifying_transac.php'); ?>

        <!-- JUNKING A VISA TRANSACTION -->
        <?php include(APPPATH.'views/modals/junking_transac.php'); ?>

        <!-- CONFIRMATION OF EDIT -->
        <?php include(APPPATH.'views/modals/update_transac.php'); ?>

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/transac/create.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/transac/verifying.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/transac/junking.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/mgr/edittransac.js'); ?>"></script>
    
    <script>
        $(function(){
            /* */
            $('#header > div > ul > li.dropdown.navbar-user').remove(); // removing the user
            $('#sidebar').remove(); // outer hide sidebar 
            $('#page-container > div.sidebar-bg').remove(); // inner hide sidebar
        });
    </script>

</body>
</html>