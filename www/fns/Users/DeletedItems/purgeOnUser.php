<?php

namespace Users\DeletedItems;

function purgeOnUser ($mysqli, $id_users) {

    include_once __DIR__.'/../../DeletedItems/indexOnUserOfType.php';

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'barChart');
    if ($deletedItems) {
        include_once __DIR__.'/purgeBarChart.php';
        foreach ($deletedItems as $deletedItem) {
            purgeBarChart($mysqli, $deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'bookmark');
    if ($deletedItems) {
        include_once __DIR__.'/purgeBookmark.php';
        foreach ($deletedItems as $deletedItem) {
            purgeBookmark($mysqli, $deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'calculation');
    if ($deletedItems) {
        include_once __DIR__.'/purgeCalculation.php';
        foreach ($deletedItems as $deletedItem) {
            purgeCalculation($mysqli, $deletedItem);
        }
    }

    $deletedItems = array_merge(
        \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'contact'),
        \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'receivedContact')
    );
    if ($deletedItems) {
        include_once __DIR__.'/purgeContact.php';
        foreach ($deletedItems as $deletedItem) {
            purgeContact($mysqli, $deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType($mysqli, $id_users, 'file');
    if ($deletedItems) {
        include_once __DIR__.'/purgeFile.php';
        foreach ($deletedItems as $deletedItem) {
            purgeFile($deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'folder');
    if ($deletedItems) {
        include_once __DIR__.'/purgeFolder.php';
        foreach ($deletedItems as $deletedItem) {
            purgeFolder($mysqli, $deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'place');
    if ($deletedItems) {
        include_once __DIR__.'/purgePlace.php';
        foreach ($deletedItems as $deletedItem) {
            purgePlace($mysqli, $deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'receivedFile');
    if ($deletedItems) {
        include_once __DIR__.'/purgeReceivedFile.php';
        foreach ($deletedItems as $deletedItem) {
            purgeReceivedFile($deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'receivedFolder');
    if ($deletedItems) {
        include_once __DIR__.'/purgeReceivedFolder.php';
        foreach ($deletedItems as $deletedItem) {
            purgeReceivedFolder($mysqli, $deletedItem);
        }
    }

    $deletedItems = \DeletedItems\indexOnUserOfType(
        $mysqli, $id_users, 'wallet');
    if ($deletedItems) {
        include_once __DIR__.'/purgeWallet.php';
        foreach ($deletedItems as $deletedItem) {
            purgeWallet($mysqli, $deletedItem);
        }
    }

    include_once __DIR__.'/../../DeletedItems/deleteOnUser.php';
    \DeletedItems\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_deleted_items = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
