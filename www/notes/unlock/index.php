<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$key = 'notes/unlock/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['password' => ''];

$fnsDir = '../../fns';

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/ItemList/itemQuery.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Note #$id",
            'href' => '../view/'.ItemList\itemQuery($id).'#unlock',
        ],
    ],
    'Unlock',
    Page\sessionErrors('notes/unlock/errors')
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Unlock Note')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Unlock Note #$id", $content, '../../');
