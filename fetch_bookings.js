let totalBookings = 0;
var lastLength = 0;
function fetchBookings(id){
    const container = document.querySelector("#booking-container");
    container.innerHTML = "<p>Booking</p><hr>";
    let html_string = "";
    $.ajax({
        url: './async/fetch_booking.php',
        method: 'POST',
        data: {
            trip_id: id
        },
        success: function(response){
            var encoded_response = JSON.parse(response);
            console.log("fetching");
            console.log(encoded_response);
            if(encoded_response.length !== 0){
                console.log(encoded_response);
                encoded_response.forEach(function(item) {
                    html_string = html_string + "<div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' style='margin-bottom: 25px;'>" +
                    "<div>"+ item.fname + " " + item.lname +"</div>" +
                    "<div>" + item.uPhone + "</div>" +
                    "<div><a href='booking-approval.php?id="+item.uID+"&book=true&trip="+item.Trip_idTrip+"' class='input-btn'><i class='fa-solid fa-check'></i></a> <a href='booking-approval.php?id="+item.uID+"&book=false&trip="+item.Trip_idTrip+"' class='input-btn'><i class='fa-solid fa-xmark'></i></a></div></div>";
                    
                    totalBookings++;
                    lastLength = encoded_response.length;
                });
                container.innerHTML = "<p>Booking</p><hr>" + html_string;
                html_string = "";
            }
            
            setTimeout(function() {
                fetchBookings(id);
            }, 5000);
        },
        error: function(xhr, status, error){
            console.error(error);
        }
    });
}
