<?php

namespace ViewPage;

function create ($note) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/create_text_item.php";
    $items = [create_text_item($note->text, '../../')];

    if ($note->num_tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', json_decode($note->tags_json));
    }

    $insert_time = $note->insert_time;
    $update_time = $note->update_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $note->insert_api_key_name);
    $infoText = "Note created $author.";
    if ($insert_time != $update_time) {
        $author = format_author($update_time, $note->update_api_key_name);
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
                    'title' => 'Notes',
                    'href' => \ItemList\listHref(),
                ],
            ],
            "Note #$note->id",
            \Page\sessionMessages('notes/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Note', '../')
        )
        .optionsPanel($note);

}
