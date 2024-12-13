$(document).ready(function () {
  // handleMakeFormSubmit();
  handleMakeFormChange();
  // Show loading spinner

  // Fetch and populate year options
  fetchData(
    "https://api.vehicledatabases.com/market-value/options/v3/year",
    {},
    populateYearSelect
  );
});

function handleMakeFormChange() {
  // Disable dropdowns initially
  $("#make, #model").prop("disabled", true);

  // Year change event handler
  $("#year_car").change(function () {
    const year = $(this).val();
    if (!year) return;

    const makeUrl = `https://api.vehicledatabases.com/market-value/options/v3/make/${year}`;
    fetchData(makeUrl, {}, populateMakeSelect);
  });
}

function showLoadingSpinner() {
  $("#loadingSpinner").show();
}

// Hide loading spinner
function hideLoadingSpinner() {
  $("#loadingSpinner").hide();
}
function handleMakeFormSubmit() {
  $("#make_model").on("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way
    const API_KEY = "e3518f4c3c5746b08b72229a0c077772";

    // Show loading spinner
    $("#makeModelloadingSpinner").show();

    // Get form values
    var year_car = $("#year_car").val();
    var make = $("#make").val();
    var model = $("#model").val();
    var trim = $("#trim").val();

    // Validate required fields
    if (!year_car || !make || !model) {
      alert("Please fill all the required fields.");
      $("#makeModelloadingSpinner").hide();
      return;
    }
    // window.location.href = `/form-collection?make=${make}&model=${model}&year_car=${year_car}&strim=${trim}`;

  });
}
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

// Model change event handler
$("#model").change(function () {
  const model = $(this).val();
  const year = $("#year_car").val();
  const make = $("#make").val();
  if (!model || !year) return;

  const trimlUrl = `https://api.vehicledatabases.com/ymm-specs/options/v2/trim/${year}/${make}/${model}`;
  fetchData(trimlUrl, {}, populateTrimSelect);
});

// Populate Trim dropdown

function populateTrimSelect(response) {
  const trimSelect = $("#trim");

  trimSelect.prop("disabled", false);
  if (response.status === "success" && response.trims != 0) {
    trimSelect.empty().append('<option value="">Trim</option>');
    response.trims.forEach((trim) => {
      trimSelect.append(`<option value="${trim}">${trim}</option>`);
    });
  } else {
    console.error("No models found for this make.");
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
    const trimInput = $("#trim");
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
