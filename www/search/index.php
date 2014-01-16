<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/create_search_form_content.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Contacts.php';
include_once '../classes/Notes.php';
include_once '../classes/Tab.php';
include_once '../classes/Tasks.php';
include_once '../lib/page.php';

list($keyword) = request_strings('keyword');

$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../fns/redirect.php';
    redirect('..');
}

$items = array(
    '<form action="./" style="height: 48px; position: relative">'
        .create_search_form_content($keyword, 'Search...', '..')
    .'</form>'
);

$contacts = Contacts::search($idusers, $keyword);
foreach ($contacts as $contact) {
    $items[] = Page::imageLink(
        htmlspecialchars($contact->fullname),
        "../contacts/view/?id=$contact->idcontacts",
        'contact'
    );
}

$notes = Notes::search($idusers, $keyword);
foreach ($notes as $note) {
    $items[] = Page::imageLink(
        htmlspecialchars($note->notetext),
        "../notes/view/?id=$note->idnotes",
        'note'
    );
}

$tasks = Tasks::search($idusers, $keyword);
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

$page->base = '../';
$page->title = 'Home';
$page->finish(
    Tab::create(
        Tab::activeItem('Home'),
        join(Page::HR, $items)
    )
);
