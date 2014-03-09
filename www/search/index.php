<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($keyword, $searchFiles) = request_strings('keyword', 'files');

include_once '../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../fns/redirect.php';
    redirect('..');
}

include_once '../fns/create_search_form_content.php';
$items = array(
    '<form action="./" style="height: 48px; position: relative">'
        .create_search_form_content($keyword, 'Search...', '..')
    .'</form>'
);

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

    include_once 'fns/render_bookmarks.php';
    render_bookmarks($bookmarks, $items);

    include_once 'fns/render_contacts.php';
    render_contacts($contacts, $items);

    include_once 'fns/render_notes.php';
    render_notes($notes, $items);

    include_once 'fns/render_tasks.php';
    render_tasks($tasks, $items);

    include_once 'fns/render_folders.php';
    render_folders($folders, $items);

    include_once 'fns/render_files.php';
    render_files($files, $items);

} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('Nothing found.');
}

if (!$searchFiles) {
    $href = htmlspecialchars('./?'.http_build_query(array(
        'keyword' => $keyword,
        'files' => '1',
    )));
    include_once '../fns/Page/imageLink.php';
    $items[] = Page\imageLink('Search in files', $href, 'search-folder');
}

include_once '../fns/create_tabs.php';
$content = create_tabs(array(), 'Home', join('<div class="hr"></div>', $items));

include_once '../fns/echo_page.php';
echo_page($user, 'Search: '.htmlspecialchars($keyword), $content, '../');
