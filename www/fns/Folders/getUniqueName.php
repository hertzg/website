<?php

namespace Folders;

function getUniqueName ($mysqli, $id_users, $parent_id_folders, $name) {
    include_once __DIR__.'/getByName.php';
    while (getByName($mysqli, $id_users, $parent_id_folders, $name)) {
        if (preg_match('/_(\d+)$/', $name, $match)) {
            $name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $name);
        } else {
            $name .= '_1';
        }
    }
    return $name;
}
