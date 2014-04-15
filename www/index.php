<?php

include_once 'fns/signed_user.php';
$user = signed_user();

if ($user) {
    unset($_SESSION['home/messages']);
    include_once 'fns/redirect.php';
    redirect('home/');
}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/get_revision.php';

header('Content-Type: text/html; charset=UTF-8');

echo
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>Zvini</title>'
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
            .'<meta name="viewport"'
            .' content="width=device-width, user-scalable=no" />'
            .'<link rel="stylesheet" type="text/css"'
            .' href="common.compressed.css?'.get_revision('common.compressed.css').'" />'
            .'<link rel="stylesheet" type="text/css" href="index.compressed.css" />'
            .'<link rel="icon" type="image/png" href="zvini-icons/16.png" />'
            .'<link rel="icon" type="image/png" sizes="32x32"'
            .' href="zvini-icons/32.png" />'
        .'</head>'
        .'<body>'
            .'<div class="backgroundGradient">'
                .'<div></div>'
            .'</div>'
            .'<div class="centerWrapper">'
                .'<img src="images/zvini-large.svg" />'
                .'<div class="siteInfo">'
                    .'<h1>Save Your Data in Zvini</h1>'
                    .'<div class="description">'
                        .'<div>Save your files, contacts, notes and more.</div>'
                        .'<div>It\'s free and easy.</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            .'<div class="buttonsWrapper">'
                .'<div>'
                    .'<div>'
                        .'<div class="buttonWrapper left">'
                            .'<a class="button" href="sign-in/">Sign In</a>'
                        .'</div>'
                    .'</div>'
                .'</div>'
                .'<div>'
                    .'<div>'
                        .'<div class="buttonWrapper right">'
                            .'<a class="button" href="sign-up/">Sign Up</a>'
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
        .'</body>'
    .'</html>';
