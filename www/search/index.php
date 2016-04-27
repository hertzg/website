<?php

include_once '../../lib/defaults.php';

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);
$id_users = $user->id_users;

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../lib/mysqli.php';

include_once "$fnsDir/request_strings.php";
list($keyword) = request_strings('keyword');

include_once "$fnsDir/parse_keyword.php";
parse_keyword($keyword, $includes, $excludes);

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset('../home/');

include_once "$fnsDir/str_collapse_spaces.php";
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once "$fnsDir/redirect.php";
    redirect('..');
}

include_once "$fnsDir/SearchForm/content.php";
$formContent = SearchForm\content($keyword, 'Search...', '../home/');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $formContent)];

$groupLimit = 4;

include_once "$fnsDir/Users/BarCharts/searchPage.php";
$bar_charts = Users\BarCharts\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_bar_charts);

include_once "$fnsDir/Users/Bookmarks/searchPage.php";
$bookmarks = Users\Bookmarks\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_bookmarks);

include_once "$fnsDir/Users/Calculations/searchPage.php";
$calculations = Users\Calculations\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_calculations);

include_once "$fnsDir/Users/Contacts/searchPage.php";
$contacts = Users\Contacts\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_contacts);

include_once "$fnsDir/Users/Files/searchPage.php";
$files = Users\Files\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_files);

include_once "$fnsDir/Users/Folders/searchPage.php";
$folders = Users\Folders\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_folders);

include_once "$fnsDir/Users/Notes/searchPage.php";
$notes = Users\Notes\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_notes);

include_once "$fnsDir/Users/Places/searchPage.php";
$places = Users\Places\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_places);

include_once "$fnsDir/Users/Tasks/searchPage.php";
$tasks = Users\Tasks\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_tasks);

include_once "$fnsDir/Users/Wallets/searchPage.php";
$wallets = Users\Wallets\searchPage($mysqli, $user,
    $includes, $excludes, 0, $groupLimit, $num_wallets);

if ($num_bar_charts || $num_bookmarks || $num_calculations ||
    $num_contacts || $num_files || $num_folders ||
    $num_notes || $num_places || $num_tasks || $num_wallets) {

    include_once 'fns/create_items.php';
    $resultItems = create_items($bar_charts, $num_bar_charts,
        $bookmarks, $num_bookmarks, $calculations, $num_calculations,
        $contacts, $num_contacts, $files, $num_files, $folders,
        $num_folders, $notes, $num_notes, $places, $num_places, $tasks,
        $num_tasks, $wallets, $num_wallets, $keyword, $user, $groupLimit);

    $offset = abs((int)$offset);
    $total = count($resultItems);

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $keyword);

    $resultItems = array_slice($resultItems, $offset, $limit);
    $items = array_merge($items, $resultItems);

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $keyword);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Nothing found');
}

include_once "$fnsDir/Page/emptyTabs.php";
$content = Page\emptyTabs(join('<div class="hr"></div>', $items));

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Search: '.htmlspecialchars($keyword), $content, $base, [
    'scripts' => compressed_js_script('searchForm', $base),
]);
