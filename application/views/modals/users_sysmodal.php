<!-- system modal for adding user -->
<div class="modal fade" id="mod-systemuser-add"> <!-- style="margin-left: 22%;" -->
    <div class="modal-dialog">
            <div class="modal-content" style="width:715px; margin-left: -10%;">

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;" id="header-mod-client-edit">  <span class="fa fa-user fa-sm" style="font-size:18px;"></span> &nbsp; New User (新用戶)</h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                   <form id="frm-newuser" novalidate> 
                       
                        <div class="row">
                            
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> First Name (名字)<span class="text-danger" title="Field required">*</span> </label>
                                    <input type="text" class="form-control" name="user_fname" id="user-fname" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> Last Name (姓)<span class="text-danger" title="Field re quired">*</span> </label>
                                    <input type="text" class="form-control" name="user_lname" id="user-lname" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> Email Address (電子郵件地址)<span class="text-danger" title="Field required">*</span> </label>
                                    <input type="email" class="form-control" name="user_email" id="user-email" required>
                                </div>
                            </div>
                            
                        </div> <!--fname, lname, email-->
                        
                        <div class="row m-t-10">
                           
                           <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> Branch (科)</label>
                                    <select name="user_branch" id="user-branch" class="form-control">
                                        <option value="binondo">Binondo</option>
                                        <option value="china">China</option>
                                    </select>
                                </div>
                           </div>
                           
                           <div class="col-sm-4">
                               <div class="form-group-sm">
                                    <label> Access Level (訪問權限)</label>
                                    <select name="user_type" id="user-type" class="form-control">
                                        <option value="admin">Admin (管理員)</option>
                                        <option value="agent">Agent (代理人)</option>
                                        <option value="manager">Manager (經理)</option>
                                    </select>
                                </div>
                           </div>
                           <div class="col-sm-4">
                               <div class="form-group-sm">
                                    <label> Temporary Password (臨時密碼)<span class="text-danger" title="Field required">*</span> </label>
                                    <input type="password" class="form-control" name="user_pass" id="user-pass" required>
                                </div>
                           </div>
                           <!-- <input type="password" value="<?= 'uni'.date('Y') ?>" name="user_pass"> -->
                        </div> <!-- branch, access-level-->
                        
                    </form>
                    
                </div>
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   
                   <div class="row">
                       <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-block btn-primary col-md-3" id="btn-saveuser"> SAVE </button>
                       </div>
                   </div>
                </div>
            </div>
            <!-- ./modal-content -->
    </div>
    <!-- ./modal-dialog -->
</div>
<!-- ./modal-fade -->






<!-- edit system user -->
<div class="modal fade" id="mod-systemuser-edit"> <!-- style="margin-left: 22%;" -->
    <div class="modal-dialog">
            <div class="modal-content" style="width:715px; margin-left: -10%;">

                <div class="modal-header" style="background-color: #da5037; height: 42px;">
                    <button type="button btn-lg" class="close chk" data-dismiss="modal" aria-hidden="true" style="color: #FFF; margin-bottom:10px; ">×</button>
                    <h4 class="modal-title" style="color: #F4FBFB; position: absolute; top: 10px;" id="header-mod-client-edit">  <span class="fa fa-user fa-sm" style="font-size:18px;"></span> &nbsp; Edit User (編輯用戶)</h4>
                </div>
                <!-- ./modal-header -->

                <div class="modal-body">
                   
                   <form id="frm-edituser" novalidate> 
                       
                        <div class="row">
                            <input type="hidden" name="user_id" id="user-id-edit">
                            
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> First Name (名字)<span class="text-danger" title="Field required">*</span> </label>
                                    <input type="text" class="form-control" name="user_fname" id="user-fname-edit">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> Last Name (姓)<span class="text-danger" title="Field required">*</span> </label>
                                    <input type="text" class="form-control" name="user_lname" id="user-lname-edit">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> Email Address (電子郵件地址)<span class="text-danger" title="Field required">*</span> </label>
                                    <input type="text" class="form-control" name="user_email" id="user-email-edit">
                                </div>
                            </div>
                            
                        </div> <!--fname, lname, email-->
                        
                        <div class="row m-t-10">
                           
                           <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> Branch (科)</label>
                                    <select name="user_branch" id="user-branch-edit" class="form-control">
                                        <option value="binondo">Binondo</option>
                                        <option value="china">China</option>
                                    </select>
                                </div>
                           </div>
                           
                           <div class="col-sm-4">
                               <div class="form-group-sm">
                                    <label> Access Level (訪問權限)</label>
                                    <select name="user_type" id="user-type-edit" class="form-control">
                                        <option value="admin">Admin (管理員)</option>
                                        <option value="agent">Agent (代理人)</option>
                                        <option value="manager">Manager (經理)</option>
                                    </select>
                                </div>
                           </div>
                           
                           <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label> User Status </label>
                                    <select name="user_status" id="user-status-edit" class="form-control">
                                        <option value="active">Active (活性)</option>
                                        <option value="inactive">Inactive (待用)</option>
                                    </select>
                                </div>
                           </div>
                           
                           
                        </div> <!-- branch, access-level, user_status -->
                        
                    </form>
                    
                </div>
                <!-- ./modal-body -->
                
                <div class="modal-footer">
                   
                   <div class="row">
                       <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-block btn-primary col-md-3" id="btn-edituser"> UPDATE (更新)</button>
                       </div>
                   </div>
                </div>
            </div>
            <!-- ./modal-content -->
    </div>
    <!-- ./modal-dialog -->
</div>
<!-- ./modal-fade -->


<!--
    NEWLY ACQUIRED TECHNIQUE SUGOE
    PHP+Almighty Javascript
    4:30 PM 3/7/2018
-->