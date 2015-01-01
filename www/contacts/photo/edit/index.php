<?php

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

unset($_SESSION['contacts/view/messages']);

include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/filefield.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/ItemList/escapedItemQuery.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => "Contact #$id",
            'href' => '../../view/'.ItemList\escapedItemQuery($id).'#edit-photo',
        ],
    ],
    'Edit Photo',
    Page\sessionErrors('contacts/photo/edit/errors')
    .'<form action="submit.php" method="post" enctype="multipart/form-data">'
        .Form\filefield('file', 'Photo file', [
            'required' => true,
            'accept' => 'image/*',
        ])
        .'<div class="hr"></div>'
        .Form\button('Upload Photo')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Edit Contact Photo', $content, '../../../');
