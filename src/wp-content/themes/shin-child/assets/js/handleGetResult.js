$(document).ready(function () {
  $("#resultForm").on("submit", function (e) {
    e.preventDefault();
    var year = $("#year_car_result").val();
    var make = $("#make_result").val();
    var model = $("#model_result").val();
    var full_name = $("#full-name");
    var email = $("#email");
    var full_name = $("#phone");
    if (!year || !make || !model) {
      alert("Please fill all the required fields.");
      $("#hideLoadingSpinner").hide();
      return;
    }
    const vinURL = `https://api.vehicledatabases.com/market-value/v2/ymm/${year}/${make}/${model}`;

    // // Fetch and populate year options

    if (sendEmail == 1) {
      const emailTemplate = generateEmailTemplate(
        email,
        full_name,
        phone,
        "All results are satisfactory."
      );
      sendEmailInWordPress(adminEmail, "Your Collections", emailTemplate);
    } else {
      fetchData(vinURL, {}, handleResult);
    }
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
    const listInput = [
      "title",
      "loan",
      "exterior",
      "interior",
      "mechanical",
      "vehicle",
      "tires_inflated",
      "accident",
      "warning_lights",
      "flood",
      "catalytic_converter",
    ];
    let totalNoAndPoor = countNoAndPoor(listInput);

    // Find the "Trade-In" value for the "Average" condition
    const price = data["market value"]?.find(
      (item) => item.Condition === "Average"
    )?.["Trade-In"];
    if (price) {
      const priceAfter = (price * discountRate * totalNoAndPoor) / 100;
      $("#total_cost").text(priceAfter);
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

function countNoAndPoor(listNames) {
  // Ensure listNames is an array
  if (!Array.isArray(listNames)) {
    throw new Error("Parameter must be an array of names.");
  }

  // Count the occurrences of "no" and "poor"
  const count = listNames.reduce((total, listName) => {
    return (
      total +
      $(
        `input[name="${listName}"][value="no"]:checked, input[name="${listName}"][value="poor"]:checked`
      ).length
    );
  }, 0);

  return count;
}

function generateEmailTemplate(email, name, phone, result) {
  return `
      <h1>User Details</h1>
      <p><strong>Email:</strong> ${email}</p>
      <p><strong>Name:</strong> ${name}</p>
      <p><strong>Phone:</strong> ${phone}</p>
      <h2>Results</h2>
      <p>${result}</p>
  `;
}
function sendEmailInWordPress(
  to,
  subject,
  message,
  headers = "Content-Type: text/html",
  attachments = []
) {
  // Ensure required parameters are provided
  if (!to || !subject || !message) {
    throw new Error(
      "Missing required parameters: 'to', 'subject', or 'message'."
    );
  }

  // AJAX request to send email via WordPress backend
  $.ajax({
    url: '/wp-admin/admin-ajax.php', // WordPress AJAX URL
    type: "POST",
    data: {
      action: "send_custom_email", // Custom action name
      to: to,
      subject: subject,
      message: message,
      headers: headers,
      attachments: attachments,
    },
    success: function (response) {
      console.log("Email sent successfully:", response);
    },
    error: function (error) {
      console.error("Error sending email:", error);
    },
  });
}

function buildEmail() {}
