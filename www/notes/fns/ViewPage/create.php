<?php

namespace ViewPage;

function create ($mysqli, $note) {

    $id = $note->id_notes;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/create_text_item.php";
    $items = [create_text_item($note->text, '../../')];

    include_once "$fnsDir/NoteTags/indexOnNote.php";
    $tags = \NoteTags\indexOnNote($mysqli, $id);
    if ($tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', $tags);
    }

    $insert_time = $note->insert_time;
    $update_time = $note->update_time;
    include_once "$fnsDir/date_ago.php";
    $text = '<div>Note created '.date_ago($insert_time).'.</div>';
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
                    'title' => 'Notes',
                    'href' => \ItemList\listHref(),
                ],
            ],
            "Note #$id",
            \Page\sessionMessages('notes/view/messages')
            .join('<div class="hr"></div>', $items)
            .$infoText,
            create_new_item_button('Note', '../')
        )
        .optionsPanel($id);

}
