<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

$id = abs((int)$id);

include_once "$fnsDir/ScheduleRevisions/getNotDeletedOnUser.php";
include_once '../../../lib/mysqli.php';
$revision = ScheduleRevisions\getNotDeletedOnUser(
    $mysqli, $user->id_users, $id);

if (!$revision) {
    include_once "$fnsDir/redirect.php";
    redirect('../..');
}

$id_schedules = $revision->id_schedules;
$interval = $revision->interval;

include_once "$fnsDir/Page/text.php";
$items = [\Page\text(htmlspecialchars($revision->text))];

include_once "$fnsDir/Form/label.php";
$items[] = \Form\label('Repeats in every', "$interval days");

include_once "$fnsDir/days_left_from_today.php";
$days_left = days_left_from_today($user, $interval, $revision->offset);

include_once "$fnsDir/format_days_left.php";
$items[] = \Form\label('Next', format_days_left($user, $days_left));

$tags = $revision->tags;
if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

$title = "Schedule #{$id_schedules} R".($revision->revision + 1);

include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => 'History',
        'href' => "../?id=$id_schedules#$id",
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
