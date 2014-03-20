<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

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
$items = array(SearchForm\create('./', $formContent));

include_once '../fns/Bookmarks/search.php';
$bookmarks = Bookmarks\search($mysqli, $idusers, $keyword);

include_once '../fns/Contacts/search.php';
$contacts = Contacts\search($mysqli, $idusers, $keyword);

include_once '../fns/Notes/search.php';
$notes = Notes\search($mysqli, $idusers, $keyword);

include_once '../fns/Tasks/search.php';
$tasks = Tasks\search($mysqli, $idusers, $keyword);

if ($searchFiles) {

    include_once '../fns/Folders/search.php';
    $folders = Folders\search($mysqli, $idusers, $keyword);

    include_once '../fns/Files/search.php';
    $files = Files\search($mysqli, $idusers, $keyword);

} else {
    $folders = $files = array();
}

if ($bookmarks || $contacts || $notes || $tasks || $folders || $files) {

    $resultItems = [];

    include_once 'fns/render_bookmarks.php';
    render_bookmarks($bookmarks, $resultItems);

    include_once 'fns/render_contacts.php';
    render_contacts($contacts, $resultItems);

    include_once 'fns/render_notes.php';
    render_notes($notes, $resultItems);

    include_once 'fns/render_tasks.php';
    render_tasks($tasks, $resultItems);

    include_once 'fns/render_folders.php';
    render_folders($folders, $resultItems);

    include_once 'fns/render_files.php';
    render_files($files, $resultItems);

    include_once 'fns/render_search_files_link.php';
    render_search_files_link($searchFiles, $keyword, $offset, $resultItems);

    $offset = abs((int)$offset);
    $total = count($resultItems);

    include_once '../fns/Paging/limit.php';
    $limit = Paging\limit();

    include_once 'fns/render_prev_button.php';
    render_prev_button($offset, $limit, $items, $keyword, $searchFiles);

    $resultItems = array_slice($resultItems, $offset, $limit);
    $items = array_merge($items, $resultItems);

    include_once 'fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $keyword, $searchFiles);

} else {

    include_once '../fns/Page/info.php';
    $items[] = Page\info('Nothing found.');

    include_once 'fns/render_search_files_link.php';
    render_search_files_link($searchFiles, $keyword, 0, $items);

}

include_once '../fns/create_tabs.php';
$content = create_tabs(array(), 'Home', join('<div class="hr"></div>', $items));

include_once '../fns/echo_page.php';
echo_page($user, 'Search: '.htmlspecialchars($keyword), $content, $base);
