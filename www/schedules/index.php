<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/Schedules/indexOnUser.php';
include_once '../lib/mysqli.php';
$schedules = Schedules\indexOnUser($mysqli, $user->id_users);

$items = [];
if ($schedules) {

    if (count($schedules) > 1) {

        include_once '../fns/SearchForm/emptyContent.php';
        $formContent = SearchForm\emptyContent('Search schedules...');

        include_once '../fns/SearchForm/create.php';
        $items[] = SearchForm\create('search/', $formContent);

    }

    include_once 'fns/sort_schedules.php';
    sort_schedules($schedules);

    include_once 'fns/format_days_left.php';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($schedules as $schedule) {
        $title = htmlspecialchars($schedule->text);
        $description = format_days_left($schedule->days_left);
        $href = "view/?id=$schedule->id";
        $items[] = Page\imageArrowLinkWithDescription(
            $title, $description, $href, 'schedule');
    }

} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No schedules');
}

include_once 'fns/create_options_panel.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Schedules',
    Page\sessionErrors('schedules/errors')
    .Page\sessionMessages('schedules/messages')
    .join('<div class="hr"></div>', $items)
    .create_options_panel($user)
);

include_once '../fns/echo_page.php';
echo_page($user, 'Schedules', $content, $base);
