<?php

include_once '../../../lib/defaults.php';

include_once 'fns/require_locked_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_locked_note($mysqli);

$key = 'notes/unlock/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['password' => ''];

$fnsDir = '../../fns';

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/ItemList/itemQuery.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/phishingWarning.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Session/EncryptionKey/minutes.php";
$content = Page\create(
    [
        'title' => "Note #$id",
        'href' => '../view/'.ItemList\itemQuery($id).'#unlock',
    ],
    'Unlock',
    Page\sessionErrors('notes/unlock/errors')
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => true,
        ])
        .Form\notes(['The authentication will last for '
            .Session\EncryptionKey\minutes().' minutes.'])
        .'<div class="hr"></div>'
        .Form\button('Unlock Note')
        .Page\phishingWarning()
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Unlock Note #$id", $content, '../../');
