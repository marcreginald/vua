<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Verification, Updation, Delete (Manager) -->
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

			<!-- TEMP BREADCRUMB -->
            <?= $breadcrumb; ?>

			<!-- TEMP H1 HEADER -->
            <?= $header; ?>
            
              <div class="row">
                  <div class="col-sm-5 col-md-5 col-lg-5">
                      <button class="btn btn-inverse btn-sm"> <span class="fa fa-mail-reply"></span> Back </button>
                      <button class="btn btn-success btn-sm"> <span class="fa fa-thumbs-up"></span> Verified </button>
                      <button class="btn btn-info btn-sm">    <span class="fa fa-pencil"></span> Update </button>
                      <button class="btn btn-danger btn-sm">  <span class="fa fa-trash"></span> Delete </button>
                  </div>
                  
                  <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
                      <u><h4> Trans #: TRN-000001 </h4></u>
                  </div>
              </div> <!--./back&transId-->
              
              <div class="row m-t-5">
                  
                   <div class="panel">
                       <h5> <span class="fa fa-bell"> </span><?= $trans_type; ?></h5>
                    
                      <hr>
                       <div class="row">
                           
                             <div class="col-sm-5 col-md-5">
                              
                              <div class="pull-right" style="margin-right:8%; margin-top:5%;">
                                   <h4> Frank Corpuz,  01/24/2018 12:45 am </h4>
                                   <b> from: frankcorpuz@gmail.com </b>
                               </div> 
                                  
                              <div class="image">
                                   <img src="<?= base_url('assets/img/user.png'); ?>" alt="client-image" class="img-rounded" height="90" width="90">
                               </div>
                               
                           </div><!--./col-lg-->
                           
                       </div><!--./sender-->
                       
                       <hr>
                       <div class="row m-t-5">
                           <div class="col-sm-7 col-md-7  col-lg-">
                               <h4> Client Information </h4>
                               <div class="row">
                                   <div class="col-sm-6">
                                       <div class="form-group-sm m-t-10">
                                           <label> Surname: </label>
                                           <input type="text" value="Chen" class="form-control input-sm">
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Last Name: </label>
                                           <input type="text" value="Chen" class="form-control input-sm">
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Gender: </label>
                                           <select class="form-control input-sm" style="width: 33%;">
                                               <option value="Male">Male</option>
                                               <option value="Female">Female</option>
                                           </select>
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Date of Birth: </label>
                                           <input type="text" value="Feb-24-1991" class="form-control input-sm" style="width: 40%;">
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Passport Number: </label>
                                           <input type="text" value="123456789" class="form-control input-sm" style="width: 50%;">
                                       </div>
                                       
                                       
                                   </div>
                                   
                                   <div class="col-sm-6">
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Via: </label>
                                           <select class="form-control input-sm" style="width: 40%;">
                                               <option value="Airlines">Airlines</option>
                                               <option value="Cruise">Cruise</option>
                                           </select>
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Flight/ Voyage#: </label>
                                           <input type="text" value="0616161" class="form-control input-sm">
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Departure: </label>
                                           <input type="text" value="02/24/2018" class="form-control input-sm">
                                       </div>
                                       
                                       <div class="form-group-sm m-t-10">
                                           <label> Arrival: </label>
                                           <input type="text" value="02/25/2018" class="form-control input-sm">
                                       </div>
                                       
                                       
                                   </div>
                               </div>
                           </div><!--./client-info-->
                           
                           <div class="col-sm-5 col-md-5 col-lg-5">
                               <h4>Passport</h4>
                               <img src="<?= base_url('assets/vuaimg/chenchen.jpg') ?>" alt="Chen Chen Passport Image" >
                           </div><!--./passportImg-->

                       </div> <!--./client-information-->
                       <hr>
                       
                       <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                               <h4>Attachments</h4>
                               <a href="javascript:;">sample.docs</a>
                           </div>
                       </div> <!--./attachments-->
                       
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


<!-- just viewing a specific transaction-->