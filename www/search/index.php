<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($keyword) = request_strings('keyword');

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

foreach ($contacts as $contact) {
    $items[] = Page::imageLink(
        htmlspecialchars($contact->fullname),
        "../contacts/view/?id=$contact->idcontacts",
        'contact'
    );
}

include_once '../fns/Notes/search.php';
$notes = Notes\search($mysqli, $idusers, $keyword);

foreach ($notes as $note) {
    $items[] = Page::imageLink(
        htmlspecialchars($note->notetext),
        "../notes/view/?id=$note->idnotes",
        'note'
    );
}

include_once '../fns/Tasks/search.php';
$tasks = Tasks\search($mysqli, $idusers, $keyword);

foreach ($tasks as $task) {
    $icon = $task->done ? 'task-done' : 'task';
    $title = htmlspecialchars($task->tasktext);
    $href = "../tasks/view/?id=$task->idtasks";
    $tags = $task->tags;
    if ($tags) {
        $items[] = Page::imageLinkWithDescription($title, 'Tags: '.htmlspecialchars($tags), $href, $icon);
    } else {
        $items[] = Page::imageLink($title, $href, $icon);
    }
}

if (!$contacts && !$notes && !$tasks) {
    $items[] = Page::info('Nothing found.');
}

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Search: '.htmlspecialchars($keyword);
$page->finish(
    create_tabs([], 'Home', join(Page::HR, $items))
);
