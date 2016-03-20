<?php

namespace ViewPage;

function optionsPanel ($task) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $task->id;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-task', ['id' => 'edit']);

    $params = ['text' => $task->text];
    $tags = $task->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $deadline_time= $task->deadline_time;
    if ($deadline_time !== null) $params['deadline_time'] = $deadline_time;
    if ($task->top_priority) $params['top_priority'] = '1';
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink('Duplicate', $href, 'duplicate-task');

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    $historyLink = \Page\imageArrowLink('History',
        "../history/?id=$id", 'restore-defaults', ['id' => 'history']);

    $deleteLink = \Page\imageLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once __DIR__.'/../send_via_sms_link.php';
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendLink, send_via_sms_link($task))
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($historyLink, $deleteLink);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Task Options', $content);

}
