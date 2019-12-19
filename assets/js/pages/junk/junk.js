var $BTN_DISCARDJNK = $("#btn-discardjunk"); // BTN_DISCARD
var $CHK_ALL        = $("#chk-all"); // TBOD ALL
var $TBOD_JUNK      = $("#tbod-junk"); // TBODY JUNK


var discardJunk = function(ajax, data){
    
    let pUrl  = SITE_BASEPATH+"/vua/junk/"+ajax;
    let pData = {};
    pData.method = ajax;
    pData.selectedjunk = data;
    
    $.post(pUrl, $.param(pData), function(res){
       if(res.status){
          showGritter('Success!', 'Successfully deleted');
           setTimeout(function(){
               location.reload(true);
           }, 1000);
       }else{
           $BTN_DISCARDJNK.attr('disabled', true);
           showGritter('Error!', 'Unable to delete transaction', 'error');
       } 
    });
}

$(function(){
    
    /* loading the datatable */
    datatable('data-table', SITE_BASEPATH+"/vua/junk/dtjunk");

    $BTN_DISCARDJNK.on('click', function(e){
        e.preventDefault();
        /* getAllSelectedTrans */
        $BTN_DISCARDJNK.attr('disabled', true);
        
        let crntSelected = getAllSelectedTrans();
        if($CHK_ALL.is(':checked')){
//            
            if($TBOD_JUNK.find('td.dataTables_empty').length === 1){
               showGritter('Error!', 'Empty Junk table', 'error');
                $BTN_DISCARDJNK.attr('disabled', false);
            }else{
                discardJunk('discardalljunk');
            }
            
        }else{
            
            if(crntSelected.length === 0){
               showGritter('Error!', 'Kindly check atleast one.', 'error');                
               $BTN_DISCARDJNK.attr('disabled', false);
            }else{
                discardJunk('discardselected', crntSelected);
            }
        }
    });
    
    $CHK_ALL.on('change', function(e){
        e.preventDefault();
        
        if($(this).is(':checked')){
          $TBOD_JUNK.find('input[type=checkbox]').prop('checked', true).attr('disabled', true);
            // 
        }else{
          $TBOD_JUNK.find('input[type=checkbox]').prop('checked', false).attr('disabled', false);
        }
    });
    
});