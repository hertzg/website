<?php

function create_form_items ($values, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts =
        compressed_js_script('dateField', "$base../../")
        .compressed_js_script('flexTextarea', "$base../../")
        .compressed_js_script('formCheckbox', "$base../../");

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = Contacts\maxLengths();

    include_once "$fnsDir/Email/maxLength.php";
    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Form/textfieldWithLabel.php";
    include_once "$fnsDir/Form/timezoneSelect.php";
    include_once "$fnsDir/FullName/maxLength.php";
    return
        Form\textfield('full_name', 'Full name', [
            'value' => $values['full_name'],
            'maxlength' => FullName\maxLength(),
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('alias', 'Alias', [
            'value' => $values['alias'],
            'maxlength' => $maxLengths['alias'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('address', 'Address', [
            'value' => $values['address'],
            'maxlength' => $maxLengths['address'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
        ])
        .'<div class="hr"></div>'
        .Form\textfieldWithLabel('phone1', 'Phone 1', [
            'value' => $values['phone1'],
            'maxlength' => $maxLengths['phone1'],
        ], [
            'value' => $values['phone1_label'],
            'placeholder' => 'e.g. Home',
            'maxlength' => $maxLengths['phone1_label'],
        ])
        .'<div class="hr"></div>'
        .Form\textfieldWithLabel('phone2', 'Phone 2', [
            'value' => $values['phone2'],
            'maxlength' => $maxLengths['phone2'],
        ], [
            'value' => $values['phone2_label'],
            'maxlength' => $maxLengths['phone2_label'],
            'placeholder' => 'e.g. Work',
        ])
        .'<div class="hr"></div>'
        .Form\datefield([
            'name' => 'birthday_day',
            'value' => $values['birthday_day'],
        ], [
            'name' => 'birthday_month',
            'value' => $values['birthday_month'],
        ], [
            'name' => 'birthday_year',
            'value' => $values['birthday_year'],
        ], 'Birth date', false, true)
        .'<div class="hr"></div>'
        .Form\textfield('username', 'Zvini username', [
            'value' => $values['username'],
            'maxlength' => $maxLengths['username'],
        ])
        .'<div class="hr"></div>'
        .Form\timezoneSelect('timezone', 'Timezone',
            $values['timezone'], true)
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\textarea('notes', 'Notes', [
            'value' => $values['notes'],
            'maxlength' => $maxLengths['notes'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('favorite', 'Mark as favorite', $values['favorite']);

}
