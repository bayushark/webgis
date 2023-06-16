<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert('Geolocation is not supported by this browser.');
  }
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;

  $.ajax({
    type: 'POST',
    url: 'Menu-Mencari-JarakJs.php',
    data: { lat: lat, lng: lng },
    success: function (response) {
      console.log(response);
    },
  });
}
