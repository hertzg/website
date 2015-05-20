<?php

namespace ViewBarPage;

function create ($bar, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $bar->id;
    $id_bar_charts = $bar->id_bar_charts;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);
    $barChartEscapedItemQuery = \ItemList\escapedItemQuery($id_bar_charts);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit-bar/$escapedItemQuery", 'edit-bar', ['id' => 'edit']);

    $params = [
        'id' => $id_bar_charts,
        'value' => $bar->value,
    ];
    $label = $bar->label;
    if ($label !== '') $params['label'] = $label;
    $href = '../new-bar/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink('Duplicate', $href, 'duplicate-bar');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete-bar/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    unset(
        $_SESSION['bar-charts/edit-bar/errors'],
        $_SESSION['bar-charts/edit-bar/values'],
        $_SESSION['bar-charts/view/messages']
    );

    include_once __DIR__.'/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => "Bar Chart #$id_bar_charts",
                'href' => "../view/$barChartEscapedItemQuery#$id",
            ],
        ],
        "Bar #$id",
        \Page\sessionMessages('bar-charts/view-bar/messages')
        .viewContent($bar, $scripts)
        .create_panel('Bar Options', $optionsContent),
        \Page\newItemButton("../new-bar/$barChartEscapedItemQuery", 'Bar')
    );

}
