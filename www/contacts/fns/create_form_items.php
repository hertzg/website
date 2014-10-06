<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = Contacts\maxLengths();

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Form/timezoneSelect.php";
    return
        Form\textfield('full_name', 'Full name', [
            'value' => $values['full_name'],
            'maxlength' => $maxLengths['full_name'],
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
            'maxlength' => $maxLengths['email'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('phone1', 'Phone 1', [
            'value' => $values['phone1'],
            'maxlength' => $maxLengths['phone1'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('phone2', 'Phone 2', [
            'value' => $values['phone2'],
            'maxlength' => $maxLengths['phone2'],
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
        .Form\checkbox('favorite', 'Mark as Favorite', $values['favorite']);

}
