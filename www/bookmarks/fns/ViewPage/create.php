<?php

namespace ViewPage;

function create ($mysqli, $user, $bookmark, $addition = '') {

    $id = $bookmark->id_bookmarks;
    $url = $bookmark->url;
    $fnsDir = __DIR__.'/../../../fns';

    $items = [];

    include_once "$fnsDir/Page/text.php";

    $title = $bookmark->title;
    if ($title !== '') {

        include_once "$fnsDir/request_strings.php";
        list($keyword) = request_strings('keyword');

        include_once "$fnsDir/str_collapse_spaces.php";
        $keyword = str_collapse_spaces($keyword);

        $title = htmlspecialchars($title);

        if ($keyword !== '') {
            $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
        }

        $items[] = \Page\text($title);

    }

    $items[] = \Page\text(htmlspecialchars($url));

    include_once "$fnsDir/BookmarkTags/indexOnBookmark.php";
    $tags = \BookmarkTags\indexOnBookmark($mysqli, $id);
    if ($tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', $tags);
    }

    $insert_time = $bookmark->insert_time;
    $update_time = $bookmark->update_time;
    include_once "$fnsDir/date_ago.php";
    $text = '<div>Bookmark created '.date_ago($insert_time).'.</div>';
    if ($insert_time != $update_time) {
        $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
    }
    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText($text);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Bookmarks',
                    'href' => \ItemList\listHref(),
                ],
            ],
            "Bookmark #$id",
            \Page\sessionMessages('bookmarks/view/messages')
            .join('<div class="hr"></div>', $items)
            .$infoText,
            create_new_item_button('Bookmark', '../')
        )
        .optionsPanel($bookmark)
        .$addition;

}
