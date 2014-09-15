<?php

namespace Users\Contacts;

function addDeleted ($mysqli, $user, $data) {

    $id_users = $user->id_users;

    $id = $data->id;
    $full_name = $data->full_name;
    $alias = $data->alias;
    $phone1 = $data->phone1;
    $phone2 = $data->phone2;
    $birthday_time = $data->birthday_time;
    $tags = $data->tags;
    $favorite = $data->favorite;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Contacts/addDeleted.php";
    \Contacts\addDeleted($mysqli, $id, $id_users, $full_name, $alias,
        $data->address, $data->email, $phone1, $phone2, $birthday_time,
        $data->username, $data->timezone, $data->tags, $favorite,
        $data->insert_time, $data->update_time, $data->photo_id);

    include_once "$fnsDir/ContactTags/add.php";
    \ContactTags\add($mysqli, $id_users, $id, $tag_names,
        $full_name, $alias, $phone1, $phone2, $favorite);

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
