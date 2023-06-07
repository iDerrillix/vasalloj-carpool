
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
// Function to check booking status
function checkBookingStatus(type) {
  let lastStat = localStorage.getItem('status');
    // Make an AJAX request to the server
    $.ajax({
      url: 'check_booking.php', // Path to your server-side PHP script
      method: 'POST',
      success: function(response) {
        var status = response.response_status;
        var heading = response.heading;
        var paragraph = response.paragraph;
        var alerted = response.alerted;
        console.log(status);
        console.log("Last Stat: " + lastStat);
        if(lastStat !== status){
          if (status === 'success') {
            toggleModal(heading, paragraph);
            alertnum();
            localStorage.setItem('status', status);
          }else if(status == 'confirm'){
            toggleModal(heading, paragraph);
            alertnum();
            localStorage.setItem('status', status);
            setTimeout(function (e){
              window.location.href == 'index.php';
          }, 3000);
        } else if(status == 'error'){
              toggleModal(heading, paragraph);
              alertnum();
              localStorage.setItem('status', status);
          } else{
          }
        } else{
        }
        
        setTimeout(function() {
          checkBookingStatus();
      }, 10000); // 5000 milliseconds = 5 seconds
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle the error scenario
        toggleModal("Error", 'Error occurred while checking booking status.');
        console.log('Error occurred while sending data:', errorThrown);
        console.log('Server response:', jqXHR.responseText);
      }
      
    });
    
  }
  


  