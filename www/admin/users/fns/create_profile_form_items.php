<?php

function create_profile_form_items ($values, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('formCheckbox', '../../../');

    include_once "$fnsDir/Users/emailExpireDays.php";
    include_once "$fnsDir/Users/expireDays.php";
    $expireDays = Users\emailExpireDays() + Users\expireDays();

    include_once "$fnsDir/Email/maxLength.php";
    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/timezoneSelect.php";
    include_once "$fnsDir/FullName/maxLength.php";
    return
        Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
            'autofocus' => $values['focus'] === 'email',
        ])
        .Form\notes(['Optional. Used for password recovery.'])
        .'<div class="hr"></div>'
        .Form\textfield('full_name', 'Full name', [
            'value' => $values['full_name'],
            'maxlength' => FullName\maxLength(),
        ])
        .'<div class="hr"></div>'
        .Form\timezoneSelect('timezone', 'Timezone', $values['timezone'])
        .'<div class="hr"></div>'
        .Form\checkbox('admin', 'Administrator', $values['admin'])
        .'<div class="hr"></div>'
        .Form\checkbox('disabled', 'Disable', $values['disabled'])
        .'<div class="hr"></div>'
        .Form\checkbox('expires', 'Expire when inactive', $values['expires'])
        .Form\notes([
            'If checked the user will expire'
            ." after $expireDays days of inactivity.",
        ]);

}
