<?php

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/filefield.php';
include_once '../../../fns/ItemList/escapedItemQuery.php';
include_once '../../../fns/ItemList/listHref.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../'.ItemList\listHref(),
        ],
        [
            'title' => "Contact #$id",
            'href' => '../../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Edit Photo',
    '<form action="submit.php" method="post">'
        .Form\filefield('file', 'Select a file', ['required' => true])
        .'<div class="hr"></div>'
        .Form\button('Upload Photo')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Edit Contact Photo', $content, '../../../');
