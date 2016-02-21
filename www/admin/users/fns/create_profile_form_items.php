<?php

function create_profile_form_items ($values, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('formCheckbox', '../../../');

    include_once "$fnsDir/Users/emailExpireDays.php";
    include_once "$fnsDir/Users/expireDays.php";
    $expireDays = Users\emailExpireDays() + Users\expireDays();

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/notes.php";
    return
        Form\checkbox('admin', 'Administrator', $values['admin'])
        .'<div class="hr"></div>'
        .Form\checkbox('disabled', 'Disable', $values['disabled'])
        .'<div class="hr"></div>'
        .Form\checkbox('expires', 'Expire when inactive', $values['expires'])
        .Form\notes([
            'If checked the user will expire'
            ." after $expireDays days of inactivity.",
        ]);

}
