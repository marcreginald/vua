/* CACHED DOM ELEMENT */
var $BTN_SAVEDRAFT = $("#draft-reql"); // save draft
var $BTN_PRNTREQL  = $("#btn-generatepdf"); // generate pdf
var $SLC2_BOI_TO   = $("#to-commissioner"); // to
var $COMPOSE_DATE  = $("#compose-date"); // date
var $ASSIGNATORY   = $("#assignatory");
var $ARRIVAL       = $("#compose-arrivaldate"); //arrival

// TBODY_LIST APPLICANTS
var $TBOD_APPLICANTS = $("#tbod-listapplicant");

/* API LIST */
var apiPrintRequestLetter = SITE_BASEPATH+"/vua/composerequestletter/print/";

/* getting the To-Commissioner select2 */
select2wan("to-commissioner", SITE_BASEPATH+"/vua/util/getcommisionerlist");

/* getting the Assignatory select2 */
select2wan("assignatory", SITE_BASEPATH+"/vua/util/getassignatorylist");

/* compose date */
datetimepicker("compose-date");

/* getting the current batch_id in pop */
var getBatchId = function(){
    var pathArray = location.pathname.split('/');
    return pathArray.pop();
}

/* function getting the tables */
var getListApplicants = function(){
    
    $TBOD_APPLICANTS.empty();
    let crntBatchId = getBatchId();
    $.get(SITE_BASEPATH+"/vua/util/getbatchapplicationlist/"+crntBatchId, function(rows){
        $TBOD_APPLICANTS.append(rows);
    });
    
}

$(function(){
    
    /* get of all list Applicants */
    getListApplicants();
    

    /*$BTN_PRNTREQL.on('click', function(e){
        e.preventDefault();
        
        let crntBatchId = getBatchId();
        let commisioner = encodeURI($("#select2-to-commissioner-container").text());
        let composeDate = $("#compose-date").val();
        
        // console.log(crntBatchId+":"+commisioner+":"+composeDate);
        // $to, $date, $bathNum
        let printUrl = apiPrintRequestLetter+commisioner+"/"+composeDate+"/"+crntBatchId;
        window.open(printUrl, "windowid", "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
    });*/
    
})
