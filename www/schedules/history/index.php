<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset($_SESSION['schedules/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ScheduleRevisions/indexOnSchedule.php";
include_once '../../lib/mysqli.php';
$revisions = ScheduleRevisions\indexOnSchedule($mysqli, $id);

if ($revisions) {
    $items = [];
    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($revisions as $revision) {
        $item_id = $revision->id;
        $items[] = Page\imageArrowLinkWithDescription(
            export_date_ago($revision->insert_time, true),
            'R'.($revision->revision + 1), "view/?id=$item_id",
            'restore-defaults', ['id' => $item_id]);
    }
    $content = join('<div class="hr"></div>', $items);
} else {
    include_once "$fnsDir/Page/info.php";
    $content = Page\info('History is empty');
}

include_once "$fnsDir/Page/create.php";
$content = \Page\create(
    [
        'title' => "Schedule #$id",
        'href' => "../view/?id=$id#history",
    ],
    'History',
    $content
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Schedule #$id History", $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
