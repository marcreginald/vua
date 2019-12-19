/* these methodology affect the performance in firefox*/
$(function(){
    
    /* USER EMAIL FRONT END  VALIDATOR */
    $('#user-email').bind('keypress', function(e){
        
        var regex = new RegExp("^[a-z0-9@._-]+$");
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (!regex.test(key)) {
           e.preventDefault();
           return false;
        }
        
    });
    
    
    /* PASSWORD FRONT END VALIDATOR */
    $('#user-pass').bind('keypress', function(e){
        
        var regex = new RegExp("^[a-zA-Z0-9]+$");
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (!regex.test(key)) {
           e.preventDefault();
           return false;
        }
        
    });
    
});