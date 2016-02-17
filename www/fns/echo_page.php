<?php

function echo_page ($user, $title, $content, $base, $options = []) {

    include_once __DIR__.'/resolve_theme.php';
    resolve_theme($user, $theme_color, $theme_brightness);

    if (array_key_exists('head', $options)) $head = $options['head'];
    else $head = '';

    if ($user) {
        include_once __DIR__.'/compressed_css_link.php';
        $head .= compressed_css_link('confirmDialog', $base);
    }

    include_once __DIR__.'/client_time_and_timezone.php';
    client_time_and_timezone($user, $time, $timezone);

    include_once __DIR__.'/compressed_js_script.php';
    $scripts =
        '<script type="text/javascript">'
            ."var time = $time\n"
            ."var timezone = $timezone"
        .'</script>'
        .compressed_js_script('batteryAndClock', $base)
        .compressed_js_script('lineSizeRounding', $base);

    if ($user) {

        include_once __DIR__.'/get_sign_out_timeout.php';
        $scripts .=
            '<script type="text/javascript">'
                .'var signOutTimeout = '.get_sign_out_timeout()
            .'</script>'
            .compressed_js_script('confirmDialog', $base)
            .compressed_js_script('signOutConfirm', $base);

        if (!array_key_exists('token', $_SESSION)) {
            $scripts .= compressed_js_script('sessionTimeout', $base);
        }

    }

    if (array_key_exists('scripts', $options)) $scripts .= $options['scripts'];

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

    $notifications = '';
    if ($user) {
        $num_notifications = $user->home_num_new_notifications +
            $user->home_num_new_received_bookmarks +
            $user->home_num_new_received_calculations +
            $user->home_num_new_received_contacts +
            $user->home_num_new_received_files +
            $user->home_num_new_received_folders +
            $user->home_num_new_received_notes +
            $user->home_num_new_received_places +
            $user->home_num_new_received_schedules +
            $user->home_num_new_received_tasks;
        if ($num_notifications) {
            $notifications =
                '<span class="logoLink-notifications">'
                    .'<span class="zeroSize"> (</span>'
                    .$num_notifications
                    .'<span class="zeroSize">)</span>'
                .'</span>';
        }
    }

    if (array_key_exists('logo_href', $options)) {
        $logo_href = $options['logo_href'];
    } else {
        $logo_href = $base === '' ? './' : $base;
    }

    $logoSrc = "theme/color/$theme_color/images/zvini.svg";

    include_once __DIR__.'/get_revision.php';
    $body =
        '<div id="tbar">'
            .'<div id="tbar-limit">'
                ."<a href=\"$logo_href\""
                .' class="topLink logoLink localNavigation-link">'
                    ."<img src=\"$base$logoSrc?".get_revision($logoSrc).'"'
                    .' alt="Zvini" class="logoLink-img" />'
                    .$notifications
                .'</a>'
                .'<div class="page-clockWrapper">'
                    .'<div id="staticClockWrapper">'
                        .date('H:i:s', $time / 1000)
                    .'</div>'
                    .'<div id="batteryWrapper"></div>'
                    .'<div id="dynamicClockWrapper"></div>'
                .'</div>'
                .$signOutLink
            .'</div>'
        .'</div>'
        .$content;

    include_once __DIR__.'/../fns/echo_html.php';
    echo_html($title, $head, $body, $theme_color,
        $theme_brightness, $base, $scripts);

}
