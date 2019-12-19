<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>

    <style>
        /*fieldset{
            padding: 0px 19px 10px 29px;
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
        
        <?php //include(APPPATH.'views/templates/sidebar_sec.php'); ?>

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
                                        
                                        <td rowspan="2"><img src="<?= base_url($sender_info->profile); ?>" alt="Sender image" class="rounded float-left" width="75" height="75" style="border-radius:25px;"> </td>
                                        <td style="padding-left:10px;" valign="bottom"> <b style="text-transform:uppercase;font-size: 14px;">Sender (寄件人)</b> <br> <b> <?= $sender_info->fullname; ?> </b> <em> <?= $date_sent; ?> </em> </td>
                                    </tr>
                                    <tr >
                                        <td style="padding-left:10px;" valign="top"> <?= $sender_info->email; ?> </td>
                                    </tr>
                                </table> 
                                <br/>
                                <br/>
                                <button class="btn btn-md btn-inverse" onclick="window.history.back()"> <span class="fa fa-mail-reply"></span> Back (背部) </button>
                            </div>
                        </div>
                                                                                    
                    </div>
                    
                    <?php if($transac_dat->trans_status === 'APPROVED'): ?>
                        <div class="col-md-2 col-md-offset-6 col-lg-2 col-lg-offset-6 m-t-25">
                            <button class="btn btn-success btn md pull-right" id="trans-approved" data-crnttrans="<?= $trans_num; ?>"> <span class="fa fa-download"></span> Download Visa </button>
                        </div>
            
                    <?php endif; ?>
                    
                </div> <!--1ST_ROW-->
                
                <hr>
                <div class="row m-t-20">
                    <div class="div col-md-12 col-lg-12">
                        <?= form_open('', array('novalidate' => true, 'id' => 'frm-mgrvisatransaction')); ?>
                            <fieldset>
                                <legend> Applicant Information (申請人信息)</legend>

                                <div class="col-md-6 col-lg-6">
                                   
                                   <div class="row">
                                       <input type="hidden" id="trans-id" name="trans_id" value="<?= $transac_dat->id; ?>">
                                       <input type="hidden" id="trans-no" name="trans_no" value="<?= $transac_dat->trans_no; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <label> Last Name (姓)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm" value="<?= $transac_dat->va_lname; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <label> First Name (名字)<span class="text-danger" title="Field required">*</span> </label>
                                                    <input type="text" class="form-control input-sm" value="<?= $transac_dat->va_fname; ?>" readonly>
                                                </div>
                                            </div>
                                        </div> <!--lanme, fname-->

                                        <div class="row m-t-10">
                                            <div class="col-md-3 col-lg-3">
                                                <div class="fom-group-sm" style="white-space:nowrap;">
                                                    <label> Gender (性別)<span class="text-danger" title="Field required">*</span> </label>
                                                    <select class="form-control input-sm" value="<?= $transac_dat->gender; ?>" readonly disabled>
                                                        <option value="M" <?= ($transac_dat->va_gender == 'M') ? 'selected' : ''?> >Male</option>
                                                        <option value="F" <?= ($transac_dat->va_gender == 'F') ? 'selected' : ''?> >Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3" style="">
                                                <div class="form-group-sm" style="white-space:nowrap;">
                                                    <label> Date of Birth (出生日期)<span class="text-danger" title="Field required">*</span></label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" placeholder="mm-dd-yyyy" value="<?= $dob; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group-sm">
                                                    &nbsp; &nbsp; <label> Passport Number (護照號)<span class="text-danger" title="Field required">*</span></label>
                                                    <input type="text" class="form-control input-sm field-passnum" value="<?= $transac_dat->va_passportnum; ?>" required readonly>
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
                                                        <input type="text" class="form-control" placeholder="mm-dd-yyyy" value="<?= $arrival; ?>" readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                     <div class="form-group-sm">
                                                        <label> Via (通過)<small>(Airline/Port) (航空公司/港口)</small></label>
                                                        <input type="text" style="text-transform: capitalize;" class="form-control input-sm" value="<?= $transac_dat->via; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div> <!--row1-->
                                            
                                            <div class="row m-t-10">
                                                <div class="col-sm-6">
                                                    <div class="form-group-sm">
                                                        <label> Flight/Cruise(飛行/ 巡航) </label>
                                                        <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="flight_or_voyagenum" id="f-v-num" value="<?= $transac_dat->flight_or_voyagenum; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group-sm">
                                                        <label> Port of Entry (進口港)</label>
                                                        <input type="text" style="text-transform: capitalize;" class="form-control input-sm" value="<?= $transac_dat->port_of_entry; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div> <!--row2-->
                                            
                                        </fieldset>
                        
                                    </div>
                                    
                                    
                                </div> <!--client_information-->

                                <div class="col-md-6 col-l-6">
                                   
                                    <label> <strong> Passport Image (護照圖像)</strong> </label><br>
                                    <div class="form-group-sm text-center" style="white-space:nowrap;">
                                       <?php $img = ($transac_dat->stampped_passport != 'uploads/passport.png') ? $transac_dat->stampped_passport : $transac_dat->attached_passport; ?>
                                        <img src="<?= base_url($img); ?>" alt="User default image" class="img chk" style="height: 294px; width: 525px;" id="img-passport">
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
       
       <?php include(APPPATH.'views/modals/image_preview.php'); ?>
        
	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script>
        $MOD_PREVIEW = $("#image-preview");
        
        var apiDown  = SITE_BASEPATH+"/downloadvisaimg/down/0/"
        
        $(function(){
            
            /* watcher for the image  click to show the modal */
            $('img').on('click',function(e){
                e.preventDefault();
                $('#img-preview').attr('src', $(this).attr('src'));
                $MOD_PREVIEW.modal('show');
            });
            
            /* allow the image to be draggable */
            $('#image-preview').draggable();
            
            
            /* downloading the current visa transaction image */
            $('#trans-approved').on('click',function(e){
                e.preventDefault();
                let downUrl = apiDown+$(this).data('crnttrans');
                window.open(downUrl,"windowid","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
            });
        });
    </script>
</body>
</html>