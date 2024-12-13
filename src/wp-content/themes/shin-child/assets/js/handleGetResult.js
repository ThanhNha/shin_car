$(document).ready(function () {
  $("#resultForm").on("submit", function (e) {
    e.preventDefault();
    console.log($("#year_car_result").val());
    var year = $("#year_car_result").val();
    var make = $("#make_result").val();
    var model = $("#model_result").val();
    if (!year || !make || !model) {
      alert("Please fill all the required fields.");
      $("#hideLoadingSpinner").hide();
      return;
    }
    const mileage = $("#mileage").val();
    // const vinURL = `https://api.vehicledatabases.com/market-value/options/v3/model/${year}/${make}`;
    const vinURL = `https://api.vehicledatabases.com/market-value/v2/ymm/${year}/${make}/${model}`;

    // // Fetch and populate year options
    fetchData(vinURL, {}, handleResult);
  });
});

// Generic fetch function
function fetchData(url, data, successCallback) {
  const API_KEY = "e3518f4c3c5746b08b72229a0c077772";

  $.ajax({
    url: url,
    method: "GET",
    headers: {
      "x-AuthKey": API_KEY,
    },
    data: data,
    beforeSend: showLoadingSpinner,
    success: function (response) {
      hideLoadingSpinner();
      if (response.status === "success") {
        successCallback(response);
      } else {
        console.error("API request failed.");
      }
    },
    error: function (xhr, status, error) {
      hideLoadingSpinner();
      console.error("Error fetching data:", error);
      alert("There was an error fetching data. Please try again.");
    },
  });
}

function handleResult(response) {
  if (
    response.status === "success" &&
    response.data?.market_value?.market_value_data?.length > 0
  ) {
    const data = response.data.market_value.market_value_data[0];

    // Find the "Trade-In" value for the "Average" condition
    const price = data["market value"]?.find(
      (item) => item.Condition === "Average"
    )?.["Trade-In"];

    if (price) {
      $("#total_cost").text(price);
      $("#result_car").addClass("show");
    } else {
      console.error("Price for 'Average' condition not found.");
    }
  } else {
    console.error("No models found for this make or response is invalid.");
  }
}

function showLoadingSpinner() {
  $("#loadingSpinner").show();
}

// Hide loading spinner
function hideLoadingSpinner() {
  $("#loadingSpinner").hide();
}
