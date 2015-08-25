<?php

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();

$key = 'notes/new/encrypt/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['password' => ''];

$fnsDir = '../../../fns';

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/ItemList/escapedPageQuery.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
    [
        [
            'title' => 'New Note',
            'href' => '../'.ItemList\escapedPageQuery(),
        ],
    ],
    'Encrypt',
    Page\sessionErrors('notes/new/encrypt/errors')
    .Page\warnings([
        'To password-protect the note you should enter your account password.',
    ])
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Password-protect Note')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Encrypt New Note', $content, '../../../');
