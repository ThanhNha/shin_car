<?php

/**
 * Category thumnail
 */

add_shortcode('make_model', 'make_model_callback');

function make_model_callback()
{

?>

  <form id="make_model" action="/form-collection" method="POST">
    <!-- Year Field -->
    <div class="elementor-field-type-select elementor-field-group">
      <div class="elementor-field elementor-select-wrapper">
        <div class="select-caret-down-wrapper">
        </div>
        <select id="year_car" name="year_car">
          <option value="" class="elementor-field-textual elementor-size-sm">Year</option>
        </select>
      </div>
    </div>

    <!-- Make Field -->
    <div class="elementor-field-type-select elementor-field-group">
      <div class="elementor-field elementor-select-wrapper">
        <div class="select-caret-down-wrapper">
        </div>
        <select id="make" name="make">
          <option value="">Make</option>
        </select>
      </div>
    </div>

    <!-- Model Field -->
    <div class="elementor-field-type-select elementor-field-group">
      <div class="elementor-field elementor-select-wrapper">
        <div class="select-caret-down-wrapper">
        </div>
        <select id="model" name="model">
          <option value="">Model</option>
        </select>
      </div>
    </div>

    <!-- Trim Field -->
    <div class="elementor-field-type-select elementor-field-group">
    <div class="elementor-field elementor-select-wrapper">
        <div class="select-caret-down-wrapper">
        </div>
        <select id="trim" name="trim" disabled>
          <option value="">Trim</option>
        </select>
      </div>
    </div>

    <div class="loading-spinner" id="loadingSpinner"></div>
    <div class="loading-spinner" id="makeModelloadingSpinner"></div>

    <button class="button-submit" type="submit">GET AN INSTANT OFFER <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg></span></button>

  </form>
<?php
}

add_shortcode('vin_form', 'vin_form_callback');

function vin_form_callback()
{

?>

  <form id="vin_form">
    <!-- VIN Field -->
    <div class="elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
      <label for="form-field-name" class="elementor-field-label elementor-screen-only">
        Enter VIN* </label>
      <input size="1" type="text" name="vin" id="vin" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Enter VIN*" required="required" aria-required="true">
    </div>

    <!-- State Field -->
    <div class="elementor-field-type-select elementor-field-group">
      <div class="elementor-field elementor-select-wrapper">
        <div class="select-caret-down-wrapper">
        </div>
        <select id="state" name="state">
          <option value="">State</option>
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>

      </div>
    </div>

    <!-- Mileage Field -->
    <div class="elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
      <input size="1" type="number" name="mileage" id="mileage" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Enter Mileage" required="required" aria-required="true">
    </div>

    <div class="loading-spinner" id="vinFormloadingSpinner"></div>

    <button class="button-submit" type="submit">GET AN INSTANT OFFER <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg></span></button>

  </form>
<?php
}
