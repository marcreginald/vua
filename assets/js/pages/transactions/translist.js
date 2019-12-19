    var $FROM = $("#trans-from");
    var $TO   = $("#trans-to");
    var $STAT = $("#trans-stat");

    var $BTN_SEARCH  = $("#btn-searchtrans");
    var $TBOD_TRANSAC= $("#tbod-transaclist"); 

    /*getting each row of the generated tbale  (only for the admin type user and manager)*/
    var getTransaclist = function()
    {
        $BTN_SEARCH.attr('disabled', true);
        $TBOD_TRANSAC.text('Processing');
        $.get(SITE_BASEPATH+"/vua/transactions/gettransaclist/"+$FROM.val()+"/"+$TO.val()+"/"+$STAT.val(), function(res){
            // console.log(res);
            $TBOD_TRANSAC.empty();
            $TBOD_TRANSAC.append(res);
            $BTN_SEARCH.attr('disabled', false);
        });

    }
        
    /* getting the agent based transactions */
    var getAgentTransa = function(){
        $BTN_SEARCH.attr('disabled', true);
        $TBOD_TRANSAC.text('Processing');
        $.get(SITE_BASEPATH+"/vua/transactions/gettransacbyagent/"+$FROM.val()+"/"+$TO.val()+"/"+$STAT.val(), function(res){
            // console.log(res);
            $TBOD_TRANSAC.empty();
            $TBOD_TRANSAC.append(res);
            $BTN_SEARCH.attr('disabled', false);
        });
    }
$(function(){
        
    /* datetimepicker plug*/
    datetimepicker('trans-from');
    datetimepicker('trans-to');

//    getTransaclist();// initial load of the rows
    
    let acc_type = $.cookie('user_type');
    
    if(acc_type == 'agent'){
        getAgentTransa();
    }else{
        getTransaclist();
    }

    $BTN_SEARCH.on('click', function()
    {
        // let acc_type = $.cookie('user_type');
        if(acc_type == 'agent'){
            getAgentTransa();
        }else{
            getTransaclist();
        }
    });
    
    $TBOD_TRANSAC.on('click', '#lnk-transnum', function(e){
        e.preventDefault();
        let crntTransNum = $(this).data('transnum').toLowerCase();
        location.href=SITE_BASEPATH+"/vua/trasactionsviewing/index/"+crntTransNum;
    });  
});