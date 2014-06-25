<?php

namespace Files;

function getUniqueName ($mysqli, $id_users, $id_folders, $name) {
    include_once __DIR__.'/getByName.php';
    while (getByName($mysqli, $id_users, $id_folders, $name)) {
        $extension = '';
        if (preg_match('/\..*?$/', $name, $match)) {
            $name = preg_replace('/\..*?$/', '', $name);
            $extension = $match[0];
        }
        if (preg_match('/_(\d+)$/', $name, $match)) {
            $name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $name);
        } else {
            $name .= '_1';
        }
        if ($extension) $name = "$name$extension";
    }
    return $name;
}
