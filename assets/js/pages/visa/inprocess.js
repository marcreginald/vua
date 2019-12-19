var $TBOD_INPROCESS = $("#inprocess-list");

// apiPrint
var apiPrintRequestLetter = SITE_BASEPATH+"/vua/composerequestletter/print/";

$(function(){

    datatable('data-table', SITE_BASEPATH+"/vua/inprocess/getinprocess", false, 'lftrip', '10,20,50,100');

    /* printing the inprocess visa transaction (the printing  now be moved in the edit in the visa view controller)
        date_edited => 10:50 PM 2/25/2018
    */
    $TBOD_INPROCESS.on('click', '#btn-printdraft-rql', function(e){
        e.preventDefault();
        let crntRqlId = $(this).data('crntrql');
        let printUrl = apiPrintRequestLetter+crntRqlId;
        window.open(printUrl,"windowid","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
    });
    
    /* editing the inprocess visa transactions */
    /*$TBOD_INPROCESS.on('click', '#btn-editdraft-rql', function(e){
        e.preventDefault();
        alert('sample');
        let crntRql = $(this).data('crntrql');
        location.href=SITE_BASEPATH+'/visaview/index/'+crntRql;
    });
    */
    
    $TBOD_INPROCESS.on('click', '#editdraft-rql', function(e){
        e.preventDefault();
        let crntRql = $(this).data('crntrql');
        location.href=SITE_BASEPATH+'/visaview/index/'+crntRql;
    });
    
});