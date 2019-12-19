var $TBOD_AGENTSENT      = $("#sent-translist"); //tbody
var $MOD_PREVIEW         = $("#mod-batchtranslist");
var $TBOD_BATCHTRANSLIST = $("#batch-translist"); // tbody_transacview

/* getting the batch transsaction list (in a modal)*/
var getBatchTransac = function(batchNum){
    
    $.getJSON(SITE_BASEPATH+"/vua/sent/agentbatchtransac/"+batchNum, function(res){
        
        let formattedDate = toVuaJSDate(res.arrival_date);
        
        // console.log(res);
        // change the modal information and the batch Number
        $("#batch-num").text(batchNum.toUpperCase()); // batchnumber header
        $("#v-traveltype").text(res.travel_type);
        $("#v-fovnum").text(res.fov);
        $("#v-arrivaldate").text(formattedDate);
        $("#v-via").text(res.via);
        $("#v-poe").text(res.poe);
        $("#v-dsent").text(res.date_sent);
        
        let arrival = res.arrival_date;
        let fov     = res.fov;
        
        
         // empty its child node of tbody
        $TBOD_BATCHTRANSLIST.empty();
        $.each(res.visainfo, function(i, v){
            var fullName = v.va_fname+" "+v.va_lname;
            var Rows = `
            <tr>
                <td>`+(i+1)+`</td>
                <td>`+v.trans_no.toUpperCase()+`</td>
                <td>`+fullName+`</td>
                <td>`+v.va_gender+`</td>
                <td>`+toVuaJSDate(v.va_dob)+`</td>
                <td>`+v.va_passportnum+`</td>
                <td>`+v.trans_status.toLowerCase()+`</td>
            </tr>
        
`;
            /*
            <td>`+arrival+`</td>
                <td>`+fov+`</td>
            */
            
            $TBOD_BATCHTRANSLIST.append(Rows);
        });
        //showing the modal
        $MOD_PREVIEW.modal({backdrop:"static",keyboard:"false"});

    });
}

$(function(){
    
    let crntBatchId; // storing each batch number in downloading the e-ticket 
    
    /* datatable */
    datatable('data-table', SITE_BASEPATH+"/vua/sent/usersentlist", false, 'ftrp'); 
    
    /* previewing the batch transaction inside in the batch */
    $TBOD_AGENTSENT.on('click', '#agent-previewbatch', function(e){
        e.preventDefault();
        crntBatchId = $(this).data('batchid');
        getBatchTransac(crntBatchId);
    });

    /* downloading the eticket */
    $('#btn-geteticket').on('click', function(e){
        e.preventDefault(); 
        window.open(SITE_BASEPATH+"/vua/batchrecords/downeticket/"+crntBatchId, '_blank');
    });
    
});