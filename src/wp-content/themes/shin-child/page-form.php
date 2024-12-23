<?php
/* Template Name: Form Page */


if (! defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
get_header();

the_content();

?>
<?php
if (!isset($_REQUEST['year_car'])) return;
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
          <li id="sidebar-step-3" class="sidebar-step">Step 3: Ownership Details
            <ul>
              <li id="sidebar-step-4" class="sidebar-step">Do you have the vehicle title?
              </li>
            </ul>

          </li>
          <li id="sidebar-step-5" class="sidebar-step">Step 4: Mileage</li>
          <li id="sidebar-step-6" class="sidebar-step">Step 5: Vehicle Condition
            <ul>
              <li id="sidebar-step-7" class="sidebar-step">Interior Condition
              </li>
              <li id="sidebar-step-8" class="sidebar-step">Mechanical Condition
              </li>
              <li id="sidebar-step-9" class="sidebar-step">Does the vehicle start and run?
              </li>
              <li id="sidebar-step-10" class="sidebar-step">Are all tires inflated?
              </li>
            </ul>
          </li>
          <li id="sidebar-step-11" class="sidebar-step">Step 6: Additional Questions
            <ul>
              <li id="sidebar-step-12" class="sidebar-step">Are there any warning lights on the dashboard?
              </li>
              <li id="sidebar-step-13" class="sidebar-step">Has the vehicle been in a flood?
              </li>
              <li id="sidebar-step-14" class="sidebar-step">Is the catalytic converter missing?
              </li>
              <li id="sidebar-step-15" class="sidebar-step">Does the vehicle have aftermarket modifications?
              </li>
            </ul>
          </li>
          <li id="sidebar-step-16" class="sidebar-step">Step 7: Offer Delivery</li>

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
              <select id="year_car_result" name="year_car_result">
                <option value="<?php echo $_REQUEST['year_car']; ?>" class="elementor-field-textual elementor-size-sm"><?php echo $_REQUEST['year_car']; ?></option>
              </select>
            </div>
          </div>

          <!-- Make Field -->
          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="make_result" name="make_result">
                <option selected value="<?php echo $_REQUEST['make']; ?>"><?php echo $_REQUEST['make']; ?></option>
              </select>
            </div>
          </div>

          <!-- Model Field -->
          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="model_result" name="model_result">
                <option selected value="<?php echo $_REQUEST['model']; ?>"><?php echo $_REQUEST['model']; ?></option>
              </select>
            </div>
          </div>

          <div class="elementor-field-type-select elementor-field-group">
            <div class="elementor-field elementor-select-wrapper">
              <div class="select-caret-down-wrapper">
              </div>
              <select id="mileage" name="mileage">
                <option value="<?php echo $_REQUEST['mileage']; ?> " selected><?php echo $_REQUEST['mileage']; ?></option>
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
          <label for="title-yes">Do you have the vehicle title?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="title-yes" name="title" value="yes" required>
              <label for="title-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="title-no" name="title" value="no" required>
              <label for="title-no">No</label>
            </div>
          </div>
        </fieldset>
        <!--Sub Step 3 = 4:  Ownership Details -->

        <fieldset class="step form-step" id="step-4" style="display:none;">
          <legend>Step 3: Ownership Details</legend>

          <label for="loan-yes">Is there an active loan on the vehicle?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="loan-yes" name="loan" value="yes" required>
              <label for="loan-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="loan-no" name="loan" value="no" required>
              <label for="loan-no">No</label>
            </div>
          </div>
        </fieldset>

        <!-- Step 4: Mileage -->
        <fieldset class="step form-step" id="step-5" style="display:none;">
          <legend>Step 4: Mileage</legend>
          <label for="mileage">Enter Current Mileage:</label>
          <input type="number" id="mileage" name="mileage" placeholder="e.g., 50,000" required>
        </fieldset>

        <!-- Step 5: Vehicle Condition -->
        <fieldset class="step form-step" id="step-6" style="display:none;">
          <legend>Step 5: Vehicle Condition</legend>
          <label for="exterior">Exterior Condition:</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="exterior-excellent" name="exterior" value="excellent" required>
              <label for="loan-excellent">Excellent (No damage, like new)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="exterior-good" name="exterior" value="good" required>
              <label for="exterior-good">Good (Minor scratches or dents)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="exterior-fair" name="exterior" value="fair" required>
              <label for="exterior-fair">Fair (Visible damage, rust, or faded paint)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="exterior-poor" name="exterior" value="poor" required>
              <label for="exterior-poor">Poor (Major damage, missing parts)</label>
            </div>
          </div>

        </fieldset>
        <!-- Sub Step 5 : Vehicle Condition -->

        <fieldset class="step form-step" id="step-7" style="display:none;">
          <legend>Step 5: Vehicle Condition</legend>
          <label for="interior">Interior Condition:</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="interior-excellent" name="interior" value="excellent" required>
              <label for="loan-excellent">Excellent (Clean, no damage)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="interior-good" name="interior" value="good" required>
              <label for="interior-good">Good (Minor wear or small stains)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="interior-fair" name="interior" value="fair" required>
              <label for="interior-fair">Fair (Tears or broken parts)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="interior-poor" name="interior" value="poor" required>
              <label for="interior-poor">Poor (Significant damage or missing parts)</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-8" style="display:none;">
          <legend>Step 5: Vehicle Condition</legend>
          <label for="mechanical">Mechanical Condition:</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="mechanical-excellent" name="mechanical" value="excellent" required>
              <label for="loan-excellent">Excellent (Runs perfectly, no issues)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="mechanical-good" name="mechanical" value="good" required>
              <label for="mechanical-good">Good (Minor mechanical issues)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="mechanical-fair" name="mechanical" value="fair" required>
              <label for="mechanical-fair">Fair (Runs but needs repairs)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="mechanical-poor" name="mechanical" value="poor" required>
              <label for="mechanical-poor">Poor (Doesn’t run or requires major repairs)</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-9" style="display:none;">
          <legend>Step 5: Vehicle Condition</legend>
          <label for="vehicle">Does the vehicle start and run?:</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="vehicle-yes" name="vehicle" value="yes" required>
              <label for="vehicle-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="vehicle-no" name="vehicle" value="no" required>
              <label for="vehicle-no">No</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-10" style="display:none;">
          <legend>Step 5: Vehicle Condition</legend>
          <label for="tires_inflated">Are all tires inflated?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="tires_inflated-yes" name="tires_inflated" value="yes" required>
              <label for="tires_inflated-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="tires_inflated-no" name="tires_inflated" value="no" required>
              <label for="tires_inflated-no">No</label>
            </div>
          </div>
        </fieldset>

        <!-- Step 6: Additional Questions -->
        <fieldset class="step form-step" id="step-11" style="display:none;">
          <legend>Step 6: Additional Questions</legend>
          <label for="accident-yes">Has the vehicle been in an accident?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="accident-yes" name="accident" value="yes" required>
              <label for="accident-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="accident-no" name="accident" value="no" required>
              <label for="accident-no">No</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-12" style="display:none;">
          <legend>Step 6: Additional Questions</legend>
          <label for="warning_lights-yes">Are there any warning lights on the dashboard?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="warning_lights-yes" name="warning_lights" value="yes" required>
              <label for="warning_lights-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="warning_lights-no" name="warning_lights" value="no" required>
              <label for="warning_lights-no">No</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-13" style="display:none;">
          <legend>Step 6: Additional Questions</legend>
          <label for="flood-yes">Has the vehicle been in a flood?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="flood-yes" name="flood" value="yes" required>
              <label for="flood-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="flood-no" name="flood" value="no" required>
              <label for="flood-no">No</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-14" style="display:none;">
          <legend>Step 6: Additional Questions</legend>
          <label for="catalytic_converter-yes">Is the catalytic converter missing?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="catalytic_converter-yes" name="catalytic_converter" value="yes" required>
              <label for="catalytic_converter-yes">Yes</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="catalytic_converter-no" name="catalytic_converter" value="no" required>
              <label for="catalytic_converter-no">No</label>
            </div>
          </div>
        </fieldset>

        <fieldset class="step form-step" id="step-15" style="display:none;">
          <legend>Step 6: Additional Questions</legend>
          <label for="aftermarket_modifications">Does the vehicle have aftermarket modifications?</label>
          <div class="radio-wrapper">
            <div class="radio-control">
              <input type="radio" id="aftermarket_modifications-none" name="aftermarket_modifications" value="none" required>
              <label for="loan-excellent">None- Cosmetic (e.g., custom paint, wheels)</label>
            </div>
            <div class="radio-control">
              <input type="radio" id="aftermarket_modifications-performance" name="aftermarket_modifications" value="performance" required>
              <label for="aftermarket_modifications-good">Performance (e.g., turbo, suspension)</label>
            </div>

          </div>
        </fieldset>

        <!-- Step 7: Offer Delivery -->
        <fieldset class="step form-step" id="step-16" style="display:none;">
          <legend>Step 7: Offer Delivery</legend>
          <label for="full-name">Full Name:</label>
          <input type="text" id="full-name" name="full-name" required>

          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required>

          <label for="phone">Phone Number (Optional):</label>
          <input type="tel" id="phone" name="phone">
          <button class="button-submit" id="get_car_result" type="submit">GET AN INSTANT OFFER <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg></span></button>

        </fieldset>


        <div class="loading-spinner" id="loadingSpinner"></div>


      </form>
      <div class="container">
        <div id="result_car">
          <span class="title">Ta da! We'd love to buy your
            <strong>

              <span id="year_result">
                <?php echo $_REQUEST['year_car']; ?>
              </span>

              <span id="make_result">
                <?php echo $_REQUEST['model']; ?>
              </span>

              <span id="model_result">
                <?php echo $_REQUEST['make']; ?>
              </span>

            </strong>
            for
          </span>


          <div id="total_cost"></div>

          <button class="back_home"><a href="/"> Back</a></button>
        </div>
      </div>
    </div>
  </div>

</div>
<?php

get_footer();
