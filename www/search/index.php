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
    $folders = $files = [];
}

if ($contacts || $notes || $tasks) {

    foreach ($contacts as $contact) {
        $items[] = Page::imageLink(
            htmlspecialchars($contact->fullname),
            "../contacts/view/?id=$contact->idcontacts",
            'contact'
        );
    }

    foreach ($notes as $note) {
        $items[] = Page::imageLink(
            htmlspecialchars($note->notetext),
            "../notes/view/?id=$note->idnotes",
            'note'
        );
    }

    foreach ($tasks as $task) {
        $icon = $task->top_priority ? 'task-top-priority' : 'task';
        $title = htmlspecialchars($task->tasktext);
        $href = "../tasks/view/?id=$task->idtasks";
        $tags = $task->tags;
        if ($tags) {
            $items[] = Page::imageLinkWithDescription($title, 'Tags: '.htmlspecialchars($tags), $href, $icon);
        } else {
            $items[] = Page::imageLink($title, $href, $icon);
        }
    }

    include_once '../files/fns/create_folder_link.php';

    foreach ($folders as $i => $folder) {
        $items[] = Page::imageLink(
            htmlspecialchars($folder->foldername),
            create_folder_link($folder->idfolders, '../files/'),
            'folder'
        );
    }

    foreach ($files as $i => $file) {
        $items[] = Page::imageLink(
            htmlspecialchars($file->filename),
            "../files/view-file/?id=$file->idfiles",
            'file'
        );
    }

} else {
    $items[] = Page::info('Nothing found.');
}

if (!$searchFiles) {
    $href = htmlspecialchars('./?'.http_build_query([
        'keyword' => $keyword,
        'files' => '1',
    ]));
    $items[] = Page::imageLink('Search in files', $href, 'search-folder');
}

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Search: '.htmlspecialchars($keyword);
$page->finish(
    create_tabs(array(), 'Home', join(Page::HR, $items))
);
