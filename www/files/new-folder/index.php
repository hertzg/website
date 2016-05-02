<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);

$key = 'files/new-folder/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

$fnsDir = '../../fns';

include_once '../fns/create_file_location_bar.php';
include_once '../fns/create_folder_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '../../home/#files',
        'localNavigation' => true,
    ],
    'New Folder',
    create_file_location_bar($mysqli,
        'new-folder', $parent_id, $user->id_users)
    .Page\sessionErrors('files/new-folder/errors')
    .'<form action="submit.php" method="post">'
        .create_folder_form_items($values)
        .Form\button('Create')
        .Form\hidden('parent_id', $parent_id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Folder', $content, '../../');
