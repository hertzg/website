<?php

namespace ViewPage;

function optionsPanel ($task) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($task->id_tasks);

    include_once "$fnsDir/Page/imageArrowLink.php";

    $href = "../edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit', $href, 'edit-task');

    $href = "../send/$escapedItemQuery";
    $sendLink = \Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/$escapedItemQuery";
    $deleteLink = \Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        \Page\staticTwoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        ."<div id=\"deleteLink\">$deleteLink</div>";

    include_once "$fnsDir/create_panel.php";
    return create_panel('Task Options', $content);

}
