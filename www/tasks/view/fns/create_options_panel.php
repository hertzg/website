<?php

function create_options_panel ($task) {

    include_once __DIR__.'/../../../fns/ItemList/escapedItemQuery.php';
    $queryString = ItemList\escapedItemQuery($task->id_tasks);

    include_once __DIR__.'/../../../fns/Page/imageArrowLink.php';

    $href = "../edit/$queryString";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-task');

    $href = "../send/$queryString";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once __DIR__.'/../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once __DIR__.'/../../../fns/create_panel.php';
    return create_panel('Task Options', $content);

}
