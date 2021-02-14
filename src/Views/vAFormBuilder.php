<?php foreach ($forms as $form) :
  $prefix = '<div class="form-group row">';
  $sufix  = '</div></div>';

  if (isset($form['label'])) {
    $prefix .= '<div class="col-3">';
    $prefix .= form_label($form['label'], $form['name']);
    if (isset($form['required']))
      $prefix .= '<span class="text-danger">*</span>';
    $prefix .= '</div>';
  }

  $prefix .= '<div class="col-9">';
  
  switch ($form['type']) {
    case 'hidden':
      echo form_hidden($form['field']);
      break;

    case 'password':
      echo $prefix . form_password($form['field']) . $sufix;
      break;

    case 'upload':
      echo $prefix . form_upload($form['field']) . $sufix;
      break;

    case 'textarea':
      echo $prefix . form_textarea($form['field']) . $sufix;
      break;

    case 'dropdown':
      echo $prefix . form_dropdown($form['field']) . $sufix;
      break;

    case 'checkbox':
      echo $prefix . '<div class="checkbox-' . $form['style'] . '">';
      foreach ($form['fields'] as $field) {
        echo '<label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">' . form_checkbox($field, '', set_checkbox($field['name'], $field['value'])) . '<span></span>' . $field['text'] . '</label>';
      }
      echo '</div>' . $sufix;
      break;

    case 'switch':
      echo $prefix . '<span class="switch switch-outline switch-icon switch-' . $form['style'] . '">';
      foreach ($form['fields'] as $field) {
        echo '<label>' . form_checkbox($field, '', set_checkbox($field['name'], $field['value'])) . '<span></span></label>';
      }
      echo '</span>' . $sufix;
      break;

    case 'radio':
      echo $prefix . '<div class="radio-' . $form['style'] . '">';
      foreach ($form['fields'] as $field) {
        echo '<label class="radio radio-outline radio-outline-2x radio-primary">' . form_radio($field, '', set_checkbox($field['name'], $field['value'])) . '<span></span>' . $field['text'] . '</label>';
      }
      echo '</div>' . $sufix;
      break;

    default:
      echo $prefix . form_input($form['field']) . $sufix;
      break;
  }
endforeach; ?>