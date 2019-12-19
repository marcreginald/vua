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
            
            <div class="panel">
                    
                    <div class="row">
                        
                        <div class="col-md-12 col-lg-12">
                            <button class="btn btn-inverse btn-md" onclick="history.back()"> <span class="fa fa-mail-reply"></span> Back (背部)</button>
                            
                            <button class="btn btn-primary btn-md" id="update-reql"> <span class="fa fa-save"></span> Update (更新)</button>
                            
                            <button class="btn btn-info btn-md" title="Download attached E-Ticket" id="btn-geteticket" data-batchnum="<?= $batch_no; ?>"> <span class="fa fa-cloud-download fa-lg"></span> E-Ticket (電子機票)</button>
                            
                            <button class="btn btn-primary btn-md bg-success pull-right" title="Print the request letter" id="btn-printdraft-rql" data-crntrql="<?= $rqlid; ?>" data-crntbatchnum="<?= $batch_no; ?>"> <span class="fa fa-share-square-o"></span> Generate Letter (生成信件) </button>
                            
                        </div>
                        
                   </div> <!--./buttons row-->
                   
                    <div class="row m-t-20">
                        
                        <input type="hidden" id="batch-id" value="<?= $batch_no; ?>">
                        <input type="hidden" id="rql-id" value="<?= $rqlid; ?>">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group-sm">
                                <label> To (至)</label>
                                <select id="to-commissioner-edit" class="form-control input-sm">
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group-sm">
                                <label> Date (日期)</label>
                                <input type="text" class="form-control input-sm" id="compose-date-edit" value="<?= $letter_date; ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group-sm">
                                <label> Signatory (簽字)</label>
                                <select id="assignatory-edit" class="form-control input-sm">
                                </select>
                            </div>
                        </div>

                    </div> <!--to, date, assignatory-->
                    
                    <div class="row m-t-10">
                       
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group-sm">
                                <label> Airline/Port (航空公司/ 港口)</label>
                                <input type="text" class="form-control input-sm" style="text-transform: capitalize;" readonly value="<?= $travel_info['airline_port']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group-sm">
                                <label> Port of Entry (進口港)</label>
                                <input type="text" class="form-control input-sm" style="text-transform: capitalize;" id="compose-poe" readonly value="<?= $travel_info['poe']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-lg-2">
                            <div class="form-group-sm">
                                <label> Flight Number (航班號)</label>
                                <input type="text" class="form-control input-sm" style="text-transform: uppercase;" id="compose-flightnum" value="<?= $travel_info['flight_num']; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-lg-2">
                            <div class="form-group-sm">
                                <label> Arrival Date (到達日期)</label>
                                <input type="text" class="form-control input-sm" readonly id="compose-arrivaldate" value="<?= $travel_info['arrival']; ?>">
                            </div>
                        </div>

                    </div> <!--airline/port, port of entry, flight number, arrival date-->
                   
                   <div class="row m-t-15">
                       <div class="col-md-12 col-lg-12">
                           
                           <h4> List of Applicants (申請人名單)</h4>
                           <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                   <thead>
                                       <tr class="white">
                                           <th>#. (數)</th>
                                           <th style="text-transform: uppercase;">Full Name (名稱)</th>
                                           <th style="text-transform: uppercase;">Gender (性別)</th>
                                           <th style="text-transform: uppercase;">Date of Birth (出生日期)</th>
                                           <th style="text-transform: uppercase;">Passport Number (護照號)</th>
                                           <th style="text-transform: uppercase;">Status (狀態)</th>
                                       </tr>
                                   </thead>
                                   
                                   <tbody id="tbod-listapplicant" style="text-transform: capitalize;">
                                    <!-- list applicant ajax-->
                                   </tbody>
                               </table>   
                           </div>
                            
                       </div>
                   </div> <!--./list of applicants-->
                </div>
            
            <!-- TEMP THEME-PANEL -->
            <?php include(APPPATH.'views/templates/theme_panel_sec.php'); ?>
           
            <!-- TEMP FOOTER -->
            <?php include(APPPATH.'views/templates/footer_sec.php'); ?>

		</div>
		<!-- end #content -->

        <?php include(APPPATH.'views/modals/confirm_generation.php'); ?>
        
        <!-- UPDATE CONFIRMATION MODAL -->
        <?php include(APPPATH.'views/modals/user_confirmation.php'); ?>
	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script> 
    <script>
        var $TBOD = $("#tbod-listapplicant"); // tbody
        
        var $MOD_UPDATE_RQL = $("#mod-confirmation");
        
        /* tbody list applicants */
        var getListApplicants = function(){
    
            $TBOD.empty();
            let crntBatchId = "<?= $batch_no; ?>";
            $.get(SITE_BASEPATH+"/vua/util/getbatchapplicationlist/"+crntBatchId, function(rows){
                $TBOD.append(rows);
            });
        }
        
        /* submitting the updated Request letter */
        var submitUpdatedTransac = function (){
            
            $('#yes-confirm').attr('disabled', true);
            
            var data = {};
            data.rql_id = $('#rql-id').val();
            data.rq_to = $('#to-commissioner-edit').val();
            data.letter_date = $('#compose-date-edit').val();
            data.assignatory = $('#assignatory-edit').val();

            $.post(SITE_BASEPATH+"/vua/composeedit/updaterqldraft", $.param(data), function(res){
                console.log(res);
                if(res.status){
                   showGritter('Success!', 'Request letter been updated');
                    setTimeout(function(){
                        location.reload(true);
                    }, 1000);
                }else{
                   showGritter('Error!', 'Unable to update request letter', 'error');
                }
            });
        }
        
        /* DOM READY */
        $(function(){
            getListApplicants();
            datetimepicker('compose-date-edit');
            select2wan('to-commissioner-edit', SITE_BASEPATH+"/vua/util/getcommisionerlist", "<?= $to; ?>");
            select2wan('assignatory-edit', SITE_BASEPATH+"/vua/util/getassignatorylist", "<?= $signatory; ?>");
            
            /* showing the modal for the update */
            $('#update-reql').on('click', function(e){
                e.preventDefault();
                
                $('#big-noti').text('Are you sure, you want to Update?');
                $MOD_UPDATE_RQL.modal({backdrop:"static", keyboard:"false"});
            }); 
            
            /* confirmation of the update of the request letter */
            $MOD_UPDATE_RQL.on('click', '#yes-confirm', function(e){
                e.preventDefault();
                 submitUpdatedTransac();
            });
            
        });
    </script>
    <script src="<?= base_url('assets/js/pages/mgrdraftrquestlet/mgrdraftrquestlet.js'); ?>"></script>

</body>
</html>