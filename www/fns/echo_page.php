<?php

function echo_page ($user, $title, $content, $base, $options = []) {

    if ($user) $theme = $user->theme;
    else {
        include_once __DIR__.'/Themes/getDefault.php';
        $theme = Themes\getDefault();
    }

    if (array_key_exists('head', $options)) $head = $options['head'];
    else $head = '';

    if (array_key_exists('scripts', $options)) $scripts = $options['scripts'];
    else $scripts = '';

    if ($user) {
        $signOutLink =
            '<div class="pageTopRightLinks">'
                .'<a id="signOutLink" class="topLink"'
                ." href=\"{$base}sign-out/\">"
                    .'Sign Out'
                .'</a>'
            .'</div>';
    } else {
        $signOutLink = '';
    }

    $time = floor(microtime(true) * 1000);
    $notifications = '';
    if ($user) {

        $timezone = $user->timezone;
        $time += $timezone * 60 * 1000;

        $home_num_new_notifications = $user->home_num_new_notifications;
        if ($home_num_new_notifications) {
            $notifications =
                '<span class="logoLink-notifications">'
                    .'<span class="zeroSize"> (</span>'
                    .$home_num_new_notifications
                    .'<span class="zeroSize">)</span>'
                .'</span>';
        }

    } else {
        $timezone = 0;
    }

    $topLinkHref = $base === '' ? './' : $base;

    include_once __DIR__.'/get_revision.php';
    $logoSrc = "{$base}themes/$theme/images/zvini.svg?"
        .get_revision("themes/$theme/images/zvini.svg");

    include_once __DIR__.'/compressed_js_script.php';
    $body =
        '<div id="tbar">'
            ."<a class=\"topLink logoLink\" href=\"$topLinkHref\">"
                ."<img src=\"$logoSrc\" alt=\"Zvini\""
                .' width="68" height="32" class="logoLink-img" />'
                .$notifications
            .'</a>'
            .'<div class="page-clockWrapper">'
                .'<div id="staticClockWrapper">'
                    .date('H:i:s', $time / 1000)
                .'</div>'
                .'<div id="dynamicClockWrapper"></div>'
                .'<div id="batteryWrapper"></div>'
            .'</div>'
            .$signOutLink
        .'</div>'
        .$content
        .'<div id="bbar"></div>'
        .'<script type="text/javascript">'
            ."var time = $time\n"
            ."var timezone = $timezone\n"
            ."var base = ".json_encode($base)
        .'</script>'
        .compressed_js_script('batteryAndClock', $base)
        .compressed_js_script('lineSizeRounding', $base);

    if ($user) {

        include_once __DIR__.'/get_sign_out_timeout.php';
        $body .=
            compressed_js_script('confirmDialog', $base)
            .'<script type="text/javascript">'
                .'var signOutTimeout = '.get_sign_out_timeout().';'
            .'</script>'
            .compressed_js_script('signOutConfirm', $base);

        if (!array_key_exists('token', $_SESSION)) {
            $body .= compressed_js_script('sessionTimeout', $base);
        }

        include_once __DIR__.'/compressed_css_link.php';
        $head .= compressed_css_link('confirmDialog', $base);

    }

    $body .= $scripts;

    include_once __DIR__.'/../fns/echo_html.php';
    echo_html($title, $head, $body, $theme, $base, ['head' => $head]);

}
