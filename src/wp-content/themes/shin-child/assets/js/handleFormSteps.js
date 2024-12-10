$(document).ready(function () {
  let currentStep = 1;
  const steps = $(".step");
  const tabs = $(".sidebar-step");

  showStep(currentStep);
  highlightTab(currentStep);

  function showStep(step) {
    steps.hide();
    $(steps[step]).show();
  }

  function highlightTab(step) {
    tabs.removeClass("active"); // Remove the active class from all tabs
    $(tabs[step]).addClass("active done"); // Add the active class to the current tab
  }

  // Handle tab click to jump to a specific step
  tabs.click(function () {
    const step = $(this).index();

    currentStep = step; // Update the current step
    showStep(currentStep); // Show the corresponding step
    highlightTab(currentStep); // Highlight the active tab
  });

  // Automatically go to the next step after 1 second when the user presses Enter
  $("input, select").on(
    "keypress",
    debounce(function (event) {
      if (event.key === "Enter") {
        event.preventDefault(); // Prevent the default Enter behavior (submit form)
        handleNextStep();
      }
    }, 500) // debounce with 500ms delay
  );

  // Handle input change events (debounced for performance)
  $("input, select").on(
    "change",
    debounce(function () {
      handleNextStep();
    }, 500)
  );

  // Function to handle step change
  function handleNextStep() {
    if (currentStep >= steps.length - 1) return; // Prevent going past last step
    if (validateLastField(currentStep)) {
      currentStep++;
      showStep(currentStep);
      highlightTab(currentStep);
    }
  }

  // Validation for the last input or select field of the current step
  function validateLastField(step) {
    let isValid = false;
    const currentForm = $(steps[step]);

    // Find the last input or select element in the current step
    const lastInput = currentForm.find("input, select").last();

    // Check if the last input or select element is filled
    if (lastInput.prop("required") && lastInput.val()) {
      isValid = true;
    }
    return isValid;
  }

  // Check if the current step has required fields
  function isStepRequired(step) {
    const stepForm = $(steps[step]);
    return stepForm.find("input[required], select[required]").length > 0;
  }

  // Debounce function to limit the rate of execution of a function
  function debounce(func, wait) {
    let timeout;
    return function () {
      const context = this,
        args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(function () {
        func.apply(context, args);
      }, wait);
    };
  }

  // Store selected values for the selects
  $("select").change(function () {
    const selectedValue = $(this).val();
    $(this).data("selected", selectedValue); // Store the selected value as a data attribute
  });

  // On load, reapply selected values when navigating back to previous steps
  $(steps).each(function () {
    $(this)
      .find("select")
      .each(function () {
        const storedValue = $(this).data("selected");
        if (storedValue) {
          $(this).val(storedValue); // Reapply the stored value if it exists
        }
      });
  });
});
