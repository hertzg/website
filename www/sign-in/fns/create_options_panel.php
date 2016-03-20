<?php

function create_options_panel ($return) {

    $fnsDir = __DIR__.'/../../fns';

    if ($return === '') $queryString = '';
    else $queryString = '?return='.rawurlencode($return);

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $content = Page\imageArrowLinkWithDescription(
        'Forgot password?', 'Reset your account password here.',
        "../email-reset-password/$queryString", 'reset-password',
        [
            'id' => 'email-reset-password',
            'localNavigation' => true,
        ]
    );

    include_once "$fnsDir/SignUpEnabled/get.php";
    if (SignUpEnabled\get()) {
        include_once "$fnsDir/Page/imageLinkWithDescription.php";
        $content .= '<div class="hr"></div>'
            .Page\imageLinkWithDescription("Don't have an account?",
                'Create an account here.', "../sign-up/$queryString",
                'new-password', ['localNavigation' => true]);
    }

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Options', $content);

}
