<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$key = 'bookmarks/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = (array)$bookmark;
}

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages']
);

include_once '../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once '../../fns/build_item_query_string.php';
include_once '../../fns/create_list_href.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => create_list_href(),
        ],
        [
            'title' => "Bookmark #$id",
            'href' => '../view/?'.build_item_query_string($id),
        ],
    ],
    'Edit',
    Page\sessionErrors('bookmarks/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('url', 'URL', [
            'value' => $values['url'],
            'maxlength' => $maxLengths['url'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('title', 'Title', [
            'maxlength' => $maxLengths['title'],
            'value' => $values['title'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'maxlength' => $maxLengths['tags'],
            'value' => $values['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Bookmark #$id", $content, '../../');
