<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$key = 'contacts/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    $birth_time = $contact->birth_time;
    if ($birth_time === null) {
        $birth_day = $birth_month = $birth_year = 0;
    } else {
        $birth_day = date('d', $birth_time);
        $birth_month = date('n', $birth_time);
        $birth_year = date('Y', $birth_time);
    }

    $values = [
        'full_name' => $contact->full_name,
        'alias' => $contact->alias,
        'address' => $contact->address,
        'email' => $contact->email,
        'phone1' => $contact->phone1,
        'phone2' => $contact->phone2,
        'birth_day' => $birth_day,
        'birth_month' => $birth_month,
        'birth_year' => $birth_year,
        'username' => $contact->username,
        'tags' => $contact->tags,
        'favorite' => $contact->favorite,
    ];

}

unset($_SESSION['contacts/view/messages']);

include_once '../../fns/Contacts/maxLengths.php';
$maxLengths = Contacts\maxLengths();

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/datefield.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Username/maxLength.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => ItemList\listHref(),
        ],
        [
            'title' => "Contact #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Edit',
    Page\sessionErrors('contacts/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('full_name', 'Full name', [
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
            'name' => 'birth_day',
            'value' => $values['birth_day'],
        ], [
            'name' => 'birth_month',
            'value' => $values['birth_month'],
        ], [
            'name' => 'birth_year',
            'value' => $values['birth_year'],
        ], 'Birth date', false, true)
        .'<div class="hr"></div>'
        .Form\textfield('username', 'Zvini username', [
            'value' => $values['username'],
            'maxlength' => $maxLengths['username'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Contact #$id", $content, '../../');
