<?php

include_once '../fns/require_places.php';
$user = require_places();
$id_users = $user->id_users;

$fnsDir = '../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once "$fnsDir/Paging/limit.php";
$limit = \Paging\limit();

include_once '../../lib/mysqli.php';

if ($keyword === '') {
    if ($tag === '') {
        include_once "$fnsDir/Places/indexPageOnUser.php";
        $places = Places\indexPageOnUser($mysqli,
            $id_users, $offset, $limit, $total);
    } else {
        include_once "$fnsDir/PlaceTags/indexOnTagName.php";
        $places = PlaceTags\indexOnTagName($mysqli,
            $id_users, $tag, $offset, $limit, $total);
    }
} else {
    if ($tag === '') {
        include_once "$fnsDir/Places/searchPage.php";
        $places = \Places\searchPage($mysqli,
            $id_users, $keyword, $offset, $limit, $total);
    } else {
        include_once "$fnsDir/PlaceTags/searchOnTagName.php";
        $places = \PlaceTags\searchOnTagName($mysqli,
            $id_users, $keyword, $tag, $offset, $limit, $total);
    }
}

include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/tabs.php";
$content = \Page\tabs(
    [
        [
            'title' => 'Places',
            'href' => ItemList\listHref(),
        ],
    ],
    'Map',
    '<div style="height: 400px">'
    .'</div>'
    .'<script type="text/javascript">'
        .'var places = '.json_encode(array_map(function ($place) {
            return [
                'latitude' => $place->latitude,
                'longitude' => $place->longitude,
            ];
        }, $places))
    .'</script>',
    create_new_item_button('Place', '../')
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Places Map', $content, '../../');
