var $TBOD_USERS   = $("#user-systems"); // tbody

var $FRM_EDITUSER = $("#frm-edituser").parsley();

var $MOD_EDITUSER = $("#mod-systemuser-edit");

/* showing the user information*/
var showUserinfo = function(userId){
    
    $.getJSON(SITE_BASEPATH+"/vua/users/getuserinfo/"+userId, function(data){
        $('#user-fname-edit').val(data.user_fname);
        $('#user-lname-edit').val(data.user_lname);
        $('#user-email-edit').val(data.user_email);
        $('#user-branch-edit').val(data.user_branch);
        $('#user-type-edit').val(data.user_type);
        $('#user-status-edit').val(data.user_status);
        $('#user-id-edit').val(data.user_id);

        $MOD_EDITUSER.modal({ backdrop:"static", keyboard:"false" });
    });
}

/* THE ACTUAL UPDATE */
var updateUserInfo = function(){
    let data = $("#frm-edituser").serializeArray();

    $.post(SITE_BASEPATH+"/vua/users/updateuserinfo", $.param(data), function(res){
        if(res.status){
           showGritter('Success!', 'User been updated');
            setTimeout(function(){
                location.reload(true);
            }, 1000);
        }else{
            showGritter('Error!', 'Unable to update users', 'error');   
        }
    });
};

$(function(){
   
    /* showing the modal with the user-information */
    $TBOD_USERS.on('click', '#edit-user', function(e){
        e.preventDefault();
        
        let currentUser = $(this).data('userid');
        
        showUserinfo(currentUser); 
    });
    
    
    /* saving the updated user information */
    $MOD_EDITUSER.on('click', '#btn-edituser', function(e){
        e.preventDefault();
        
        $(this).attr('disabled', true);
        /*$FRM_EDITUSER.validate();
        
        if($FRM_EDITUSER.isValid()){
           alert('Form is now valid ready to update');
        }*/
        updateUserInfo();
    });
    
});