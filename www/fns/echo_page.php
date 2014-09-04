<?php

function echo_page ($user, $title, $content, $base, array $options = []) {

    $theme = $user ? $user->theme : 'orange';

    if (array_key_exists('head', $options)) $head = $options['head'];
    else $head = '';

    if (!$user || array_key_exists('hideSignOutLink', $options)) {
        $signOutLink = '';
    } else {
        $signOutLink =
            '<div class="pageTopRightLinks">'
                .'<a class="topLink"'
                ." href=\"{$base}submit-signout.php\">"
                    .'Sign Out'
                .'</a>'
            .'</div>';
    }

    $time = floor(microtime(true) * 1000);
    if ($user) $time += $user->timezone * 60 * 1000;

    $topLinkHref = $base === '' ? './' : $base;
    $body =
        '<div id="tbar">'
            ."<a class=\"topLink logoLink\" href=\"$topLinkHref\">"
                ."<img src=\"{$base}themes/$theme/images/zvini.svg?2\""
                .' alt="Zvini" width="68" height="32" class="logoImg" />'
            .'</a>'
            .'<div class="page-clockWrapper">'.date('H:i', $time / 1000).'</div>'
            .$signOutLink
        .'</div>'
        .$content
        .'<div id="bbar"></div>'
        .'<script type="text/javascript">'
            ."var time = $time\n"
            ."var base = ".json_encode($base)
        .'</script>'
        .'<script type="text/javascript" async="async"'
        ." src=\"{$base}js/battery.js?5\"></script>"
        .'<script type="text/javascript" async="async"'
        ." src=\"{$base}js/clock.js?5\"></script>";

    include_once __DIR__.'/../fns/echo_html.php';
    echo_html($title, $head, $body, $theme, $base);

}
