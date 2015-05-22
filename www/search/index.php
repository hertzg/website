<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);
$id_users = $user->id_users;

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../lib/mysqli.php';

include_once "$fnsDir/request_strings.php";
list($keyword, $searchFiles) = request_strings('keyword', 'files');

include_once "$fnsDir/Paging/requestOffset.php";
$offset = Paging\requestOffset('../home/');

include_once "$fnsDir/str_collapse_spaces.php";
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once "$fnsDir/redirect.php";
    redirect('..');
}

include_once "$fnsDir/SearchForm/content.php";
$formContent = SearchForm\content($keyword, 'Search...', '..');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $formContent)];

include_once "$fnsDir/Users/BarCharts/search.php";
$bar_charts = Users\BarCharts\search($mysqli, $user, $keyword);

include_once "$fnsDir/Users/Bookmarks/search.php";
$bookmarks = Users\Bookmarks\search($mysqli, $user, $keyword);

include_once "$fnsDir/Users/Contacts/search.php";
$contacts = Users\Contacts\search($mysqli, $user, $keyword);

include_once "$fnsDir/Users/Notes/search.php";
$notes = Users\Notes\search($mysqli, $user, $keyword);

include_once "$fnsDir/Users/Places/search.php";
$places = Users\Places\search($mysqli, $user, $keyword);

include_once "$fnsDir/Users/Tasks/search.php";
$tasks = Users\Tasks\search($mysqli, $user, $keyword);

include_once "$fnsDir/Users/Wallets/search.php";
$wallets = Users\Wallets\search($mysqli, $user, $keyword);

include_once 'fns/search_folders_and_files.php';
list($folders, $files) = search_folders_and_files($mysqli,
    $searchFiles, $id_users, $keyword);

if ($bar_charts || $bookmarks || $contacts || $notes ||
    $places || $tasks || $wallets || $folders || $files) {

    include_once 'fns/create_items.php';
    $resultItems = create_items($bar_charts, $bookmarks, $contacts, $notes,
        $places, $tasks, $wallets, $folders, $files, $keyword, $user);

    include_once 'fns/render_search_files_link.php';
    render_search_files_link($searchFiles, $keyword, $offset, $resultItems);

    $offset = abs((int)$offset);
    $total = count($resultItems);

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $keyword, $searchFiles);

    $resultItems = array_slice($resultItems, $offset, $limit);
    $items = array_merge($items, $resultItems);

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $keyword, $searchFiles);

} else {

    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Nothing found');

    include_once 'fns/render_search_files_link.php';
    render_search_files_link($searchFiles, $keyword, 0, $items);

}

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs([], 'Home', join('<div class="hr"></div>', $items))
    .compressed_js_script('searchForm', $base);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Search: '.htmlspecialchars($keyword), $content, $base);
