<?php

namespace ViewPage;

function optionsPanel ($bar_chart) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($bar_chart->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-bar-chart', ['id' => 'edit']);

    $deleteLink = \Page\imageArrowLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = \Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bar Chart Options', $content);

}
