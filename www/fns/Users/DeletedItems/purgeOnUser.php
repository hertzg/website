<?php

namespace Users\DeletedItems;

function purgeOnUser ($mysqli, $id_users) {

    include_once __DIR__.'/../../DeletedItems/indexOnUserOfType.php';

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'barChart');
    if ($items) {
        include_once __DIR__.'/purgeBarChart.php';
        foreach ($items as $item) purgeBarChart($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'bookmark');
    if ($items) {
        include_once __DIR__.'/purgeBookmark.php';
        foreach ($items as $item) purgeBookmark($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'calculation');
    if ($items) {
        include_once __DIR__.'/purgeCalculation.php';
        foreach ($items as $item) purgeCalculation($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'contact');
    if ($items) {
        include_once __DIR__.'/purgeContact.php';
        foreach ($items as $item) purgeContact($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'file');
    if ($items) {
        include_once __DIR__.'/purgeFile.php';
        foreach ($items as $item) purgeFile($item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'folder');
    if ($items) {
        include_once __DIR__.'/purgeFolder.php';
        foreach ($items as $item) purgeFolder($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'note');
    if ($items) {
        include_once __DIR__.'/purgeNote.php';
        foreach ($items as $item) purgeNote($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'place');
    if ($items) {
        include_once __DIR__.'/purgePlace.php';
        foreach ($items as $item) purgePlace($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'receivedContact');
    if ($items) {
        include_once __DIR__.'/purgeReceivedContact.php';
        foreach ($items as $item) purgeReceivedContact($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'receivedFile');
    if ($items) {
        include_once __DIR__.'/purgeReceivedFile.php';
        foreach ($items as $item) purgeReceivedFile($item);
    }

    $items = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'receivedFolder');
    if ($items) {
        include_once __DIR__.'/purgeReceivedFolder.php';
        foreach ($items as $item) purgeReceivedFolder($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'schedule');
    if ($items) {
        include_once __DIR__.'/purgeSchedule.php';
        foreach ($items as $item) purgeSchedule($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'task');
    if ($items) {
        include_once __DIR__.'/purgeTask.php';
        foreach ($items as $item) purgeTask($mysqli, $item);
    }

    $items = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'wallet');
    if ($items) {
        include_once __DIR__.'/purgeWallet.php';
        foreach ($items as $item) purgeWallet($mysqli, $item);
    }

    include_once __DIR__.'/../../DeletedItems/deleteOnUser.php';
    \DeletedItems\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_deleted_items = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
