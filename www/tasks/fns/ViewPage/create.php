<?php

namespace ViewPage;

function create ($task, $user) {

    $id = $task->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/create_text_item.php";
    $items = [create_text_item($task->text, '../../')];

    $deadline_time = $task->deadline_time;
    if ($deadline_time !== null) {

        include_once "$fnsDir/user_time_today.php";
        $timeToday = user_time_today($user);

        include_once "$fnsDir/format_deadline.php";
        $items[] = \Page\text('Deadline '.date('F d, Y', $deadline_time)
            .' ('.format_deadline($deadline_time, $timeToday).')');

    }

    if ($task->num_tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', json_decode($task->tags_json));
    }

    $insert_time = $task->insert_time;
    $update_time = $task->update_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $task->insert_api_key_name);
    $infoText =
        ($task->top_priority ? 'Top' : 'Normal').' priority task.<br />'
        ."Task created $author.";
    if ($insert_time != $update_time) {
        $author = format_author($update_time, $task->update_api_key_name);
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
                    'title' => 'Tasks',
                    'href' => \ItemList\listHref(),
                ],
            ],
            "Task #$id",
            \Page\sessionMessages('tasks/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Task', '../')
        )
        .optionsPanel($task);

}
