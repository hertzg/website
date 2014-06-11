<?php

namespace Users\Contacts;

function addDeleted ($mysqli, $user, $object) {

    $id_users = $user->id_users;

    $id = $object->id;
    $full_name = $object->full_name;
    $alias = $object->alias;
    $birthday_time = $object->birthday_time;
    $tags = $object->tags;
    $favorite = $object->favorite;

    include_once __DIR__.'/../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../../Contacts/addDeleted.php';
    \Contacts\addDeleted($mysqli, $id, $id_users, $full_name, $alias,
        $object->address, $object->email, $object->phone1, $object->phone2,
        $birthday_time, $object->username, $object->tags, $favorite,
        $object->insert_time, $object->update_time);

    include_once __DIR__.'/../../ContactTags/add.php';
    \ContactTags\add($mysqli, $id_users, $id,
        $tag_names, $full_name, $alias, $favorite);

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
