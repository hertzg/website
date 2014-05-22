<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

unset($_SESSION['notes/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/Page/imageLink.php';
$href = "submit.php$escapedItemQuery";
$yesLink = Page\imageLink('Yes, delete note', $href, 'yes');

$noLink = Page\imageLink('No, return back', "../view/$escapedItemQuery", 'no');

include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Notes',
            'href' => ItemList\listHref(),
        ],
    ],
    "Note #$id",
    Page\text('Are you sure you want to delete the note?')
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Note #$id?", $content, '../../');
