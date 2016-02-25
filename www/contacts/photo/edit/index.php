<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

unset($_SESSION['contacts/view/messages']);

$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/filefield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Contact #$id",
        'href' => "../../view/$escapedItemQuery#edit-photo",
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
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Edit Contact Photo', $content, '../../../');
