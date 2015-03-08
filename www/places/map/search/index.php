<?php

include_once '../../fns/require_places.php';
$user = require_places();
$id_users = $user->id_users;

$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once '../../../lib/mysqli.php';

if ($tag === '') {
    include_once "$fnsDir/Places/search.php";
    $places = Places\search($mysqli, $id_users, $keyword);
} else {
    // TODO
}

include_once '../fns/create_map.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/tabs.php";
$content = \Page\tabs(
    [
        [
            'title' => 'Places',
            'href' => '../'.ItemList\listHref(),
        ],
    ],
    'Map',
    create_map($places),
    create_new_item_button('Place', '../../')
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Places Map', $content, '../../../');
