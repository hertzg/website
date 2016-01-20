<?php

namespace Users\Contacts;

function addDeleted ($mysqli, $user, $data) {

    $id_users = $user->id_users;

    $id = $data->id;
    $full_name = $data->full_name;
    $alias = $data->alias;
    $email1 = $data->email1;
    $email1_label = $data->email1_label;
    $email2 = $data->email2;
    $email2_label = $data->email2_label;
    $phone1 = $data->phone1;
    $phone1_label = $data->phone1_label;
    $phone2 = $data->phone2;
    $phone2_label = $data->phone2_label;
    $birthday_time = $data->birthday_time;
    $tags = $data->tags;
    $favorite = $data->favorite;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Contacts/addDeleted.php";
    \Contacts\addDeleted($mysqli, $id, $id_users, $full_name,
        $alias, $data->address, $email1, $email1_label, $email2,
        $email2_label, $phone1, $phone1_label, $phone2, $phone2_label,
        $birthday_time, $data->username, $data->timezone, $data->tags,
        $tag_names, $data->notes, $favorite, $insert_time,
        $update_time, $data->photo_id, $data->revision);

    include_once "$fnsDir/ContactRevisions/setDeletedOnContact.php";
    \ContactRevisions\setDeletedOnContact($mysqli, $id, false);

    if ($tag_names) {
        include_once "$fnsDir/ContactTags/add.php";
        \ContactTags\add($mysqli, $id_users, $id, $tag_names,
            $full_name, $alias, $email1, $email1_label, $email2,
            $email2_label, $phone1, $phone1_label, $phone2,
            $phone2_label, $favorite, $insert_time, $update_time);
    }

    if ($birthday_time !== null) {
        include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
        \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
