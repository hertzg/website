<?php

namespace ViewPage;

function create ($bookmark, &$scripts) {

    $id = $bookmark->id;
    $url = $bookmark->url;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

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

    if ($bookmark->num_tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', json_decode($bookmark->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $api_key_name = $bookmark->insert_api_key_name;
    $author = format_author($bookmark->insert_time, $api_key_name);
    $infoText = "Bookmark created $author.";
    if ($bookmark->revision) {
        $api_key_name = $bookmark->update_api_key_name;
        $author = format_author($bookmark->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Bookmarks',
                    'href' => \ItemList\listHref()."#$id",
                ],
            ],
            "Bookmark #$id",
            \Page\sessionMessages('bookmarks/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Bookmark', '../')
        )
        .optionsPanel($bookmark);

}
