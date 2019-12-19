var $BTN_SEARCHAPPROVE = $("#btn-searchapprove-rql"); // button
var $IN_FROM           = $("#approve-from"); // from
var $IN_TO             = $("#approve-to"); // to
var $TBOD_APPPROVED    = $("#rql-logs");


// apiPrint
var apiPrintRequestLetter = SITE_BASEPATH+"/vua/composerequestletter/print/";

/* getting the list */
var getApproveVisa = function(){
    
    $TBOD_APPPROVED.empty();
    let url = SITE_BASEPATH+"/vua/approved/getapprovedtbl/"+$IN_FROM.val()+"/"+$IN_TO.val();
    
    $.get(url, function(res){
        $TBOD_APPPROVED.append(res);
    });
}

$(function(){
    
    datetimepicker('approve-from');
    datetimepicker('approve-to');
    
    getApproveVisa(); // initial load
    
    /* btn search handler */
    $BTN_SEARCHAPPROVE.on('click', function(){
        getApproveVisa();
    });
    
    /* printing */
    $TBOD_APPPROVED.on('click', '#btn-printdraft-rql', function(e){
        e.preventDefault();
        
        let crntrqlId = $(this).data('crntrql');
        let printUrl = apiPrintRequestLetter+crntrqlId;        window.open(printUrl,"windowid","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
    });

    $TBOD_APPPROVED.on('click', '.lk-edit', function(){
        
        let crntRqlId = $(this).data('crntrqlid');
        location.href=SITE_BASEPATH+"/vua/visaview/index/"+crntRqlId;   
    });
    
});