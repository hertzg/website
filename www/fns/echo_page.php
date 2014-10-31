<?php

function echo_page ($user, $title, $content, $base, $options = []) {

    if ($user) $theme = $user->theme;
    else {
        include_once __DIR__.'/Themes/getDefault.php';
        $theme = Themes\getDefault();
    }

    if (array_key_exists('head', $options)) $head = $options['head'];
    else $head = '';

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
    if ($user) {
        $timezone = $user->timezone;
        $time += $timezone * 60 * 1000;
    } else {
        $timezone = 0;
    }

    $topLinkHref = $base === '' ? './' : $base;

    include_once __DIR__.'/compressed_js_script.php';
    $body =
        '<div id="tbar">'
            ."<a class=\"topLink logoLink\" href=\"$topLinkHref\">"
                ."<img src=\"{$base}themes/$theme/images/zvini.svg?2\""
                .' alt="Zvini" width="68" height="32" class="logoImg" />'
            .'</a>'
            .'<div class="page-clockWrapper">'
                .'<div id="staticClockWrapper">'
                    .date('H:i', $time / 1000)
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
                .'var signOutHref = '.json_encode("{$base}sign-out/submit.php")
            .'</script>'
            .compressed_js_script('signOutConfirm', $base);

        include_once __DIR__.'/compressed_css_link.php';
        $head .= compressed_css_link('confirmDialog', $base);

    }

    include_once __DIR__.'/../fns/echo_html.php';
    echo_html($title, $head, $body, $theme, $base, ['head' => $head]);

}
