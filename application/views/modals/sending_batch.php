<!-- MODAL FOR SENDING BATCH VISA TRANSACTION  -->
<div class="modal fade" id="mod-sendbatch">
    <div class="modal-dialog" style="margin-left: 22%;">
            <div class="modal-content" style="width:800px;">

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;" id="header-mod-client-edit">  <span class="fa fa-group fa-sm" style="font-size:18px;"></span> &nbsp; Send Transactions by Batch (按批發送交易)</h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                    <!-- <form id="frm-sendbatch" novalidate> -->
                    <?= form_open_multipart('', array('id' => 'frm-sendbatch', 'novalidate' => true)); ?>
                     <div class="row">
                        <div class="col-md-2">
                            <div class="form-group-sm" style="white-space:nowrap;">
                                <label> Travel Type (旅行類型)</label>
                                <select name="travel_type" id="travel-type" class="form-control input-sm">
                                    <option value="airplane">Airplane (飛機)</option>
                                    <option value="cruise">  Cruise (巡航)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group-sm" style="margin-left: 8px;">
                                <label> Arrival Date (到達日期)</label>
                                <input type="text" class="form-control" placeholder="mm-dd-yyyy" name="arrival" id="arrival" value="<?= date('m-d-Y'); ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group-sm">
                                <label> Via (通過)<small>(Airline/Port) (航空公司/港口)</small> <span class="text-danger" title="Field required">*</span> </label>
                                <input type="text" class="form-control input-sm field-text" name="via" id="via" required>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group-sm">
                                <label> Flight/Cruise (飛行/ 巡航)<span class="text-danger" title="Field required">*</span> </label>
                                <input type="text" class="form-control input-sm field-passnum" name="flight_or_voyagenum" id="f-v-num" required>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row m-t-20">
                        <div class="col-md-5"> <!--9-->
                            <div class="form-group-sm">
                                <label> Port of Entry (進口港)<span class="text-danger" title="Field required">*</span> </label>
                                <input type="text" class="form-control input-sm field-text" name="port_of_entry" id="port-ofe" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-sm">
                                <label> E-Ticket (電子機票)<span class="text-danger" title="Field required">*</span> </label>
                                <input type="file" name="attached_eticket[]" id="e-ticket" accept=".doc, .docx, .pdf" multiple required>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="row m-t-20">
                        
                    </div>-->
                   <!-- </form>-->
                   <?= form_close(); ?>
                    
                    <div class="row m-t-15">
                        <h3> List of Applicants (申請人名單)</h3>
                        <div class="col-md-12 table-responsive" style="overflow: auto; height:250px;">
                            <table class="table table-bordered">
                                <thead class="white">
                                    <tr>
                                        <th style="width:2%;">#. (數)</th>
                                        <th style="width:40%;">Name (全名)</th>
                                        <th style="width:3%;">Gender (性別)</th>
                                        <th style="width:20%;">Date of Birth (出生日期)</th>
                                        <th style="width:30%;">Passport Number (護照號)</th>
                                        <th style="width:5%;">Action (行動)</th>
                                    </tr> 
                                </thead>
                                
                                <tbody id="batch-applicant">
                                    <!--ajax-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   
                   <div class="row">
                       <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-block btn-primary col-md-3" id="btn-savebatch-send"> Send (發送)</button>     
                       </div>
                   </div>
                </div>
            </div>
            <!-- ./modal-content -->
    </div>
    <!-- ./modal-dialog -->
</div>
<!-- ./modal-fade -->