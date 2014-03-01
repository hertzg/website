<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/mysqli.php';
include_once '../lib/page.php';

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

    foreach ($bookmarks as $bookmark) {
        $items[] = Page::imageArrowLinkWithDescription(
            htmlspecialchars($bookmark->title),
            htmlspecialchars($bookmark->url),
            "../bookmarks/view/?id=$bookmark->idbookmarks", 'bookmark');
    }

    foreach ($contacts as $contact) {
        $items[] = Page::imageArrowLink(htmlspecialchars($contact->fullname),
            "../contacts/view/?id=$contact->idcontacts", 'contact');
    }

    foreach ($notes as $note) {
        $items[] = Page::imageArrowLink(htmlspecialchars($note->notetext),
            "../notes/view/?id=$note->idnotes", 'note');
    }

    foreach ($tasks as $task) {
        $icon = $task->top_priority ? 'task-top-priority' : 'task';
        $title = htmlspecialchars($task->tasktext);
        $href = "../tasks/view/?id=$task->idtasks";
        $tags = $task->tags;
        if ($tags) {
            $items[] = Page::imageArrowLinkWithDescription($title,
                'Tags: '.htmlspecialchars($tags), $href, $icon);
        } else {
            $items[] = Page::imageArrowLink($title, $href, $icon);
        }
    }

    include_once '../files/fns/create_folder_link.php';
    foreach ($folders as $folder) {
        $items[] = Page::imageArrowLink(htmlspecialchars($folder->foldername),
            create_folder_link($folder->idfolders, '../files/'), 'folder');
    }

    foreach ($files as $file) {
        $items[] = Page::imageArrowLink(htmlspecialchars($file->filename),
            "../files/view-file/?id=$file->idfiles", 'file');
    }

} else {
    $items[] = Page::info('Nothing found.');
}

if (!$searchFiles) {
    $href = htmlspecialchars('./?'.http_build_query(array(
        'keyword' => $keyword,
        'files' => '1',
    )));
    $items[] = Page::imageLink('Search in files', $href, 'search-folder');
}

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Search: '.htmlspecialchars($keyword);
$page->finish(
    create_tabs(array(), 'Home', join(Page::HR, $items))
);
