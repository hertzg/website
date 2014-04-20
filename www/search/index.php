<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($keyword, $searchFiles, $offset) = request_strings(
    'keyword', 'files', 'offset');

include_once '../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../fns/redirect.php';
    redirect('..');
}

include_once '../fns/SearchForm/content.php';
$formContent = SearchForm\content($keyword, 'Search...', '..');

include_once '../fns/SearchForm/create.php';
$items = [SearchForm\create('./', $formContent)];

include_once '../fns/Bookmarks/search.php';
$bookmarks = Bookmarks\search($mysqli, $id_users, $keyword);

include_once '../fns/Contacts/search.php';
$contacts = Contacts\search($mysqli, $id_users, $keyword);

include_once '../fns/Notes/search.php';
$notes = Notes\search($mysqli, $id_users, $keyword);

include_once '../fns/Tasks/search.php';
$tasks = Tasks\search($mysqli, $id_users, $keyword);

include_once 'fns/search_folders_and_files.php';
list($folders, $files) = search_folders_and_files($mysqli,
    $searchFiles, $id_users, $keyword);

if ($bookmarks || $contacts || $notes || $tasks || $folders || $files) {

    include_once 'fns/create_items.php';
    $resultItems = create_items($bookmarks, $contacts,
        $notes, $tasks, $folders, $files);

    include_once 'fns/render_search_files_link.php';
    render_search_files_link($searchFiles, $keyword, $offset, $resultItems);

    $offset = abs((int)$offset);
    $total = count($resultItems);

    include_once '../fns/Paging/limit.php';
    $limit = Paging\limit();

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $keyword, $searchFiles);

    $resultItems = array_slice($resultItems, $offset, $limit);
    $items = array_merge($items, $resultItems);

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $keyword, $searchFiles);

} else {

    include_once '../fns/Page/info.php';
    $items[] = Page\info('Nothing found');

    include_once 'fns/render_search_files_link.php';
    render_search_files_link($searchFiles, $keyword, 0, $items);

}

include_once '../fns/Page/tabs.php';
$content = create_tabs([], 'Home', join('<div class="hr"></div>', $items));

include_once '../fns/echo_page.php';
echo_page($user, 'Search: '.htmlspecialchars($keyword), $content, $base);
