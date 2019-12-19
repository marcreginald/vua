var $IN_FROM     = $("#rql-from"); //from
var $IN_TO       = $("#rql-to");   // to
var $BTN_SEARCH  = $("#btn-searchrql"); //btn search

var $TBOD_RQLLOGS = $("#rql-logs"); // TBODY

// apiPrint
var apiPrintRequestLetter = SITE_BASEPATH+"/vua/composerequestletter/print/";

var loadRequestLetterLogs = function(){
    
    let formatedFrom = $IN_FROM.val().trim();
    let formatedTo   = $IN_TO.val().trim();
    
    $TBOD_RQLLOGS.empty();
    $.get(SITE_BASEPATH+"/vua/requestletter/getrqllogs/"+formatedFrom+"/"+formatedTo, function(tr){
       $TBOD_RQLLOGS.append(tr);
    });
} 

$(function(){
    
    datetimepicker('rql-from');
    datetimepicker('rql-to');
    
    loadRequestLetterLogs();
    
    /* searching button*/
    $BTN_SEARCH.on('click', function(e){
        e.preventDefault();
        loadRequestLetterLogs();
    });
    
    /* printing the old request letter */
    $TBOD_RQLLOGS.on('click', '#btn-printdraft-rql', function(e){
        e.preventDefault();
        let rqlId = $(this).data('crntrql');
        let printUrl = apiPrintRequestLetter+rqlId;
        window.open(printUrl,"windowid","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
    });

});