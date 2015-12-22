<?php

include_once 'fns/require_installed.php';
require_installed();

include_once 'fns/signed_user.php';
$user = signed_user();

if ($user) {
    unset($_SESSION['home/messages']);
    include_once 'fns/redirect.php';
    redirect('home/');
}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/SignUpEnabled/get.php';
if (SignUpEnabled\get()) {
    $buttons =
        '<div class="buttonsWrapper-half left">'
            .'<div class="buttonsWrapper-limit left">'
                .'<div class="buttonWrapper left">'
                    .'<a class="button" href="sign-in/">Sign In</a>'
                .'</div>'
            .'</div>'
        .'</div>'
        .'<div class="buttonsWrapper-half right">'
            .'<div class="buttonsWrapper-limit right">'
                .'<div class="buttonWrapper right">'
                    .'<a class="button" href="sign-up/">Create an Account</a>'
                .'</div>'
            .'</div>'
        .'</div>';
} else {
    $buttons =
        '<div class="buttonsWrapper-limit center">'
            .'<div class="buttonWrapper center">'
                .'<a class="button" href="sign-in/">Sign In</a>'
            .'</div>'
        .'</div>';
}

include_once 'fns/Theme/Color/getDefault.php';
$theme_color = Theme\Color\getDefault();

$logoSrc = "theme/color/$theme_color/images/zvini.svg";

header('Content-Type: text/html; charset=UTF-8');

include_once 'fns/compressed_css_link.php';
include_once 'fns/compressed_js_script.php';
include_once 'fns/get_revision.php';
include_once 'fns/page_icon_links.php';
include_once 'fns/SiteTitle/get.php';
echo
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>'.htmlspecialchars(SiteTitle\get()).'</title>'
            .'<meta http-equiv="Content-Type"'
            .' content="text/html; charset=UTF-8" />'
            .'<meta name="viewport"'
            .' content="width=device-width, user-scalable=no" />'
            .compressed_css_link('common')
            .compressed_css_link('index')
            .page_icon_links($theme_color)
        .'</head>'
        .'<body>'
            .'<div class="backgroundGradient">'
                .'<div class="backgroundGradient-gradient"></div>'
            .'</div>'
            .'<div class="centerWrapper">'
                .'<img class="logoImage"'
                ." src=\"$logoSrc?".get_revision($logoSrc)."\" />"
                .'<div class="siteInfo">'
                    .'<h1>Save Your Data in Zvini</h1>'
                    .'<div class="description">'
                        .'<div>Save your files, contacts, notes and more.</div>'
                        .'<div>It\'s free and easy.</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            .'<br class="zeroHeight" />'
            .'<div class="buttonsWrapper">'
                .$buttons
            .'</div>'
            .'<script type="text/javascript">'
                ."var base = ''"
            .'</script>'
            .compressed_js_script('unloadProgress')
        .'</body>'
    .'</html>';
