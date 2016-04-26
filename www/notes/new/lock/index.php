<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();

$key = 'notes/new/lock/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['password' => ''];

$fnsDir = '../../../fns';

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/ItemList/escapedPageQuery.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/phishingWarning.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/warnings.php";
include_once "$fnsDir/Session/EncryptionKey/minutes.php";
$content = Page\create(
    [
        'title' => 'New Note',
        'href' => '../'.ItemList\escapedPageQuery(),
    ],
    'Password-protect',
    Page\sessionErrors('notes/new/lock/errors')
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
        .Page\phishingWarning()
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Password-protect New Note', $content, '../../../');
