<?php
  /* custom flag for is approve or not */
    if(isset($approved_date)){
        $enableApprove = TRUE;
    }else{
        $enableApprove = FALSE;
    }

    $image_confirmation = (isset($image_confirmation) ? $image_confirmation : NULL);
    /*var_dump($image_confirmation);
    die();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH.'views/templates/header.php'); ?>

    <style>
        /*fieldset{
            padding: 0px 19px 10px 29px;
        }*/
        
        /*.image-upload > input
        {
            display: none;
        }
        
        .fa-file-image-o{
            font-size: 37px;*/
            /* border: thin solid blue; */
            /* margin-left: 35px; */
            /*margin-left: 130px;
            margin-top: 5%;
            cursor: pointer;
        }*/
        
        /*input[type="file"] {
            display: none;
        }*/
        
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 4px 8px;
            cursor: pointer;
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
                    <div class="col-md-7 col-lg-7">
                                       
                       <!--<button class="btn btn-md btn-inverse hd" onclick="history.back()"> <span class="fa fa-mail-reply"></span> Back (背部)</button>-->

                        <button class="btn btn-primary btn-md" id="print-rqlletter" data-crntrqlid="<?= $rql_id; ?>"> <span class="fa fa-file-pdf-o"></span> Request Letter (請求信)</button>
                        
                        <?php if($enableApprove): ?>
                        <button class="btn btn-success btn md" id="download-approved" data-crntrqlid="<?= $rql_id; ?>"> <span class="fa fa-download"></span> Download Visa </button>
                        <?php endif; ?>
                        
                       <?php if(!$enableApprove): ?>
                       <button class="btn btn-success btn-md" id="btn-approve" data-batchno="<?= $batch_info->batch_no; ?>" data-rqlid="<?= $rql_id; ?>"> <span class="fa fa-save"></span> Approve (批准)</button>
                       
                       <button class="btn btn-info btn-md" title="Download attached E-Ticket" id="btn-geteticket" data-batchnum="<?= $batch_num; ?>"> <span class="fa fa-cloud-download fa-lg"></span> E-Ticket (電子機票)</button>
                       
                       <?php endif; ?>
                        <div class="row m-t-10">
                           
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label> Agent Name (代理名稱)</label>
                                   <input type="text" class="form-control input-sm" id="to-agent" value="<?= $to_agent; ?>" readonly>
                                </div>
                            </div><!--Agent-->
                            
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label> Date Approved (日期已批准) <span class="text-danger" title="Field required">*</span> </label>
                                    <input type="text" class="form-control input-sm" id="date-approved" value="<?= (isset($approved_date) ? $approved_date : date('m-d-Y') ) ?>" <?= ($enableApprove) ? 'readonly' : '' ?> placeholder="個月-天-年">
                                </div>
                            </div><!--Date Approved-->
                        </div> 
                        
                        <div class="row m-t-10">
                            
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <label> Arrival Date (到達日期)</label>
                                    <input type="text" class="form-control input-sm" id="compose-arrivaldate" value="<?= $arrival; ?>" readonly>
                                </div>
                            </div><!--Arrival Date-->
                            
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <label> Flight/Cruise Name </label>
                                    <input type="text" class="form-control input-sm" id="arrival" value="<?= strtoupper($batch_info->flight_or_voyagenum); ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label> Airline/Port (航空公司/港口)</label>
                                    <input type="text" class="form-control input-sm" id="airline-port" value="<?= ucwords($batch_info->via); ?>" readonly>
                                </div>
                            </div><!--airline/port-->
                        </div>
                        
                        <div class="row m-t-10 m-b-10">
                            <div class="col-sm-12">
                                <div class="form-group-sm">
                                    <label> Port of Entry (進口港)</label>
                                    <input type="text" class="form-control input-sm" id="poe" value="<?= ucwords($batch_info->port_of_entry); ?>" readonly>
                                </div>
                            </div><!--port of entry-->
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 m-t-20">
                        
                        <div class="row">
                           <small style="font-size: 12px;"> Confirmation Letter (確認信)</small>
                            <div class="col-sm-12 col-md-12" style="height: 184px; border-style: ridge;" id="confirm-frame">
                                
                                <?php if(is_null($image_confirmation)): ?>
                                   <p> No Image found </p> 
                                <?php else: ?>
                                    <?php for($i=0, $ln=count($image_confirmation); $i < $ln; $i++): ?>
                                        <img src="<?= base_url('uploads/'.$image_confirmation[$i]); ?>" width="100" height="90" class="custom-file-upload" id="img-comfirmpic">
                                    <?php endfor; ?>
                                <?php endif; ?>
                                
                            </div>
                            
                            <?php if($rql_status != 'approved'): ?>
                            <?= form_open_multipart('', array('novalidate' => true, 'id' => 'attached-confirmletter')); ?>
                            <input type="file" multiple name="confirmation_pic[]" id="attach-confirmationrql" accept="image/x-png,image/jpeg">
                            <?= form_close(); ?>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>

           
                <div class="row m-t-15">
                   <div class="col-md-12 col-lg-12">

                       <h4> List of Applicants (申請人名單)</h4>
                       <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="listapplicant-table">
                               <thead>
                                   <tr class="white">
                                       <th style="width:1%"> #. <br>(數)</th>
                                       <th style="width:30%"> Name <br>(全名)</th>
                                       <th style="width:1%"> Gender <br>(性別)</th>
                                       <th style="width:18%"> Date of Birth <br>(出生日期)</th>
                                       <th style="width:20%"> Passport Number <br>(護照號)</th>
                                       <th style="width:5%"> Status <br>(狀態)</th>
                                       <th style="width:5%"> Image <br>(圖片)</th>
                                       <th style="width:10%"> Action <br>(行動)</th>
                                   </tr>
                               </thead>

                               <tbody id="tbod-listapplicant">
                                    <!-- display it on load of the view -->
                                    <?php $num=1; foreach($rql_applicants as $applicant): ?>
                                          <?php 
                                            $fullName = $applicant->fname.' '.$applicant->lname;
                                          ?>
                                       <tr>
                                            <td><?= $num++; ?></td>
                                            <td><?= ucwords($fullName) ?></td>
                                            <td><?= $applicant->gender ?></td>
                                            <td><?= date('M. d, Y', strtotime($applicant->dob)); ?></td>
                                            <td><?= strtoupper($applicant->pass_num); ?></td>
                                           
                                            <!-- rql_status -->
                                       <td>
                                              
                                               <!--?php if($rql_status != 'printed'): ?-->
                                                   <!--<span class="fa-stack fa-2x text-success" title="Stampped image successfully Uploaded" style="font-size: 19px;" id="stampped-notification">
                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                    <i class="fa fa-check fa-stack-1x"></i>
                                                    </span>-->
                                                <!--?php //endif; ?-->
                                       </td>
                                            
                                            <td> 
                                               <table>
                                                   <tr>
                                                       <td>  <img src="<?= base_url($applicant->stampped_passport); ?>" width="85" height="60" class="custom-file-upload"> 
                                                       <?= form_open_multipart('', array('novalidate' => true, 'id' => 'frm-stampped-pass')); ?>
                                                       <input id="file-upload" type="file" style="width: 104%;" name="stamppedpic" accept="image/x-png,image/jpeg">
                                                       <input type="hidden" name="vt_id" value="<?= $applicant->id ?>">
                                                        <?= form_close(); ?>
                                                        </td>
                                                   </tr>
                                               </table>
                                            </td>

                                            <td>
                                                <button class="btn btn-icon btn-lg btn-success" style="display:block; margin:auto;" title="Attach stampped passport" id="btn-update-stamppedpass"> <span class="fa fa-sm fa-cloud-upload"></span></button>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                               </tbody>
                           </table>   
                       </div>

                   </div>
               </div> <!--./list of applicants-->
            </div>
            
            <!-- TEMP THEME-PANEL(NOTIFICATION) -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->
       
        <!-- modal previewing the image -->
        <?php include(APPPATH.'views/modals/image_preview.php'); ?>

        <?php include(APPPATH.'views/modals/user_confirmation.php'); ?>
        
	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/visa/visaview.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/visa/visaview-approved.js'); ?>"></script>
    
    
    <script>
      
     /* downloading the e-ticket */
     var $BTN_ETICKER = $('#btn-geteticket');
        
      /* print request letter button */
      // var apiPrint = SITE_BASEPATH+"/composerequestletter/print/";
      var apiPrint = SITE_BASEPATH+"<?= $pdf_print; ?>";
      var apiDown  = SITE_BASEPATH+"/downloadvisaimg/down/"
      $(function () {
        $('#print-rqlletter').on('click', function (e) {
            e.preventDefault();

            let printUrl = apiPrint+$(this).data('crntrqlid');
            window.open(printUrl,"windowid","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");

        });
          
        /* for the download part of the visa transaction */  
        $('#download-approved').on('click', function(e){
            e.preventDefault();
            let downUrl = apiDown+$(this).data('crntrqlid');
            window.open(downUrl,"windowid","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
        });
          
      });
      /* additional feautures no back end changes needed. */
    
      /* downloadin the eticket */
      $BTN_ETICKER.on('click', function(e){
        e.preventDefault();
          
          let crntBatchNum = $(this).data('batchnum');
          window.open(SITE_BASEPATH+"/batchrecords/downeticket/"+crntBatchNum, '_blank');
      });
        
    </script>
</body>
</html>