<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../classes/Captcha.php';
if (!Captcha::required()) {
    include_once '../../fns/redirect.php';
    redirect('submit.php');
}

include_once '../../lib/page.php';

if (array_key_exists('account/verify-email/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['account/verify-email/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['account/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../classes/Form.php';

$page->base = '../../';
$page->title = 'Verify Email';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => ' &middot;&middot;&middot; ',
                'href' => '../../',
            ),
            array(
                'title' => 'Account',
                'href' => '../',
            ),
        ),
        'Verify Email',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::captcha('../../', true)
            .Form::button('Send Verification Email')
        )
    )
);
