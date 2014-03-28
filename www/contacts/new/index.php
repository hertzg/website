<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (array_key_exists('contacts/new/values', $_SESSION)) {
    $values = $_SESSION['contacts/new/values'];
} else {
    $values = [
        'full_name' => '',
        'alias' => '',
        'address' => '',
        'email' => '',
        'phone1' => '',
        'phone2' => '',
        'tags' => '',
    ];
}

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Contacts',
                'href' => '..',
            ],
        ],
        'New',
        Page\sessionErrors('contacts/new/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('full_name', 'Full name', [
                'value' => $values['full_name'],
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('alias', 'Alias', [
                'value' => $values['alias'],
                'maxlength' => 32,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('address', 'Address', [
                'value' => $values['address'],
                'maxlength' => 128,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('email', 'Email', [
                'value' => $values['email'],
                'maxlength' => 32,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('phone1', 'Phone 1', [
                'value' => $values['phone1'],
                'maxlength' => 32,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('phone2', 'Phone 2', [
                'value' => $values['phone2'],
                'maxlength' => 32,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', [
                'value' => $values['tags'],
            ])
            .'<div class="hr"></div>'
            .Form\button('Save Contact')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Contact', $content, $base);
