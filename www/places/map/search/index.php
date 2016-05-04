<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_places.php';
$user = require_places('../');
$id_users = $user->id_users;

$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
request_valid_keyword_tag_offset($keyword, $tag, $offset, $includes, $excludes);

include_once '../../../lib/mysqli.php';

if ($tag === '') {
    include_once "$fnsDir/Places/search.php";
    $places = Places\search($mysqli, $id_users, $includes, $excludes);
} else {
    include_once "$fnsDir/PlaceTags/searchOnUserTagName.php";
    $places = PlaceTags\searchOnUserTagName($mysqli,
        $id_users, $includes, $excludes, $tag);
}

include_once '../fns/create_map.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/create.php";
$content = \Page\create(
    [
        'title' => 'Places',
        'href' => '../'.ItemList\listHref(),
    ],
    'Map',
    create_map($places, '../'),
    create_new_item_button('Place', '../../')
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Places Map', $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="../index.css?1" />',
]);
