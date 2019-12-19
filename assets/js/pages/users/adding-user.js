var $MOD_ADDUSER = $("#mod-systemuser-add");

var $FMR_ADDUSER = $("#frm-newuser").parsley();

var saveNewUser = function(){
    let data = $("#frm-newuser").serializeArray();
    
    $.post(SITE_BASEPATH+"/vua/users/savenewuser", $.param(data), function(res){
        
        if(res.status){
           showGritter('Success!', 'New user been added');
           setTimeout(function(){
               location.reload(true);
           }, 1000);
        }else{
           showGritter('Error!', 'Unable to add new user', 'error');
        }
    });
}

$(function(){
    
    // datatable plugins
    datatable('data-table', SITE_BASEPATH+"/vua/users/dtusers");
    
    $('#add-user').on('click', function(e){
        e.preventDefault();
        $FMR_ADDUSER.reset();
        $MOD_ADDUSER.modal({ backdrop:"static", keyboard:"false" });
    });
    
    
    $MOD_ADDUSER.on('click', '#btn-saveuser', function(e){
       e.preventDefault();
        $FMR_ADDUSER.validate();
        
        if($FMR_ADDUSER.isValid()){
           saveNewUser();
        }
    });
});