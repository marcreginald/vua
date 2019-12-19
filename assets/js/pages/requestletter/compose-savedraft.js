
var saveRL = function(paRams){
    
    $.post(SITE_BASEPATH+"/vua/compose/saverq", $.param(paRams), function(res){
        if(res.status){
            showGritter('Success!', 'Request letter saved');
            setTimeout(function(){
                location.href=SITE_BASEPATH+"/vua/mgrdraftrquestlet/";
            }, 1000);
        }else{
            showGritter('Error!', 'Unable to save the request letter', 'error');
        }
    });
}

/* saving the draft in */
$(function(){
  $BTN_SAVEDRAFT.on('click', function(e){
      e.preventDefault();
      // alert('Saving the Compose Request Letter Draft.');
      $(this).attr('disabled', true);
      
      
      if(!$COMPOSE_DATE.val()){
          // alert('Empty date');
         $(this).attr('disabled', false);
         $COMPOSE_DATE.closest('.form-group-sm .form-control').css('border-color', 'red');
       }else{
         // alert('Not empty date');
         $COMPOSE_DATE.closest('.form-group-sm .form-control').css('border-color', ''); // removing a css property
           
          let data = {};
          data.batch_no   = getBatchId();
          data.rq_to         = $("#to-commissioner").val();
          data.letter_date= $("#compose-date").val();
          data.assignatory= $("#assignatory").val();
          data.rq_status  = 'saved';      
          saveRL(data);
           
       }
      
  });
    
});