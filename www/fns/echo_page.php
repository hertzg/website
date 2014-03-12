<?php

function echo_page ($user, $title, $content, $base, array $options = array()) {

    $theme = $user ? $user->theme : 'orange';

    if (array_key_exists('head', $options)) {
        $head = $options['head'];
    } else {
        $head = '';
    }

    if (array_key_exists('hideSignOutLink', $options)) {
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

    $body =
        '<div id="tbar">'
            .'<a class="topLink logoLink" href="'.($base === '' ? './' : $base).'">'
                ."<img src=\"{$base}themes/$theme/images/zvini.png?2\""
                .' alt="Zvini" width="68" height="32" class="logoImg" />'
            .'</a>'
            .$signOutLink
        .'</div>'
        .$content
        .'<div id="bbar"></div>';

    include_once __DIR__.'/../fns/echo_html.php';
    echo_html($title, $head, $body, $theme, $base);

}
