<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

$key = 'help/feedback/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['text' => ''];

unset($_SESSION['help/messages']);

include_once "$fnsDir/Feedbacks/maxLengths.php";
$maxLengths = Feedbacks\maxLengths();

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/textarea.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Help',
        'href' => '../#feedback',
    ],
    'Feedback',
    Page\sessionErrors('help/feedback/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Submit Feedback')
    .'</form>'
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Leave Feedback', $content, $base, [
    'scripts' => compressed_js_script('flexTextarea', $base),
]);
