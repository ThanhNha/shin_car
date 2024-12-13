$(document).ready(function () {

  $("#vin_form").on("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way
    const API_KEY = "e3518f4c3c5746b08b72229a0c077772";

    // Show loading spinner
    $("#vinFormloadingSpinner").show();

    // Get form values
    var vin = $("#vin").val();
    var state = $("#state").val();
    var mileage = $("#mileage").val();

    // Validate required fields
    if (!vin || !state || !mileage) {
      alert("Please fill all the required fields.");
      $("#vinFormloadingSpinner").hide();
      return;
    }

    // API URL with parameters
    var apiUrl = `https://api.vehicledatabases.com/market-value/v2/${vin}?state=${state}&mileage=${mileage}`;

    // Make the API call using jQuery's AJAX
    $.ajax({
      url: apiUrl,
      method: "GET",
      headers: {
        "x-AuthKey": API_KEY,
      },
      success: function (data) {
        // Hide loading spinner after response
        $("#loadingSpinner").hide();
        const response = data.data;
        // Check if the data contains an offer
        console.log(data.data);
        if (response && response.basic) {
          // Redirect to the results page and pass data via query string
          window.location.href = `/form-collection?make=${response.basic.make}&model=${response.basic.model}&year_car=${response.basic.year}&mileage=${response.basic.mileage}&state=${response.basic.state}`;
        } else {
          alert("No offer available for the provided details.");
        }
      },
      error: function (xhr, status, error) {
        // Hide loading spinner
        $("#vinFormloadingSpinner").hide();
        alert("An error occurred. Please try again later.");
        console.error(error);
      },
    });
  });
});
