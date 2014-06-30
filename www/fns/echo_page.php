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

    $topLinkHref = $base === '' ? './' : $base;
    $body =
        '<div id="tbar">'
            ."<a class=\"topLink logoLink\" href=\"$topLinkHref\">"
                ."<img src=\"{$base}themes/$theme/images/zvini.svg?2\""
                .' alt="Zvini" width="68" height="32" class="logoImg" />'
            .'</a>'
            .$signOutLink
        .'</div>'
        .$content
        .'<div id="bbar"></div>';

    include_once __DIR__.'/../fns/echo_html.php';
    echo_html($title, $head, $body, $theme, $base);

}
