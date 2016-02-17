<?php

namespace HomePage;

function homeItems ($mysqli, $user, &$head, &$scripts) {

    include_once __DIR__.'/../Users/Home/get.php';
    $home = \Users\Home\get($user);

    $renderers = [
        'admin' => 'renderAdmin',
        'bar-charts' => 'renderBarCharts',
        'new-bar-chart' => 'renderNewBarChart',
        'bookmarks' => 'renderBookmarks',
        'new-bookmark' => 'renderNewBookmark',
        'calculations' => 'renderCalculations',
        'new-calculation' => 'renderNewCalculation',
        'calendar' => 'renderCalendar',
        'new-event' => 'renderNewEvent',
        'contacts' => 'renderContacts',
        'new-contact' => 'renderNewContact',
        'files' => 'renderFiles',
        'upload-files' => 'renderUploadFiles',
        'notes' => 'renderNotes',
        'new-note' => 'renderNewNote',
        'notifications' => 'renderNotifications',
        'post-notification' => 'renderPostNotification',
        'places' => 'renderPlaces',
        'new-place' => 'renderNewPlace',
        'tasks' => 'renderTasks',
        'new-task' => 'renderNewTask',
        'schedules' => 'renderSchedules',
        'new-schedule' => 'renderNewSchedule',
        'wallets' => 'renderWallets',
        'new-wallet' => 'renderNewWallet',
        'new-transaction' => 'renderNewTransaction',
        'transfer-amount' => 'renderTransferAmount',
        'trash' => 'renderTrash',
    ];

    $items = [];
    foreach ($home as $key => $value) {
        $renderer = $renderers[$key];
        include_once __DIR__."/$renderer.php";
        $function = "HomePage\\$renderer";
        $items[] = $function($user, $head, $scripts, $mysqli);
    }

    include_once __DIR__.'/../Page/thumbnails.php';
    return \Page\thumbnails($items);

}
