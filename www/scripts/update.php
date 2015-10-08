#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$contacts = mysqli_query_object($mysqli, 'select * from contacts');
foreach ($contacts as $contact) {
    if (preg_match('/(.*?)\s([^0-9]+)$/', $contact->phone1, $match)) {
        $phone1 = $mysqli->real_escape_string($match[1]);
        $phone1_label = $mysqli->real_escape_string($match[2]);
        $sql = "update contacts set phone1 = '$phone1',"
            ." phone1_label = '$phone1_label' where id = $contact->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
    if (preg_match('/(.*?)\s([^0-9]+)$/', $contact->phone2, $match)) {
        $phone2 = $mysqli->real_escape_string($match[1]);
        $phone2_label = $mysqli->real_escape_string($match[2]);
        $sql = "update contacts set phone2 = '$phone2',"
            ." phone2_label = '$phone2_label' where id = $contact->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

$contacts = mysqli_query_object($mysqli, 'select * from received_contacts');
foreach ($contacts as $contact) {
    if (preg_match('/(.*?)\s([^0-9]+)$/', $contact->phone1, $match)) {
        $phone1 = $mysqli->real_escape_string($match[1]);
        $phone1_label = $mysqli->real_escape_string($match[2]);
        $sql = "update received_contacts set phone1 = '$phone1',"
            ." phone1_label = '$phone1_label' where id = $contact->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
    if (preg_match('/(.*?)\s([^0-9]+)$/', $contact->phone2, $match)) {
        $phone2 = $mysqli->real_escape_string($match[1]);
        $phone2_label = $mysqli->real_escape_string($match[2]);
        $sql = "update received_contacts set phone2 = '$phone2',"
            ." phone2_label = '$phone2_label' where id = $contact->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

echo "Done\n";
