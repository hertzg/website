<?php

function create_page ($mysqli, $user, $place, $base = '') {

    $id = $place->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset("?id=$id");

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/PlacePoints/indexPageOnPlace.php";
    $points = PlacePoints\indexPageOnPlace(
        $mysqli, $id, $offset, $limit, $total);

    $items = [];

    $params = ['id' => $id];

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/render_points.php';
    render_points($points, $items, $base, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['places/all-points/new/errors'],
        $_SESSION['places/all-points/new/values'],
        $_SESSION['places/all-points/view/messages'],
        $_SESSION['places/view/messages']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = Page\imageLink('Delete All Points',
        "{$base}delete-all/$escapedItemQuery",
        'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => "Place #$id",
                'href' => "$base../view/?id=$id#all-points",
            ],
            'All Points',
            Page\sessionMessages('places/all-points/messages')
            .join('<div class="hr"></div>', $items),
            Page\newItemButton("{$base}new/$escapedItemQuery", 'Point')
        )
        .create_panel('Options', $deleteLink);

}
