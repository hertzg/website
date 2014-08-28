<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$key = 'bookmarks/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$bookmark;

unset(
    $_SESSION['bookmarks/edit/send/errors'],
    $_SESSION['bookmarks/edit/send/messages'],
    $_SESSION['bookmarks/edit/send/values'],
    $_SESSION['bookmarks/view/messages']
);

include_once '../../fns/Bookmarks/maxLengths.php';
$maxLengths = Bookmarks\maxLengths();

include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => ItemList\listHref(),
        ],
        [
            'title' => "Bookmark #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
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
        .Page\staticTwoColumns(
            Form\button('Save Changes'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Bookmark #$id", $content, '../../');
