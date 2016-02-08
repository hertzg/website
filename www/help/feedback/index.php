<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

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
        'localNavigation' => true,
    ],
    'Feedback',
    Page\sessionErrors('help/feedback/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'maxlength' => $maxLengths['text'],
            'required' => true,
            'autofocus' => true,
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
