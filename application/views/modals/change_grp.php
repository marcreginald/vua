<!-- MODAL FOR CHANGING THE GROUP -->
<div class="modal fade" id="mod-changegrp">
    
    <div class="modal-dialog" style="margin-left: 32%;"> <!--style="margin-left: 15%;"-->
            <div class="modal-content" style="width: 454px;"> <!--style="width:1050px;"-->

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;">  <span class="fa fa-files-o fa-md" style="font-size:18px;"></span> &nbsp; Please Confirm (請確認)</h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                   <div class="row">
                       <blockquote class="m-b-5">
                        <!-- <p> Kindly select yout the batch number <b>below</b> </p> -->
                        <p> Are you sure you want to re-group the selected transactions to</p>
                        <!--<p> (您確定要將所選交易重新分組到嗎？) </p>-->
                        </blockquote>
                   </div>
                   
                   <div class="row">
                       <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <small style="font-size: 12px;"> Please  select new batch number: </small>
                            <!--<small style="font-size: 12px;"> (請選擇新的批號:)</small>-->
                            <select name="chnged_grp" id="chnged-grp" class="form-control input-sm">
                                <!-- ajax_content -->
                            </select>
                       </div>
                   </div>
                   
                </div>
                
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   
                   <div class="row">
                        <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2">
                           <button class="btn btn-sm btn-block btn-success" btn="btn-genrequest" id="btn-regroup" data-regrptype=""> YES (是)</button>
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
<!-- ./modal-fade -->
