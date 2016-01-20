<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

$id = abs((int)$id);

include_once "$fnsDir/ContactRevisions/getNotDeletedOnUser.php";
include_once '../../../lib/mysqli.php';
$revision = ContactRevisions\getNotDeletedOnUser(
    $mysqli, $user->id_users, $id);

if (!$revision) {
    include_once "$fnsDir/redirect.php";
    redirect('../..');
}

$id_contacts = $revision->id_contacts;

$full_name = htmlspecialchars($revision->full_name);

include_once "$fnsDir/Form/label.php";
$items = [\Form\label('Full name', $full_name)];

$alias = $revision->alias;
if ($alias !== '') {
    $alias = htmlspecialchars($alias);
    $items[] = \Form\label('Alias', $alias);
}

$address = $revision->address;
if ($address !== '') {
    $items[] = \Form\label('Address', htmlspecialchars($address));
}

include_once '../../../trash/fns/ViewPage/renderContactEmails.php';
ViewPage\renderContactEmails($revision, $items);

include_once '../../../trash/fns/ViewPage/renderContactPhones.php';
ViewPage\renderContactPhones($revision, $items, '');

$birthday_time = $revision->birthday_time;
if ($birthday_time !== null) {
    $items[] = \Form\label('Birthday', date('F j, Y', $birthday_time));
}

$username = $revision->username;
if ($username !== '') {
    $items[] = \Form\label('Zvini username', htmlspecialchars($username));
}

$scripts = '';

$timezone = $revision->timezone;
if ($timezone !== null) {

    include_once "$fnsDir/Form/timezoneLabel.php";
    $items[] = \Form\timezoneLabel($timezone);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('timezoneLabel', $base);

}

$tags = $revision->tags;
if ($tags !== '') {
    $items[] = \Form\label('Tags', htmlspecialchars($tags));
}

$notes = $revision->notes;
if ($notes !== '') {
    $items[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
}

$title = "Contact #{$id_contacts} R".($revision->revision + 1);

include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => 'History',
        'href' => "../?id=$id_contacts#$id",
    ],
    $title,
    join('<div class="hr"></div>', $items)
    .Page\infoText('Revision made '.export_date_ago($revision->insert_time).'.')
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'scripts' => $scripts.compressed_js_script('dateAgo', $base),
]);
