<!-- SHOWING THE BACTH-TRANSACTIONS -->
<div class="modal fade" id="mod-batchtranslist"> <!--  -->
    <div class="modal-dialog" style="margin-left: 15%;">
            <div class="modal-content" style="width:1050px;">

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;" id="header-mod-client-edit">  <span class="fa fa-clipboard fa-sm" style="font-size:18px;"></span> &nbsp; <span id="batch-num"></span> </h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                   
                   <div class="row">
                       <div class="row">
                           
                           <div class="col-md-3 col-sm-offset-1 col-lg-3 col-lg-offset-1">
                                <strong> TRAVEL TYPE (旅行類型)</strong>
                                <p id="v-traveltype" style="text-transform: uppercase;"></p>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> FLIGHT/CRUISE (飛行/巡航)</strong>
                               <p id="v-fovnum" style="text-transform: uppercase;"></p>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> ARRIVAL DATE (到達日期)</strong><br>
                               <span id="v-arrivaldate" style="text-transform: uppercase;"></span>
                           </div>

                       </div> <!--1stRow-->
                       
                       <div class="row">
                           
                           <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1">
                               <strong> VIA (通過)</strong><br>
                               <span id="v-via" style="text-transform: uppercase;"></span>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> PORT OF ENTRY (進口港)</strong><br>
                               <span id="v-poe" style="text-transform: uppercase;"></span>
                           </div>
                           
                           <div class="col-md-4 col-lg-4">
                               <strong> DATE SENT (日期發送)</strong><br>
                               <span id="v-dsent" style="text-transform: uppercase;"></span>
                           </div>

                       </div>
                   </div>
                   
                   
                    <div class="row m-t-20">
                        <div class="col-md-12 table-responsive" style="overflow: auto; height:343px; ">
                            <table class="table table-bordered">
                                <thead class="white">
                                    <tr>
                                        <th style="width:1%; text-transform: uppercase;">#. (數)</th>
                                        <th style="width:15%;text-transform: uppercase;">Trans # (交易號)</th>
                                        <th style="width:20%;text-transform: uppercase;">Full Name (全名)</th>
                                        <th style="width:1%; text-transform: uppercase;" >Gender (性別)</th>
                                        <th style="width:15%; text-transform: uppercase;">Birthday (生日)</th>
                                        <th style="width:10%; text-transform: uppercase;">Passport #. (護照號)</th>
                                        <!--<th style="width:15%;">Arrival</th>
                                        <th style="width:12%;">Flight/Voyage #.</th>-->
                                        <th style="width:1%; text-transform: uppercase;"> Status (狀態)</th>
                                    </tr> 
                                </thead>
                                
                                <tbody id="batch-translist" style="text-transform: capitalize;">
                                    <!--ajax-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   <div class="row">
                       <div class="col-md-4 col-sm-4 col-md-offset-4 col-md-offset-4">
                           <button class="btn btn-info btn-block btn-md" title="Download attached E-Ticket" id="btn-geteticket"> <span class="fa fa-cloud-download fa-lg" style="font-size: 27px;"></span> Download E-Ticket (下載電子票)</button>
                       </div>
                   </div>
                </div>
            </div>
            <!-- ./modal-content -->
    </div>
    <!-- ./modal-dialog -->
</div>
<!-- ./modal-fade -->