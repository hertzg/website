<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($keyword) = request_strings('keyword');

include_once '../../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../../fns/redirect.php';
    redirect('..');
}

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once '../../fns/Schedules/searchOnUser.php';
include_once '../../lib/mysqli.php';
$schedules = Schedules\searchOnUser($mysqli, $user->id_users, $keyword);

include_once '../../fns/SearchForm/content.php';
$formContent = SearchForm\content($keyword, 'Search schedules...', '..');

include_once '../../fns/SearchForm/create.php';
$items = [SearchForm\create('./', $formContent)];

if ($schedules) {

    include_once '../fns/sort_schedules.php';
    sort_schedules($schedules);

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

    include_once '../fns/format_days_left.php';
    include_once '../../fns/ItemList/escapedItemQuery.php';
    include_once '../../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($schedules as $schedule) {

        $title = htmlspecialchars($schedule->text);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);

        $description = format_days_left($schedule->days_left);
        $href = '../view/'.ItemList\escapedItemQuery($schedule->id);
        $items[] = Page\imageArrowLinkWithDescription(
            $title, $description, $href, 'schedule');

    }

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No schedules found');
}

include_once '../fns/create_options_panel.php';
include_once '../../fns/create_new_item_button.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Schedules',
    Page\sessionErrors('schedules/errors')
    .Page\sessionMessages('schedules/messages')
    .join('<div class="hr"></div>', $items)
    .create_options_panel($user, '../'),
    create_new_item_button('Schedule', '../')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Schedules', $content, $base);
