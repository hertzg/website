<?php

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('close-account/index_errors');

if (array_key_exists('close-account/index_errors', $_SESSION)) {
    include_once '../fns/Page/errors.php';
    $pageErrors = Page\errors($_SESSION['close-account/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['account/index_messages']);

include_once '../fns/Page/warnings.php';
$pageWarnings = Page\warnings(array(
    'Are you sure you want to close your account?',
    ' You will lose all your data.',
));

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/password.php';
$content = create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Close',
        $pageErrors
        .$pageWarnings
        .'<form action="submit.php" method="post">'
            .Form\password('password', 'Password', array(
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Close Account')
        .'</form>'
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Close Account', $content, '../');
