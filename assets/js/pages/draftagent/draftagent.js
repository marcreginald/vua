/* cached DOMList Element*/
var $DRAFTED_LIST = $("#agentdrafted-list");
var $CHK_ALL      = $("#chk-all");
var $BTN_DISCARD  = $("#btn-discard");

// is ALL agent transaction FlAG (look at the plugins)

var $MOD_DISCARD  = $("#mod-confirmation");

/* viewinf the agent drafted transactions */
$(function(){
    
    datatable('data-table', SITE_BASEPATH+"/vua/draftagent/dtagentdrafted");
    
    /* clicking of the */
    $DRAFTED_LIST.on('click', '#transcol', function(e){
        e.preventDefault();
        let crntTransNum = $(this).data('transnum');
        // alert(crntTransNum);
        // window.open(SITE_BASEPATH+"/transacview/index/"+crntTransNum, '');
        location.href="transacview/index/"+crntTransNum;
    });
    
    /* selecting and deselecting some */
    $CHK_ALL.on('change', function(e){
        e.preventDefault();
        if($(this).is(':checked')){
            $DRAFTED_LIST.find('input[type="checkbox"]').prop('checked', true).attr('disabled', true);
        }else{
            $DRAFTED_LIST.find('input[type="checkbox"]').prop('checked', false).attr('disabled', false);
        }
    });
    
    /* showing ultimate confirmation modal */
    $BTN_DISCARD.on('click', function(e){
        e.preventDefault();
        
        let ishasChecked = $('#data-table').find('input[type="checkbox"]:checked').length;
        $('#big-noti').text('Are you sure you want to discard selected draft/s?');
        $('#small-noti').text('Note: Discareded draft can no longer be retrieved!');
        
        if($('#chk-all').is(':checked')){
            // checking if althought it is all check the tbody
            if($('#agentdrafted-list > tr > td.dataTables_empty').length > 0){
               showGritter('Error!', 'Empty transaction list!', 'error');
            }else{
                $MOD_DISCARD.modal({ backdrop:"static", keyboard:"false" });                
            }
            
        }else if(ishasChecked != 0){
            $MOD_DISCARD.modal({ backdrop:"static", keyboard:"false" });
            
        }else{
            showGritter('Error!', 'Please check atleast one transaction!', 'error');
        }
    });
    
    /* cofirming the discarding of the transaction */
    $MOD_DISCARD.on('click', '#yes-confirm', function(e){
        e.preventDefault();
        
        let discardDat = {};
        var selected = getAllSelectedTrans();
        discardDat.selected = selected;
        discardDat.status   = 'deleted';
        
        $.post(SITE_BASEPATH+"/vua/draftagent/discardtrans", $.param(discardDat), function(res){
            if(res.status){
                showGritter('Success!', 'Transaction been discarded');
                setTimeout(function(){
                    location.reload(true);
                },1000);
            }else{
                showGritter('Error!', 'Please check at least one transaction', 'error');
            }
        });
        
    });
    
});