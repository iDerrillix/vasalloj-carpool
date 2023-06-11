
function alertnum(){
  $.ajax({
    url: 'reset-alert.php',
    method: 'POST',
    data: {
      mode: 'on'
    },
    success: function(response){
      console.log(response);
    },
    error: function(xhr, status, error){
      console.error(error);
    }
  });
}
function resetAlertStatus(){
  $.ajax({
    url: 'reset-alert.php',
    method: 'POST',
    data: {
      mode: 'off'
    },
    success: function(response){
      console.log(response);
    },
    error: function(xhr, status, error){
      console.error(error);
    }
  });
}

function checkBookingStatus(type) {
  console.log("function " + type);
    $.ajax({
      url: 'check_booking.php', 
      method: 'POST',
      success: function(response) {
        var status = response.response_status;
        var heading = response.heading;
        var paragraph = response.paragraph;
        var alerted = response.alerted;
        var typers = response.type;
        console.log(status);
        if (status === 'success') {
          toggleModal(heading, paragraph);
          setTimeout(function() {
            window.location.href = 'index.php';
          }, 3000);
        } else if(status == 'confirm'){
          toggleModal(heading, paragraph);
          setTimeout(function() {
            window.location.href = 'index.php';
          }, 3000);
        } else if(status == 'cancelled'){
          toggleModal(heading, paragraph);
          setTimeout(function() {
            window.location.href = 'index.php';
          }, 3000);
        } else if(status == 'finished'){
          toggleModal(heading, paragraph);
          setTimeout(function() {
            window.location.href = 'index.php';
          }, 3000);
        } else if(status == 'complete'){
          toggleModal(heading, paragraph);
          setTimeout(function() {
            window.location.href = 'index.php';
          }, 3000);
        }else if(status == 'error'){
            toggleModal(heading, paragraph);
            alertnum();
        } else{
        }
        
        setTimeout(function() {
          checkBookingStatus();
      }, 10000);
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        toggleModal("Error", 'Error occurred while checking booking status.');
        console.log('Error occurred while sending data:', errorThrown);
        console.log('Server response:', jqXHR.responseText);
      }
      
    });
    
  }
  function updateUser(id){
    console.log("checking utype");
    $.ajax({
      url: 'fetch_type.php',
      method: 'POST',
      data: {uID: id},
      success: function(response){
        console.log(response);
        var status = response.status;
        var type = response.type;
        if(status == 'success'){
          console.log(type);
          toggleModal("Application Accepted", "You have been accepted as a driver!");
          setTimeout(function() {
            window.location.href ='index.php';
        }, 2000);
        } else if(status == 'error'){
          toggleModal("Error", "An unexpected error has occured");
        } else{
          console.log("do nothing");
        }
        setTimeout(function() {
          updateUser(id);
      }, 10000);
      }, 
      error: function(jqXHR, textStatus, errorThrown) {
        toggleModal("Error", 'Error occurred while checking user type');
        console.log('Error occurred while sending data:', errorThrown);
        console.log('Server response:', jqXHR.responseText);
      }
    });
  }
  


  