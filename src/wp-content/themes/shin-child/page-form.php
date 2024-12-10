<?php
/* Template Name: Form Page */


if (! defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
get_header();

the_content();

?>
<?php
if (!isset($_GET['year_car'])) return;
?>
<div class="page-form">
  <div class="container">

    <!-- Sidebar with steps -->
    <aside class="sidebar">
      <div class="wrapper">
        <div class="sidebar-title">
          <h2 class="_bfbca011 _e56ec4ec _4012a3a6">get an instant offer</h2>
          <h3 class="_7da63412 _8af7b883">We'll keep track of your answers over here. You can jump back to a previous question any time.</h3>
        </div>
        <ul>
          <li id="sidebar-step-1" class="sidebar-step done">Step 1: Vehicle Information </li>
          <li id="sidebar-step-2" class="sidebar-step">Step 2: Location</li>
          <li id="sidebar-step-3" class="sidebar-step">Step 3: Ownership Details</li>
          <li id="sidebar-step-4" class="sidebar-step">Step 4: Mileage</li>
          <li id="sidebar-step-5" class="sidebar-step">Step 5: Vehicle Condition</li>
          <li id="sidebar-step-6" class="sidebar-step">Step 6: Additional Questions</li>
          <li id="sidebar-step-7" class="sidebar-step">Step 7: Offer Delivery</li>
        </ul>
      </div>

    </aside>

    <!-- Main form -->
    <div class="form-container">
      <form id="resultForm">

        <!-- Step 1: Vehicle Information -->
        <fieldset class="step ressult-home" id="step-2">
          <!-- Year Field -->
          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="year_car" name="year_car">
                <option value="" class="elementor-field-textual elementor-size-sm"><?php echo $_GET['year_car']; ?></option>
              </select>
            </div>
          </div>

          <!-- Make Field -->
          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="make" name="make">
                <option value=""><?php echo $_GET['make']; ?></option>
              </select>
            </div>
          </div>

          <!-- Model Field -->
          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="model" name="model">
                <option value=""><?php echo $_GET['model']; ?></option>
              </select>
            </div>
          </div>

          <!-- Model Field -->
          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="mileage" name="mileage">
                <option value=""><?php echo $_GET['mileage']; ?></option>
              </select>
            </div>
          </div>
        </fieldset>

        <!-- Step 2: Location -->
        <fieldset class="step form-step" id="step-2">
          <legend>Step 2: Location</legend>
          <label for="zip">ZIP Code:</label>
          <input type="number" id="zip" name="zip" placeholder="Enter your ZIP code" required>
        </fieldset>

        <!-- Step 3: Ownership Details -->
        <fieldset class="step form-step" id="step-3" style="display:none;">
          <legend>Step 3: Ownership Details</legend>
          <label for="title">Do you have the vehicle title?</label>
          <select id="title" name="title" required>
            <option value="">Select...</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>

          <label for="loan">Is there an active loan on the vehicle?</label>
          <select id="loan" name="loan" required>
            <option value="">Select...</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </fieldset>

        <!-- Step 4: Mileage -->
        <fieldset class="step form-step" id="step-4" style="display:none;">
          <legend>Step 4: Mileage</legend>
          <label for="mileage">Enter Current Mileage:</label>
          <input type="number" id="mileage" name="mileage" placeholder="e.g., 50,000" required>
        </fieldset>

        <!-- Step 5: Vehicle Condition -->
        <fieldset class="step form-step" id="step-5" style="display:none;">
          <legend>Step 5: Vehicle Condition</legend>
          <label for="exterior">Exterior Condition:</label>
          <select id="exterior" name="exterior" required>
            <option value="">Select...</option>
            <option value="excellent">Excellent (No damage, like new)</option>
            <option value="good">Good (Minor scratches or dents)</option>
            <option value="fair">Fair (Visible damage, rust, or faded paint)</option>
            <option value="poor">Poor (Major damage, missing parts)</option>
          </select>
        </fieldset>

        <!-- Step 6: Additional Questions -->
        <fieldset class="step form-step" id="step-6" style="display:none;">
          <legend>Step 6: Additional Questions</legend>
          <label for="accident">Has the vehicle been in an accident?</label>
          <select id="accident" name="accident" required>
            <option value="">Select...</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </fieldset>

        <!-- Step 7: Offer Delivery -->
        <fieldset class="step form-step" id="step-7" style="display:none;">
          <legend>Step 7: Offer Delivery</legend>
          <label for="full-name">Full Name:</label>
          <input type="text" id="full-name" name="full-name" required>

          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required>

          <label for="phone">Phone Number (Optional):</label>
          <input type="tel" id="phone" name="phone">
          <button class="button-submit" type="submit">GET AN INSTANT OFFER <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg></span></button>
        </fieldset>
        <div class="loading-spinner" id="loadingSpinner"></div>


      </form>
    </div>
  </div>
</div>
<?php

get_footer();
