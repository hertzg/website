<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../../fns/request_strings.php';
list($keyword) = request_strings('keyword');

include_once '../../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

$full_name = htmlspecialchars($contact->full_name);
if ($keyword !== '') {
    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
    $replace = '<mark>$0</mark>';
    $full_name = preg_replace($regex, $replace, $full_name);
}

include_once '../../fns/Form/label.php';
$items = [Form\label('Full name', $full_name)];

$alias = $contact->alias;
if ($alias !== '') {
    $alias = htmlspecialchars($alias);
    if ($keyword !== '') $alias = preg_replace($regex, $replace, $alias);
    $items[] = Form\label('Alias', $alias);
}

$address = $contact->address;
if ($address !== '') {
    $items[] = Form\label('Address', htmlspecialchars($address));
}

$email = $contact->email;
if ($email !== '') {
    $escapedEmail = htmlspecialchars($email);
    $href = "mailto:$escapedEmail";
    include_once '../../fns/Form/link.php';
    $items[] = Form\link('Email', $escapedEmail, $href, 'mail');
}

include_once 'fns/render_phone_number.php';
render_phone_number('Phone 1', $contact->phone1, $items, $keyword);
render_phone_number('Phone 2', $contact->phone2, $items, $keyword);

include_once '../fns/render_birthday.php';
render_birthday($contact->birthday_time, $items);

$username = $contact->username;
if ($username !== '') {
    $items[] = Form\label('Zvini username', htmlspecialchars($username));
}

$base = '../../';

$timezone = $contact->timezone;
if ($timezone !== null) {
    include_once '../../fns/Form/timezoneLabel.php';
    $items[] = Form\timezoneLabel($base, $timezone);
}

$insert_time = $contact->insert_time;
$update_time = $contact->update_time;

include_once '../../fns/ContactTags/indexOnContact.php';
$tags = ContactTags\indexOnContact($mysqli, $id);
if ($tags) {
    include_once '../../fns/Page/tags.php';
    $items[] = Page\tags('../', $tags);
}

include_once '../../fns/date_ago.php';
$text =
    '<div>'.($contact->favorite ? 'Favorite' : 'Regular').' contact.</div>'
    .'<div>Contact created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/infoText.php';
$infoText = Page\infoText($text);

include_once 'fns/create_content.php';
$content = create_content($contact, $infoText, $items);

include_once '../../fns/get_revision.php';
$cssRevision = get_revision('contact.compressed.css');

include_once '../../fns/echo_page.php';
echo_page($user, "Contact #$id", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}contact.compressed.css?$cssRevision\" />"
]);
