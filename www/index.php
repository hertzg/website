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

header('Content-Type: text/html; charset=UTF-8');

include_once 'fns/get_revision.php';
include_once 'fns/compressed_css_link.php';
include_once 'fns/compressed_js_script.php';
echo
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>Zvini</title>'
            .'<meta http-equiv="Content-Type"'
            .' content="text/html; charset=UTF-8" />'
            .'<meta name="viewport"'
            .' content="width=device-width, user-scalable=no" />'
            .compressed_css_link('common')
            .compressed_css_link('index')
            .'<link rel="icon" type="image/png"'
            .' href="zvini-icons/16.png?'.get_revision('zvini-icons/16.png').'" />'
            .'<link rel="icon" type="image/png" sizes="32x32"'
            .' href="zvini-icons/32.png?'.get_revision('zvini-icon/32.png').'" />'
        .'</head>'
        .'<body>'
            .'<div class="backgroundGradient">'
                .'<div class="backgroundGradient-gradient"></div>'
            .'</div>'
            .'<div class="centerWrapper">'
                .'<img class="logoImage" src="images/zvini-large.svg?1" />'
                .'<div class="siteInfo">'
                    .'<h1>Save Your Data in Zvini</h1>'
                    .'<div class="description">'
                        .'<div>Save your files, contacts, notes and more.</div>'
                        .'<div>It\'s free and easy.</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            .'<div class="buttonsWrapper">'
                .'<div class="buttonsWrapper-half left">'
                    .'<div class="buttonsWrapper-limit left">'
                        .'<div class="buttonWrapper left">'
                            .'<a class="button" href="sign-in/">Sign In</a>'
                        .'</div>'
                    .'</div>'
                .'</div>'
                .'<div class="buttonsWrapper-half right">'
                    .'<div class="buttonsWrapper-limit right">'
                        .'<div class="buttonWrapper right">'
                            .'<a class="button" href="sign-up/">Sign Up</a>'
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            .'<script type="text/javascript">'
                ."var base = ''"
            .'</script>'
            .compressed_js_script('unloadProgress')
        .'</body>'
    .'</html>';
