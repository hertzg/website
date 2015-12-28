<?php

namespace ViewPage;

function create ($task, $user, &$scripts) {

    $id = $task->id;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/create_text_item.php";
    $items = [create_text_item($task->text, $base)];

    $deadline_time = $task->deadline_time;
    if ($deadline_time !== null) {

        include_once "$fnsDir/user_time_today.php";
        $timeToday = user_time_today($user);

        include_once "$fnsDir/format_deadline.php";
        $items[] = \Page\text('Deadline '.date('F j, Y', $deadline_time)
            .' ('.format_deadline($deadline_time, $timeToday).')');

    }

    if ($task->num_tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', json_decode($task->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $author = format_author($task->insert_time, $task->insert_api_key_name);
    $infoText =
        ($task->top_priority ? 'Top' : 'Normal').' priority task.<br />'
        ."Task created $author.";
    if ($task->revision) {
        $author = format_author($task->update_time, $task->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    unset(
        $_SESSION['tasks/edit/errors'],
        $_SESSION['tasks/edit/values'],
        $_SESSION['tasks/errors'],
        $_SESSION['tasks/messages'],
        $_SESSION['tasks/new/errors'],
        $_SESSION['tasks/new/values'],
        $_SESSION['tasks/send/errors'],
        $_SESSION['tasks/send/messages'],
        $_SESSION['tasks/send/values']
    );

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Tasks',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Task #$id",
            \Page\sessionMessages('tasks/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Task', '../')
        )
        .optionsPanel($task);

}
