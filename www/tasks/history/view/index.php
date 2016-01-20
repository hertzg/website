<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

$id = abs((int)$id);

include_once "$fnsDir/TaskRevisions/getNotDeletedOnUser.php";
include_once '../../../lib/mysqli.php';
$revision = TaskRevisions\getNotDeletedOnUser($mysqli, $user->id_users, $id);

if (!$revision) {
    include_once "$fnsDir/redirect.php";
    redirect('../..');
}

$id_tasks = $revision->id_tasks;

include_once "$fnsDir/Page/text.php";
$items = [Page\text($revision->text)];

$deadline_time = $revision->deadline_time;
if ($deadline_time !== null) {

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    include_once "$fnsDir/format_deadline.php";
    $items[] = \Page\text('Deadline '.date('F j, Y', $deadline_time)
        .' ('.format_deadline($deadline_time, $timeToday).')');

}

$tags = $revision->tags;
if ($tags !== '') $items[] = \Page\text("Tags: $tags");

$title = "Task #{$id_tasks} R".($revision->revision + 1);

include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => 'History',
        'href' => "../?id=$id_tasks#$id",
    ],
    $title,
    join('<div class="hr"></div>', $items)
    .Page\infoText('Revision made '.export_date_ago($revision->insert_time).'.')
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
