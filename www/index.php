<?php

include_once 'lib/session-start.php';
include_once 'lib/user.php';

if ($user) {
    include_once 'fns/redirect.php';
    redirect('home.php');
}

header('Content-Type: text/html; charset=UTF-8');

unset(
    $_SESSION['signin_errors'],
    $_SESSION['signin_lastpost'],
    $_SESSION['signin_messages'],
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost']
);

echo
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>Zvini</title>'
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
            .'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />'
            .'<link rel="stylesheet" type="text/css" href="common.css" />'
            .'<link rel="stylesheet" type="text/css" href="index.css" />'
            .'<link rel="icon" type="image/png" href="images/favicon.png" />'
        .'</head>'
        .'<body>'
            .'<div style="position: relative; height: 100%; min-height: 306px">'
                .'<div style="position: absolute; top: 0; right: 0; bottom: 50%; left: 0; background-color: #333">'
                    .'<div style="position: absolute; right: 0; bottom: 0; left: 0; height: 48px; background-image: linear-gradient(#333, #444)"></div>'
                .'</div>'
                .'<div style="width: 272px; height: 186px; position: absolute; top: 24px; right: 24px; bottom: 96px; left: 24px; margin: auto">'
                    .'<img src="images/zvini-large.svg" style="vertical-align: top" />'
                    .'<div style="color: #fff; margin-top: 24px">'
                        .'<h1>Save Your Data in Zvini</h1>'
                        .'<div style="margin-top: 12px; font-size: 11px">Save your files, contacts, notes and more.<br />It\'s free and easy.</div>'
                    .'</div>'
                .'</div>'
                .'<div style="position: absolute; right: 24px; bottom: 24px; left: 24px; height: 48px">'
                    .'<div style="position: absolute; top: 0; bottom: 0; left: 0; width: 50%">'
                        .'<div style="position: absolute; top: 0; bottom: 0; left: 0; width: 100%; max-width: 200px">'
                            .'<a class="button" style="right: 12px; left: 0" href="signin.php">Sign In</a>'
                        .'</div>'
                    .'</div>'
                    .'<div style="position: absolute; top: 0; right: 0; bottom: 0; width: 50%">'
                        .'<div style="position: absolute; top: 0; right: 0; bottom: 0; width: 100%; max-width: 200px">'
                            .'<a class="button" style="right: 0; left: 12px" href="signup.php">Sign Up</a>'
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
        .'</body>'
    .'</html>';
