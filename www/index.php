<?php

include_once 'fns/require_guest_user.php';
require_guest_user('');

include_once 'fns/get_revision.php';

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages'],
    $_SESSION['sign-up/index_errors'],
    $_SESSION['sign-up/index_lastpost']
);

header('Content-Type: text/html; charset=UTF-8');

echo
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>Zvini</title>'
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
            .'<meta name="viewport" content="width=device-width" />'
            .'<link rel="stylesheet" type="text/css"'
            .' href="common.compressed.css?'.get_revision('common.compressed.css').'" />'
            .'<link rel="stylesheet" type="text/css" href="index.css?3" />'
            .'<link rel="icon" type="image/png" href="zvini-icons/16.png" />'
            .'<link rel="icon" type="image/png" href="zvini-icons/32.png" sizes="32x32" />'
        .'</head>'
        .'<body>'
            .'<div class="backgroundGradient">'
                .'<div></div>'
            .'</div>'
            .'<div class="centerWrapper">'
                .'<img src="images/zvini-large.png" />'
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
