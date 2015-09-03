<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$key = 'notes/edit/password-protect/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['password' => ''];

$fnsDir = '../../../fns';

include_once "$fnsDir/phishing_warning.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'Edit',
            'href' => '../'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Password-protect',
    Page\sessionErrors('notes/edit/password-protect/errors')
    .Page\warnings([
        'To password-protect the note your account password is needed.',
    ])
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Password-protect Note')
        .phishing_warning()
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Password-protect Note #$id", $content, '../../../');
