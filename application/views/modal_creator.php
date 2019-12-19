<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Source Admin | UI Modal & Notification</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png">

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="<?= base_url('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css'); ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/css/style.min.css'); ?>" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom-styles.css'); ?>">

     <!-- ================== BEGIN SELECT2 CSS STYLE =================== -->
	<link href="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" />
	<!-- ================== END SELECT2 CSS STYLE =================== -->
	
	<!-- ================== DATE TIME PICKER CSS ======================= -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datetimepicker/build/css/bootstrap-datetimepicker.min.css'); ?>">
    <!-- ================== DATE TIME PICKER CSS ======================= -->

	<style>
        .select2-container--default .select2-selection--single{
/*            width: 230px !important; returned */
              width:558px !important;
        }
/*
        .select2 .select2-container .select2-container--default .select2-container--below{
            width: 0px !important;
        }
*/

/*
        .select2-selection .select2-selection--multiple{
            width: 230px !important;
        }
*/
        .select2-container--default .select2-selection--multiple{
            width: 230px !important;
        }
    </style>

</head>
<body>
			<div id="content" class="content">

				<!-- begin section-container -->
				<div class="section-container section-with-top-border p-b-5">
				    <h5 class="m-t-0">Modal Creator</h5>
						<!-- custom modal 4 service agreement -->
					<div class="col-md-6">
                        <div class="clearfix m-b-25">
                            <div class="panel p-20 m-b-20">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="#mod-batchtranslist" class="btn btn-info btn-icon btn-circle btn-lg" data-toggle="modal" title="Show remarks"><i class="fa fa-comments"></i></a>
                                    </div>
                                </div>
                            </div>


<!--  -->
<div class="modal fade in" id="mod-batchtranslist"> <!--  -->
    <div class="modal-dialog" style="margin-left: 15%;"> <!-- -->
            <div class="modal-content" style="width:1050px;">

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;" id="header-mod-client-edit">  <span class="fa fa-clipboard fa-sm" style="font-size:18px;"></span> &nbsp; <span id="batch-num">BATCH-1</span> </h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                   
                   <div class="row">
                       <div class="row">
                           
                           <div class="col-md-3 col-sm-offset-1 col-lg-3 col-lg-offset-1">
                                <strong> TRAVEL TYPE: </strong>
                                <p id="v-traveltype">airplane</p>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> FLIGHT/VOYAGE#: </strong>
                               <p id="v-fovnum">NSAJKF8</p>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> ARRIVAL DATE: </strong><br>
                               <span id="v-arrivaldate">Mar. 06, 2018</span>
                           </div>

                       </div> <!--1stRow-->
                       
                       <div class="row">
                           
                           <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1">
                               <strong> VIA: </strong><br>
                               <span id="v-via">katiklan</span>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> PORT OF ENTRY: </strong><br>
                               <span id="v-poe">sample port of entry</span>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> DATE SENT: </strong><br>
                               <span id="v-dsent">Mar. 06, 2018 9:56 AM</span>
                           </div>

                       </div>
                   </div>
                   
                   
                    <div class="row m-t-20">
                        <div class="col-md-12 table-responsive" style="overflow: auto; height:450px;">
                            <table class="table table-bordered">
                                <thead class="white">
                                    <tr>
                                        <th style="width:1%;">No.</th>
                                        <th style="width:15%;">Trans #</th>
                                        <th style="width:20%;">Fullname</th>
                                        <th style="width:1%">Gender </th>
                                        <th style="width:15%;">Birthday</th>
                                        <th style="width:10%;">Passport #. </th>
                                        <!--<th style="width:15%;">Arrival</th>
                                        <th style="width:12%;">Flight/Voyage #.</th>-->
                                        <th style="width:1%;"> Status </th>
                                    </tr> 
                                </thead>
                                
                                <tbody id="batch-translist">
                                    <tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr><tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr><tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr><tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr><tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr><tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr><tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>TRANS-1</td>
                                        <td>John lito bardinas</td>
                                        <td>M</td>
                                        <td>Dec. 15, 1996</td>
                                        <td>SBAFB3274</td>
                                        <td>pending</td>
                                    </tr>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   <div class="row">
                       <div class="col-md-2 col-sm-2 col-md-offset-5 col-md-offset-5">
                           <button class="btn btn-info btn-block btn-md" title="Download attached E-Ticket"> <span class="fa fa-cloud-download fa-lg" style="font-size: 27px;"></span></button>
                       </div>
                   </div>
                </div>
            </div>
            <!-- ./modal-content -->
    </div>
    <!-- ./modal-dialog -->
</div>











































                       	</div>
                        <!-- ./clearfix -->
	                </div>
				</div>
				<!-- end section-container -->

			</div>
			<!-- end #content -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url('assets/plugins/jquery/jquery-1.9.1.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery/jquery-migrate-1.1.0.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- begin select2 -->
	<script src="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js'); ?>"></script>
	<!-- end select2 -->

    <!-- parsley -->
    <script src="<?= base_url('assets/plugins/parsley/dist/parsley.js'); ?>"></script>
    
    <!-- moment -->
    <script src="<?= base_url('assets/plugins/datetimepicker/build/moment.js') ?>"></script>

    <!-- datetimepicker -->
    <script src="<?= base_url('assets/plugins/datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>

<!--     <script src="<?= base_url('assets/js/customvua/plugins.js'); ?>"></script>-->
     <script>
         
        var $FRM_SENDBATCH = $("#frm-sendbatch").parsley();
        var $MOD_SENDBATCH = $("#mod-sendbatch");
        $(function(){
            /*select2wan('chnged-grp', SITE_BASEPATH+"/util/getpossiblegrps");*/
            $MOD_SENDBATCH.on('click', '#btn-savebatch-send', function(e){
                e.preventDefault();
                
                alert('Sample');
            });
//            console.log($FRM_SENDBATCH);
            
//            alert('sample');
            
        });
    </script>
     
     <script>
        /* custom script for the */
        /* script to get the possible change of batch which include the batch-number who dont have a visa transaction on it. */
        var SITE_BASEPATH = location.protocol+"//"+location.hostname+"/vua";
        var sampleBatchNo = 'batch-1';
        var apiUtil = SITE_BASEPATH+"/util/getpossiblegrps/"+sampleBatchNo;
        var getPossibleGroups = function(){
            $.getJSON(apiUtil, function(res){
//                $('#chnged-grp').sele use the select2 plugins instead of these
            });
        }
        
        getPossibleGroups();
    </script>

</body>

</html>
