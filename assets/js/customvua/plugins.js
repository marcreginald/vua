/* displaying the datatable (my datatable)*/
var datatable = function(elem, ajax, isServerSide = false, domLayout = 'frti', lenghtMen = '10,20,50'){
    
    $('#'+elem).DataTable({
        dom: domLayout,
        ajax:ajax,
        lengthMenu:lenghtMen.split(','),
        // scrollY: 300,
        scrollX: !0,
        // scrollCollapse: !0,
        // paging: !0,
        // fixedColumns: !0,
        responsive: !1,
        processing:!1,
        serverside:isServerSide,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search .. (搜索 ..)"
        }
    });
}

/* displaying date picker (old date picker)*/
var datepicker = function(elem){
    
    $('#'+elem).datepicker({
        autoclose:!0,
        format:'yyyy-mm-dd',
        clearBtn:!0,
        todayHighlight:!0,
        title:'Select your Date or birth',
    });
}

/* datetimepciker amazing :)*/
var datetimepicker = function(elem){
    $('#'+elem).datetimepicker({
        format:'MM-DD-YYYY'
//        format:'個月-天-年'
    });
}

/*var maskinput = function(elem, maskFrmt){
    
}*/

/* elevate zoomer */
var elevatezoomer = function(elem){
    
    $('#'+elem).elevateZoom({
        zoomType: "inner",
        cursor: "pointer",
        responsive:true,
        easing:true 
    });
}

/* dynamic creation of select2 */
var select2wan = function(elem, ajax, val = 0){
    
    if(val === 0){
       $.getJSON(ajax, function(res){
           $('#'+elem).select2({
              placeholder:'Please Select', 
              data: res.data,
              dropDownAutoWidth:true,
           }); 
        });
    }else{
        $.getJSON(ajax, function(res){
           $('#'+elem).select2({
              placeholder:'Please Select',
              data: res.data,
              dropDownAutoWidth:true,
           }).select2('val', val); 
        });
    }
}


/* END OF PLUGINS JS THESE IS THE CUSTOM FUCTIONS FOR DRYING THE CODE */

/* for sanizing the basic data of the visa transactions */
var isanitizer = function(whatType, domElem){

  let elem = '#'+domElem;
  // let fRegex = '';

  switch(whatType){

      case 'passport':
      // do the passport validation (A-Z0-9)
      $(elem).bind('keypress', function (event) {
          var regex = new RegExp("^[a-zA-Z0-9-]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
      });
      break;

      case 'email':
      // do the email validation here excluding the caps lock (a-z0-9@._-)
      $(elem).bind('keypress', function (event) {
          var regex = new RegExp("^[a-z0-9@._-]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
      });
      break;

      case 'nametype':
      // do the name trick allowed characters are (a-zA-Z .,)
      $(elem).bind('keypress', function (event) {
          var regex = new RegExp("^[a-zA-Z., ]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
      });
      break;
    
     /* alphanumeric condition with space and some other common character needed. */
      default: 
        $(elem).bind('keypress', function (event) {
          var regex = new RegExp("^[a-zA-Z .,-]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
      });
      break;
  }

}

/* checker if an element is exist in the current context of DOM INSIDE BOM */
var isElemExist = function(chkElem){
    
    var checker = $('body').find(chkElem);

    if(checker.length != 0){
       return true;
    }else{
        return false;
    }
    
}

/* selecting all the checked visa transaction and returning it as an single array of data */
var getAllSelectedTrans = function  (){
    $('#trans-needle:checked').data('transnum');
    
    let selectedTrans = [];
    // each is <3
    $('#trans-needle:checked').each(function(i, e){
        selectedTrans.push($(e).data('transnum'));
    });
    
    return selectedTrans;
} /* added 11:07 AM 2/19/2018*/


/* 
    { backdrop:"static", keyboard:"false" }
*/

/*
	<?= date('m-d-Y', strtotime('-1 months')); ?>
*/

var hideButtons = function(){
  $('#print-rqlletter').hide();
  $('#btn-approve').hide();
  $('#attach-confirmationrql').hide();

  $('#listapplicant-table > thead > tr > th:nth-child(8)').hide();
  $('#listapplicant-table > tbody > tr > td:nth-child(8)').hide();

}

/* right sidebar notification list */
var handleSidebar = function(ajax){
    
    // $RIGHT_SIDEBAR.empty();
    /* just append the right sidebar feature here */
    let url = SITE_BASEPATH+"/util/"+ajax;
    $.get(url, function(noti){
        // console.log(noti);
        $RIGHT_SIDEBAR.append(noti);
//         console.log(noti);
        /* check the html if there is a word new haha then add the notification :D */
        
        if((noti.indexOf('New') > -1 ) || noti.indexOf('No. Notification') == -1){
            $('#noti-flag').addClass('has-notify');
            // console.log('have a notification must bubble');
        }else{
            console.log('no new batch sent');
        }
    });
}

/* formatting an ISO date to the mm-dd-yyyy date format in the javascript engine */
var toVuaJSDate = function(iso_dateFormat){
    let arrivalDate   = new Date(iso_dateFormat);
    let formattedDate = (arrivalDate.getMonth() + 1) +'-'+ arrivalDate.getDate() +'-'+ arrivalDate.getFullYear();
    
    return formattedDate;
}

$(function(){
    
   let userType = $.cookie('user_type'); 
    // let $UL_NAV = $("#sidebar > div > div:nth-child(1) > ul");
    switch(userType){
            
        case 'manager':
            $('#draftagent').remove();
            $('#sent').remove();
            $('#users').remove();
            $('#settings').remove();
            // handleSidebar('admingetbatchrql');
            SITE_BASEPATH+('admingetbatchrql');
        break;
            
        case 'agent':
            $('#inbox').remove();
            $('#batchrecords').remove();
            $('#mgrdraftrquestlet').remove();
            $('#users').remove();
            $('#settings').remove();
            hideButtons();
            // handleSidebar('agentbatchrql');
            SITE_BASEPATH+('agentbatchrql');
        break;
            
        default:
            // handleSidebar('admingetbatchrql');
            SITE_BASEPATH+('admingetbatchrql');
        break;
            
    }
    
});



