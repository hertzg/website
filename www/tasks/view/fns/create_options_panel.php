<?php

function create_options_panel ($task) {

    $id = $task->id_tasks;

    include_once __DIR__.'/../../../fns/Page/imageLink.php';
    if ($task->top_priority) {
        $title = 'Mark as Normal Priority';
        $href = "submit-set-normal-priority.php?id=$id";
        $priorityLink = Page\imageLink($title, $href, 'task');
    } else {
        $title = 'Mark as Top Priority';
        $href = "submit-set-top-priority.php?id=$id";
        $priorityLink = Page\imageLink($title, $href, 'task-top-priority');
    }

    include_once __DIR__.'/../../../fns/ItemList/escapedItemQuery.php';
    $queryString = ItemList\escapedItemQuery($id);

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';

    $href = "../edit/$queryString";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-task');

    $href = "../send/$queryString";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($priorityLink, $editLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($sendLink, $deleteLink);

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Task Options', $content);

}
