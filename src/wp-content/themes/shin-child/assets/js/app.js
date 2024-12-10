
$(document).ready(function () {
  const API_KEY = "d5f7f24176774111947515bf212f2b95";

  // Disable dropdowns initially
  $("#make, #model").prop("disabled", true);

  // Fetch and populate year options
  fetchData(
    "https://api.vehicledatabases.com/market-value/options/v3/year",
    {},
    populateYearSelect
  );

  // Populate Year dropdown
  function populateYearSelect(response) {
    if (response.status === "success" && response.data.years?.length > 0) {
      const yearSelect = $("#year_car");
      yearSelect.empty().append('<option value="">Year</option>');
      response.data.years.forEach((year) => {
        yearSelect.append(`<option value="${year}">${year}</option>`);
      });
      yearSelect.prop("disabled", false);
    } else {
      console.error("No years found in the API response.");
    }
  }

  // Year change event handler
  $("#year_car").change(function () {
    const year = $(this).val();
    if (!year) return;

    const makeUrl = `https://api.vehicledatabases.com/market-value/options/v3/make/${year}`;
    fetchData(makeUrl, {}, populateMakeSelect);
  });

  // Populate Make dropdown
  function populateMakeSelect(response) {
    if (response.status === "success" && response.data.makes?.length > 0) {
      const makeSelect = $("#make");
      makeSelect.empty().append('<option value="">Make</option>');
      response.data.makes.forEach((make) => {
        makeSelect.append(`<option value="${make}">${make}</option>`);
      });
      makeSelect.prop("disabled", false);
    } else {
      console.error("No makes found for this year.");
    }
  }

  // Make change event handler
  $("#make").change(function () {
    const make = $(this).val();
    const year = $("#year_car").val();
    if (!make || !year) return;

    const modelUrl = `https://api.vehicledatabases.com/market-value/options/v3/model/${year}/${make}`;
    fetchData(modelUrl, {}, populateModelSelect);
  });

  // Populate Model dropdown
  function populateModelSelect(response) {
    if (response.status === "success" && response.data.models?.length > 0) {
      const modelSelect = $("#model");
      modelSelect.empty().append('<option value="">Model</option>');
      response.data.models.forEach((model) => {
        modelSelect.append(`<option value="${model}">${model}</option>`);
      });
      modelSelect.prop("disabled", false);
    } else {
      console.error("No models found for this make.");
    }
  }

  // Generic fetch function
  function fetchData(url, data, successCallback) {
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

  // Show loading spinner
  function showLoadingSpinner() {
    $("#loadingSpinner").show();
  }

  // Hide loading spinner
  function hideLoadingSpinner() {
    $("#loadingSpinner").hide();
  }
});

$(document).ready(function () {
  $("#make_model").on("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way
    const API_KEY = "d5f7f24176774111947515bf212f2b95";

    // Show loading spinner
    $("#makeModelloadingSpinner").show();

    // Get form values
    var year_car = $("#year_car").val();
    var make = $("#make").val();
    var model = $("#model").val();

    // Validate required fields
    if (!year_car || !make || !model) {
      alert("Please fill all the required fields.");
      $("#makeModelloadingSpinner").hide();
      return;
    }

    // API URL with parameters
    var apiUrl = `https://api.vehicledatabases.com/market-value/v2/ymm/${year_car}?make=${make}&model=${model}`;

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
        $("#makeModelloadingSpinner").hide();
        alert("An error occurred. Please try again later.");
        console.error(error);
      },
    });
  });
  $("#vin_form").on("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way
    const API_KEY = "d5f7f24176774111947515bf212f2b95";

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
