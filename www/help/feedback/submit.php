<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/signed_user.php';
$user = signed_user('../../');

include_once '../../fns/request_text.php';
$text = request_text('text');

$errors = [];

include_once '../../fns/str_collapse_spaces.php';
$text = str_collapse_spaces($text);

if ($text === '') $errors[] = 'ENTER_TEXT';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['help/feedback/errors'] = $errors;
    redirect();
}

unset($_SESSION['help/feedback/errors']);

include_once '../../fns/Feedbacks/add.php';
include_once '../../lib/mysqli.php';
$id = Feedbacks\add($mysqli, $user ? $user->id_users : null, $text);

$title = "Zvini Feedback #$id";

$html =
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type"'
            .' content="text/html; charset=UTF-8" />'
        .'</head>'
        .'<body>'
            .htmlspecialchars($text)
        .'</body>'
    .'</html>';

$subject = mb_encode_mimeheader($title, 'UTF-8');

include_once '../../fns/DomainName/get.php';
$headers =
    "Content-Type: text/html; charset=UTF-8\r\n"
    .'From: no-reply@'.DomainName\get();
if ($user && $user->email !== '') $headers .= "\r\nReply-To: $user->email";

include_once '../../fns/InfoEmail/get.php';
mail(InfoEmail\get(), $title, $html, $headers);

$_SESSION['help/messages'] = ['Thank you for the feedback.'];

session_commit();

include_once '../../fns/get_zvini_client.php';
get_zvini_client()->call('notification/post', [
    'channel_name' => 'zvini-feedbacks',
    'text' => $text,
]);

redirect('..');
