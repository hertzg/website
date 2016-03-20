<?php

function create_view_page ($point, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $point->id;
    $id_places = $point->id_places;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);
    $placeEscapedItemQuery = ItemList\escapedItemQuery($id_places);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-point', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = Page\imageLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['places/all-points/edit/errors'],
        $_SESSION['places/all-points/edit/values'],
        $_SESSION['places/all-points/messages'],
        $_SESSION['places/all-points/new/errors'],
        $_SESSION['places/all-points/new/values']
    );

    include_once __DIR__.'/../../fns/ViewPointPage/viewContent.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'All Points',
                'href' => "../$placeEscapedItemQuery#$id",
            ],
            "Point #$id",
            Page\sessionMessages('places/all-points/view/messages')
            .ViewPointPage\viewContent($point, $scripts, '../'),
            Page\newItemButton("../new/$placeEscapedItemQuery", 'point')
        )
        .Page\panel('Point Options', $optionsContent);

}
