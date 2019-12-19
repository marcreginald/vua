// SITE_BASEPATH
var $FRM_LOGIN = $('#frm-login').parsley();
var $BTN_LOGIN = $('#btn-login');


var submitForm = function(){
    
    let data = $('#frm-login').serializeArray();
    
    $.post(SITE_BASEPATH+'/vua/login/validate', $.param(data), function(res){
        if(res.status){
           location.href="dashboard";
        }else{
            $BTN_LOGIN.attr('disabled', false).text('Sign in to your account');
            showGritter('Error!', 'Invalid Username or Password.', 'error');
            $FRM_LOGIN.reset();
        }
    });
    
}

$(function(){
    
    /* BUTTON TRIGGERED */
    $BTN_LOGIN.on('click', function(e){
        e.preventDefault();
        $FRM_LOGIN.validate();
        if($FRM_LOGIN.isValid()){
             $BTN_LOGIN.attr('disabled', true).text('Signing in...');
             submitForm();
        }
        
    });
    
    /* ON TYPE KEYBOARD */
    /*$('#user-email, #user-pass').on('keydown', function(e){
        
        if(e.which == 13){
            $FRM_LOGIN.validate();
            if($FRM_LOGIN.isValid()){
                 submitForm();
            }
        }
        
    });*/
    
    /* idont want trust baby */
    $('#user-email, #user-pass').click(function(e){
        
        if(e.which === 13){
           $FRM_LOGIN.validate();
            if($FRM_LOGIN.isValid()){
                 submitForm();
            }
        }
        
    });
    
});