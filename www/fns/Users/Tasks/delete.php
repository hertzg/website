<?php

namespace Users\Tasks;

function delete ($mysqli, $id, $id_users) {

    include_once __DIR__.'/../../Tasks/delete.php';
    \Tasks\delete($mysqli, $id);

    include_once __DIR__.'/../../TaskTags/deleteOnTask.php';
    \TaskTags\deleteOnTask($mysqli, $id);

    include_once __DIR__.'/../../Users/Tasks/addNumber.php';
    \Users\Tasks\addNumber($mysqli, $id_users, -1);

}
