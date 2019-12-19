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
                    <div class="col-md-4 col-lg-4">
                        <button class="btn btn-md btn-inverse" onclick="history.back()"> <span class="fa fa-mail-reply"></span> Back (背部)</button>
                        <button class="btn btn-md btn-info" id="draft-reql"> <span class="fa fa-save"></span> Save Draft (保存草稿)</button>
                    </div>
                </div> <!--./buttons row-->

                <div class="row m-t-20">

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group-sm">
                            <label> To (至)</label>
                            <select id="to-commissioner" class="form-control input-sm">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group-sm">
                            <label> Date (日期) <span class="text-danger" title="Field required">*</span></label>
                            <input type="text" class="form-control input-sm" id="compose-date" value="<?= date('m-d-Y'); ?>" placeholder="個月-天-年" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group-sm">
                            <label> Signatory (簽字)</label>
                            <select id="assignatory" class="form-control input-sm">
                            </select>
                        </div>
                    </div>

                </div> <!--to, date, assignatory-->

                <div class="row m-t-15">

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group-sm">
                            <label> Airline/Port (航空公司/ 港口)</label>
                            <input type="text" class="form-control input-sm" style="text-transform: capitalize;" id="airline-port" readonly value="<?= $travel_info['airline_port']; ?>">
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

	</div>
	<!-- end page container -->
    
    <!-- TEMP FOOTER -->
    <?php include(APPPATH.'views/templates/footer.php'); ?>
    
    <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/requestletter/compose-design.js'); ?>"></script>
    <script src="<?= base_url('assets/js/pages/requestletter/compose-savedraft.js'); ?>"></script>
    
</body>
</html>