<?php

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

$key = 'bookmarks/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = (array)$receivedBookmark;
}

include_once '../../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Received Bookmark #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit and Import',
    Page\sessionErrors('bookmarks/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('url', 'URL', [
            'value' => $values['url'],
            'maxlength' => $maxLengths['url'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('title', 'Title', [
            'value' => $values['title'],
            'maxlength' => $maxLengths['title'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Import Bookmark')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Received Bookmark #$id", $content, '../../../');
