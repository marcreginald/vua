var $TBOD_BATCHREC       = $("#mgr-batchlist"); // tbody
var $MOD_PREVIEW         = $("#mod-batchtranslist"); // bacth_mod preview
var $TBOD_BATCHTRANSLIST = $("#batch-translist");
var $BTN_ETICKETDOWNLOAD = $("#btn-geteticket") 

// eticket_pic

/* getting the batch transsaction list (in a modal)*/
var getBatchTransac = function(batchNum){
    
    $.getJSON(SITE_BASEPATH+"/vua/batchrecords/getbatchtransac/"+batchNum, function(res){

        // change the modal information and the batch Number
        $("#batch-num").text(batchNum.toUpperCase()); // batchnumber header
        $("#v-traveltype").text(res[0].travel_type);
        $("#v-fovnum").text(res[0].fov);
        $("#v-arrivaldate").text(res[0].arrival);
        $("#v-via").text(res[0].via);
        $("#v-poe").text(res[0].poe);
        $("#v-dsent").text(res[0].date_sent);
        $BTN_ETICKETDOWNLOAD.data('batchnum', batchNum);
        
         // empty its child node of tbody
        $TBOD_BATCHTRANSLIST.empty();
        $.each(res, function(i, v){
            var fullName = v.fname+ " &nbsp; " +v.lname;
            var Rows = `
                <tr>
                    <td>`+(i+1)+`</td>
                    <td>`+v.trans_no.toUpperCase()+`</td>
                    <td>`+fullName+`</td>
                    <td>`+v.gender+`</td>
                    <td>`+v.dob+`</td>
                    <td>`+v.passportnum+`</td>
                    <td>`+v.trans_stat.toLowerCase()+`</td>
                </tr>
            `;
            $TBOD_BATCHTRANSLIST.append(Rows);
            /*
                <td>`+v.arrival+`</td>
                <td>`+v.fov+`</td> 
                8:28 AM 2/27/2018
            */
        });
        //showing the modal
        $MOD_PREVIEW.modal({backdrop:"static",keyboard:"false"});

    });
}

$(function(){
    
    /* load the datatable */
    datatable('data-table', SITE_BASEPATH+"/vua/batchrecords/dtbatchrecords", false, 'lftrip', '10,20,50,100');
    
    /* compose letter */
    $TBOD_BATCHREC.on('click', '#mgr-composeltter', function(e){
        e.preventDefault();
        let crntBatchId = $(this).data('batchid');
        window.open(SITE_BASEPATH+'/vua/compose/index/'+crntBatchId, '_self');
    });
    
    /* previewing the batched transaction */
    $TBOD_BATCHREC.on('click', '#mgr-previewbatch', function(e){
        e.preventDefault();
        let crntBatchId = $(this).data('batchid');
        getBatchTransac(crntBatchId);
    });
    
    /* i finally get it */
    $MOD_PREVIEW.on('click', '#btn-geteticket', function(e){
        e.preventDefault();
        let crntEticket = $(this).data('batchnum');
        // alert(crntEticket);
        window.open(SITE_BASEPATH+"/vua/batchrecords/downeticket/"+crntEticket, '_blank');
        
        
    });

});