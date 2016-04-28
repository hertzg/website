<?php

namespace ViewPage;

function create ($bar, &$scripts) {

    $fnsDir = __DIR__.'/../../../../fns';
    $id = $bar->id;
    $id_bar_charts = $bar->id_bar_charts;

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/parse_keyword.php";
    parse_keyword($keyword, $includes, $excludes);

    if ($includes) {
        include_once __DIR__.'/markedViewContent.php';
        $viewContent = markedViewContent($bar, $scripts, $includes);
    } else {
        include_once __DIR__.'/../../../fns/ViewBarPage/viewContent.php';
        $viewContent = \ViewBarPage\viewContent($bar, $scripts, '../');
    }

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-bar', ['id' => 'edit']);

    $params = [
        'id' => $id_bar_charts,
        'value' => $bar->value,
    ];
    $label = $bar->label;
    if ($label !== '') $params['label'] = $label;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink('Duplicate', $href, 'duplicate-bar');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = \Page\imageLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    unset(
        $_SESSION['bar-charts/all-bars/edit/errors'],
        $_SESSION['bar-charts/all-bars/edit/values'],
        $_SESSION['bar-charts/all-bars/messages'],
        $_SESSION['bar-charts/all-bars/new/errors'],
        $_SESSION['bar-charts/all-bars/new/values']
    );

    include_once "$fnsDir/ItemList/listHref.php";
    $listHref = \ItemList\listHref('', ['id' => $id_bar_charts]);

    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'All Bars',
                'href' => "../$listHref#$id",
            ],
            "Bar #$id",
            \Page\sessionMessages('bar-charts/all-bars/view/messages')
            .$viewContent,
            \Page\newItemButton(
                '../new/'.\ItemList\escapedItemQuery($id_bar_charts), 'Bar')
        )
        .\Page\panel('Bar Options', $optionsContent);

}
