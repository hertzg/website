<?php

function create_permission_fields ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/infoText.php";
    $html = Page\infoText('Permissions:');

    $options = [
        'none' => 'None',
        'readonly' => 'Read-only',
        'readwrite' => 'Read and write',
    ];

    include_once "$fnsDir/Form/select.php";
    $name = 'invitation_access';
    $html .= Form\select($name, 'Invitations', $options, $values[$name]);

    $add = function ($name, $title) use (&$html, $options, $values) {
        $html .=
            '<div class="hr"></div>'
            .Form\select($name, $title, $options, $values[$name]);
    };

    $add('user_access', 'Users');

    return $html;

}
