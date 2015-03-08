<?php

include_once '../fns/require_places.php';
$user = require_places();
$id_users = $user->id_users;

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($tag) = request_strings('tag');

include_once '../../lib/mysqli.php';

if ($tag === '') {
    include_once "$fnsDir/Places/indexOnUser.php";
    $places = Places\indexOnUser($mysqli, $id_users);
} else {
    include_once "$fnsDir/PlaceTags/indexOnUserTagName.php";
    $places = PlaceTags\indexOnUserTagName($mysqli, $id_users, $tag);
}

include_once 'fns/create_map.php';
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
    create_map($places),
    create_new_item_button('Place', '../')
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Places Map', $content, '../../');
