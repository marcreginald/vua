<!-- SINGLE MODAL INTERACTION USER MODAL (Verification modal) -->
<div class="modal fade" id="mod-edittransac"> <!--  -->
    
    <div class="modal-dialog"> <!--style="margin-left: 15%;"-->
            <div class="modal-content"> <!--style="width:1050px;"-->

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;" id="header-mod-client-edit">  <span class="fa fa-warning fa-md" style="font-size:18px;"></span> &nbsp; Please Confirm (請確認)</h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                   <div class="row">
                       <blockquote class="m-b-20 ">
                          <p> Are you sure to <strong> UPDATE </strong> <u style="text-transform:uppercase;"> <?= (isset($transac_dat->trans_no) ? $transac_dat->trans_no : 'trans-0'); ?></u> ?</p>

                            <!-- <small>Once verified, transaction cannot be updated!</small> -->
                        </blockquote>
                   </div>
                   
                </div>
                
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   <div class="row">
                        <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
                           <button class="btn btn-sm btn-block btn-success" id="edit-transac"> YES (是)</button>
                           <!--  data-crnttransnum="<?= $transac_dat->trans_no; ?>" -->
                        </div>
                        
                        <div class="col-sm-4 col-md-4">
                            <button class="btn btn-sm btn-block btn-danger" data-dismiss="modal"> NO (沒有)</button>
                        </div>
                   </div>
                </div>
            </div>
            <!-- ./modal-content -->
    </div>
    
</div>
<!-- ./modal-fade