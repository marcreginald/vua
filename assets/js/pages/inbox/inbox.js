var $TBOD_INBOX_PD   = $("#agent-sentlist-pending"); // tbody-pending
var $TBOD_INBOX_VERI = $("#agent-sentlist-verified"); // tbody-verified

var $CHK_ALL_PD      = $("#check-all-pending"); // chk all
var $CHK_ALL_VERI    = $("#check-all-verified"); // chk all
var $BTN_JUNK        = $("#btn-tojunk");
var $BTN_REGROUP     = $("#btn-regroup"); // showing the modal to select desire batch_no

/* getting all the selected transaction in the inbox (look at the plugins.js)*/
var $MOD_GRPCHNG = $("#mod-changegrp");
var $BTN_REGRP   = $("#btn-regroup");
var $CHANGE_GRP  = $("#chnged-grp");
var $OLD_BATCH   = $("#old-batch");


$(function(){
    
    $BTN_REGROUP.hide(); // hidding the button regroup
    
    $('#pending, #pendingtab').addClass('active');
    /* loading the datatable feed */
    datatable('data-table-pending', SITE_BASEPATH+"/vua/inbox/dtinbox/pending", false, 'lftrip');
    datatable('data-table-verified', SITE_BASEPATH+"/vua/inbox/dtinbox/verified", false, 'lftrip');

    /* unable to view the transaction view */
    $('#agent-sentlist-pending, #agent-sentlist-verified').on('click', '#transcol', function(e){
        e.preventDefault();
        var crntTransNo = $(this).data('transnum');
        // location.href="mgrtransacview/index/"+crntTransNo;
        /* change these allow the viewing in the new tab but but but make sure to remove the sidebar the header with no username profile on it K*/
        window.open(SITE_BASEPATH+"/vua/mgrtransacview/index/"+crntTransNo, '_blank');
    });
    
    /* checking and unchecking all the selected transactions (verified)*/
    $CHK_ALL_VERI.on('change', function(e){
        e.preventDefault();
        if($(this).is(':checked')){
            $TBOD_INBOX_VERI.find('input[type="checkbox"]').prop('checked', true).attr('disabled', true);
        }else{
            $TBOD_INBOX_VERI.find('input[type="checkbox"]').prop('checked', false).attr('disabled', false);
        }
    });
    
    /* regrouping a certain visa transaction or all of the pending visa transaction */
    $BTN_REGROUP.on('click', function(e){
        e.preventDefault();
                
        let isAll = $CHK_ALL_VERI.is(':checked');
        if(isAll){
            
            /* checking if the tbody dont have a children that been checked with. */
            if($('#agent-sentlist> tr > td.dataTables_empty').length > 0){
               showGritter('Error!', 'Empty transaction list!', 'error');
            }else{
                $BTN_REGRP.data('regrptype', 'regroupall'); // setting the controller api to send with
                select2wan('chnged-grp', SITE_BASEPATH+"/vua/util/getpossiblegrps");
                $MOD_GRPCHNG.modal({ backdrop:"static", keyboard:"false" });              
            }
            
        }else{
            
            // all na muna
            let trChecked = getAllSelectedTrans();
            
            if(trChecked.length === 0){
               showGritter('Error!', 'Please check at least one transaction!', 'error');
            }else{
                $BTN_REGRP.data('regrptype', 'selectedregroup');
                select2wan('chnged-grp', SITE_BASEPATH+"/vua/util/getpossiblegrps");
                /*$('span.selection > span').append($('<span class="select2-selection__rendered" id="select2-chnged-grp-container"><span class="select2-selection__placeholder">Please Select</span></span>'));*/
                
                $MOD_GRPCHNG.modal({ backdrop:"static", keyboard:"false" });
            }
        }
        
    });
    
    /* saving the regrouping of the transaction */
    $MOD_GRPCHNG.on('click', '#btn-regroup', function(e){
        e.preventDefault();
        
        let self = this;
        $(self).attr('disabled', true);
        let url           = $BTN_REGRP.data('regrptype');
        let selectedGrp   = $CHANGE_GRP.val();
        let transArr      = getAllSelectedTrans();
        let data          = {};
        data.selected_grp = selectedGrp;
        data.trans_arr    = transArr;
        
        $.post(SITE_BASEPATH+"/vua/inbox/"+url, $.param(data), function(res){
            if(res.status){
               showGritter('Success!', 'Transaction successfully regrouped');
               setTimeout(function(){
                   location.reload(true);
               },1000);
            }else{
                $(self).attr('disabled', false);
                showGritter('Error', 'Unable to regrouped transaction', 'error');
            }
        });
        
    });
    
    /* triggering some event during the tab-pane been changed or whatever */
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        // console.log(e);
        let crntTab = $(e.target).attr('href');
        
        if(crntTab == '#verified'){
           $BTN_REGROUP.show('normal');
            $('input:checkbox').removeAttr('checked');
        }else{
           $BTN_REGROUP.hide('normal');
           $('input:checkbox').removeAttr('checked');
        }
    });
});

/*
    8:49 AM 3/14/2018
     => ( e.target properties ) 
         => return the current nodeList that been selected =
         => the node must have a id or href attribute before using these.
*/