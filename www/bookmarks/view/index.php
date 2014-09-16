<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values'],
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages'],
    $_SESSION['bookmarks/send/values']
);

$url = $bookmark->url;

$items = [];

include_once '../../fns/Page/text.php';

$title = $bookmark->title;
if ($title !== '') {

    include_once '../../fns/request_strings.php';
    list($keyword) = request_strings('keyword');

    include_once '../../fns/str_collapse_spaces.php';
    $keyword = str_collapse_spaces($keyword);

    $title = htmlspecialchars($title);

    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
    }

    $items[] = Page\text($title);

}

$items[] = Page\text(htmlspecialchars($url));

include_once '../../fns/BookmarkTags/indexOnBookmark.php';
$tags = BookmarkTags\indexOnBookmark($mysqli, $id);
if ($tags) {
    include_once '../../fns/Page/tags.php';
    $items[] = Page\tags('../', $tags);
}

$insert_time = $bookmark->insert_time;
$update_time = $bookmark->update_time;
include_once '../../fns/date_ago.php';
$text = '<div>Bookmark created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/infoText.php';
$infoText = Page\infoText($text);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once 'fns/create_options_panel.php';
include_once '../../fns/create_new_item_button.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => 'Bookmarks',
                'href' => ItemList\listHref(),
            ],
        ],
        "Bookmark #$id",
        Page\sessionMessages('bookmarks/view/messages')
        .join('<div class="hr"></div>', $items)
        .$infoText,
        create_new_item_button('Bookmark', '../')
    )
    .create_options_panel($bookmark)
    .'<script type="text/javascript" defer="defer"'
    .' src="../../js/confirmDialog.js"></script>'
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once '../../fns/echo_page.php';
echo_page($user, "Bookmark #$id", $content, '../../');
