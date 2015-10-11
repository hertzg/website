<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$key = 'files/rename-file/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $file->name];

unset(
    $_SESSION['files/view-file/errors'],
    $_SESSION['files/view-file/messages']
);

$fnsDir = '../../fns';

include_once "$fnsDir/FileName/maxLength.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "File #$id",
            'href' => "../view-file/?id=$id#rename",
        ],
    ],
    'Rename',
    Page\sessionErrors('files/rename-file/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'File name', [
            'value' => $values['name'],
            'maxlength' => FileName\maxLength(),
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Rename'),
            Form\button('Send', 'sendButton')
        )
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Rename File #$id", $content, '../../');
