<?php
/**
 * Implements hook_form_alter
 * 
 * @param type $form
 * @param type $form_state 
 */
/**--function hook_form_FORM_ID_alter(&$form, $form_state)--*/

function my_fieldset_form_my_fieldset_form1_alter(&$form, $form_state) {
  // Auto-fill ZIP Code once we have city and state
  // - element_children filters out properties (ie keys starting with "#")
  foreach(element_children($form['field_address'][$form['language']['#value']]) as $address_key) {
    if(is_numeric($address_key)) { // filter out "add_more" button element
      // Setup AJAX to be called whenever State drop-down change event happens
      $form['field_address'][$form['language']['#value']][$address_key]['locality_block']['administrative_area']['#ajax'] = array(
        'callback' => 'hook_zip_autofill_callback',
        'wrapper' => 'field-address-add-more-wrapper',
        'progress' => array(
          'type' => 'throbber',
          'message' => 'Determining ZIP Code... ',
        ),
      );
      
      // Geocode and fill in as #default_value for Zip code
      $zip_code_calculated = FALSE;
      if(!empty($form_state['values']) && !empty($form_state['values']['field_address'][$form_state['values']['language']][$address_key])) {
        $address = $form_state['values']['field_address'][$form_state['values']['language']][$address_key];
        if(!empty($address['thoroughfare']) && !empty($address['locality']) && !empty($address['administrative_area'])) {
          $geocode_address = $address['thoroughfare'] . ', ';
          if(!empty($address['premise'])) {
            $geocode_address .= $address['premise'] . ', ';
          }
          $geocode_address .= $address['locality'] . ', ';
          $geocode_address .= $address['administrative_area'] . ', ';
          $geocode_address .= $address['country'];
          $point = geocoder('google', $geocode_address);
          if(isset($point) && !empty($point->data) && !empty($point->data['geocoder_address_components'])) {
            foreach($point->data['geocoder_address_components'] as $component) {
              foreach($component->types as $type) {
                switch($type) {
                  case 'postal_code': // zip code
                    $form['field_address'][$form['language']['#value']][$address_key]['locality_block']['postal_code']['#value'] = $component->short_name;
                    // since we have to set the #value (see http://drupal.stackexchange.com/q/3875/6581) it will override any user input, so just disable it
                    $form['field_address'][$form['language']['#value']][$address_key]['locality_block']['postal_code']['#disabled'] = TRUE;
                    $zip_code_calculated = TRUE;
                    break;
                }
              }
            }
          }
        }
      }
      if(!$zip_code_calculated) { // allow user to edit if it wasn't explicitly calculated and set
        $form['field_address'][$form['language']['#value']][$address_key]['locality_block']['postal_code']['#disabled'] = FALSE;
      }
    }
  }
}

/**
 * Callback to autofill Zip code 
 */
function my_fieldset_zip_autofill_callback($form, $form_state) {
  return $form['field_address'][$form['language']['#value']];
}
