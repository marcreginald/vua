var $RECENT_ACT = $("#recent-activities"); // Recent activities 

var $ACTIVE_USR = $("#active-users");

/* getting the counter for the Summary */
var getCounter = function(ajax, elem){
    
    let fullUrl = SITE_BASEPATH+"/vua/dashboard/"+ajax;
    $.getJSON(fullUrl, function(res){
        $('#'+elem).text(res.counter);
    });
}

/* thanks STACK_OVERFLOW :D easy getting the am or pm of the time in 12:based format */
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

/* getting the recent activities of the day  */
var getRecentActivities = function(){
    
    // draft, pending, verified
    // just building the ul here
    $RECENT_ACT.append('Loading...');
    $.getJSON(SITE_BASEPATH+"/vua/dashboard/getrecentact", function(logs){
        $RECENT_ACT.empty();
        let ulList = '<ul class="feeds">';
        $.each(logs, function(i, r){
            
            let d = new Date(r.date_created);
            
            if(r.remarks_type === 'DRAFT'){
                
              let li = `
                <li title="Drafted">
                    <a href="javascript:;">
                        <div class="icon bg-success-light"><i class="fa fa-check"></i></div>
                        <div class="time">`+r.description+`<small>(`+formatAMPM(d)+`)</small></div>
                        <div class="desc">`+r.trans_no+`</div>
                    </a>
                </li>
              `; 
                
                ulList += li;
            }else if(r.remarks_type === 'PENDING'){
                  let li = `
                    <li title="Pending">
                        <a href="javascript:;">
                            <div class="icon bg-info-light"><i class="fa fa-info-circle"></i></div>
                            <div class="time">`+r.description+`<small>(`+formatAMPM(d)+`)</small></div>
                            <div class="desc">`+r.trans_no+`</div>
                        </a>
                    </li>
                  `;
                   ulList += li;
            }else{
                 let li = `
                    <li title="Approved">
                        <a href="javascript:;">
                            <div class="icon bg-warning-light"><i class="fa fa-file-text"></i></div>
                            <div class="time">`+r.description+`<small>(`+formatAMPM(d)+`)</small></div>
                            <div class="desc">`+r.trans_no+`</div>
                        </a>
                    </li>
                  `;
                  ulList += li;  
             }
            
        });
        ulList += '</ul>';
        
        $RECENT_ACT.append(ulList);
        
    });
}

/* getting the active users */
var getActiveUsers = function(){
    
    let uploadPath = $('#uplaod-path').text();
    $ACTIVE_USR.append('Loading...');
    $.getJSON(SITE_BASEPATH+"/vua/dashboard/getactiveusers", function(users){
        // console.log(users);
        $ACTIVE_USR.empty();
        let ulList = '<ul class="widget-chat-list">';
        $.each(users, function(i, user){
            
            let profile = uploadPath+user.user_profilepath;
            let fullName = user.user_fname+' '+user.user_lname;
            let d = new Date(user.date_created);
            let li = `
                <li>
                    <a href="#" data-toggle="chat-detail">
                        <div class="chat-image">
                            <img src="`+profile+`" alt="User Profile Info">
                        </div>
                        <div class="chat-info has-new">
                            <h4>`+fullName+`</h4>
                            <p>
                                Email: `+user.user_email+`
                            </p>
                            <span class="chat-time">`+d.toDateString()+`</span>
                        </div>
                    </a>
                </li>
`;
            
            ulList += li
        });
        ulList += '</ul>';
        
        $ACTIVE_USR.append(ulList);
        
    });
}

/* polymorphing if the user is a manager / admin or a agent. */

/* 
    if a admin then in the server ready the script for the admin/agent the rule was 
    if the user is an admin or agent the span transaction of the visa batched request was with 7 day from today
    in the php get the last -7 days then pass it into the SQL to get the transaction  base from that use the between keyword. 
    
    PROBLEM WAS:
        -
    
    SOLUTION 
       - create a additional table to handle the visa_batched request process
       
       - trigger the switching from new => read when the user click the right sidebar visa batched request.
       
       - create a table for inserting the based data needed for the trail of batched pending.. 
       
       - user view to get the visa batched request right sidebar.
*/

$(function(){
    $('#datepicker-inline').datepicker({setDate: new Date(), todayHighlight:!0});
    getCounter('getdraft', 'total-draft');
    getCounter('getpending', 'total-pending');
    getCounter('getverified', 'total-verified');
    getCounter('getapproved', 'total-approved');

    getRecentActivities(); // getting the recent transactions
    
    getActiveUsers();
    
//    alert($.cookie('user_type'));
    
//    $('#header > div > ul > li:nth-child(4)').remove();
});