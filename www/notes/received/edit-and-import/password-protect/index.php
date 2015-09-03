<?php

include_once 'fns/require_stage.php';
include_once '../../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$key = 'notes/received/edit-and-import/password-protect/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['password' => ''];

$fnsDir = '../../../../fns';

include_once "$fnsDir/phishing_warning.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
include_once "$fnsDir/Session/EncryptionKey/minutes.php";
$content = Page\tabs(
    [
        [
            'title' => 'Edit and Import',
            'href' => '../'.ItemList\Received\itemQuery($id),
        ],
    ],
    'Password-protect',
    Page\sessionErrors('notes/received/edit-and-import/password-protect/errors')
    .Page\warnings([
        'To password-protect the note your account password is needed.',
    ])
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => true,
        ])
        .Form\notes(['The authentication will last for '
            .Session\EncryptionKey\minutes().' minutes.'])
        .'<div class="hr"></div>'
        .Form\button('Password-protect Note')
        .phishing_warning()
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Password-protect Imported Note', $content, '../../../../');
