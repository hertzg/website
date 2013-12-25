<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Contacts {

    static function add ($idusers, $fullname, $address,
        $email, $phone1, $phone2, $tags) {

        global $mysqli;
        $fullname = mysqli_real_escape_string($mysqli, $fullname);
        $address = mysqli_real_escape_string($mysqli, $address);
        $email = mysqli_real_escape_string($mysqli, $email);
        $phone1 = mysqli_real_escape_string($mysqli, $phone1);
        $phone2 = mysqli_real_escape_string($mysqli, $phone2);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        mysqli_query(
            $mysqli,
            'insert into contacts'
            .' (idusers, fullname, address,'
            .' email, phone1, phone2, tags)'
            ." values ($idusers, '$fullname', '$address',"
            ." '$email', '$phone1', '$phone2', '$tags')"
        );
        return mysqli_insert_id($mysqli);

    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from contacts where idusers = $idusers"
        )->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            'delete from contacts'
            ." where idusers = $idusers and idcontacts = $id"
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from contacts where idusers = $idusers");
    }

    static function edit ($idusers, $id, $fullname, $address,
        $email, $phone1, $phone2, $tags) {

        global $mysqli;
        $fullname = mysqli_real_escape_string($mysqli, $fullname);
        $address = mysqli_real_escape_string($mysqli, $address);
        $email = mysqli_real_escape_string($mysqli, $email);
        $phone1 = mysqli_real_escape_string($mysqli, $phone1);
        $phone2 = mysqli_real_escape_string($mysqli, $phone2);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        mysqli_query(
            $mysqli,
            'update contacts set'
            ." fullname = '$fullname',"
            ." address = '$address',"
            ." email = '$email',"
            ." phone1 = '$phone1',"
            ." phone2 = '$phone2',"
            ." tags = '$tags'"
            ." where idusers = $idusers and idcontacts = $id"
        );

    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from contacts'
            ." where idusers = $idusers and idcontacts = $id"
        );
    }

    static function getByFullName ($idusers, $fullname, $excludeid = 0) {
        global $mysqli;
        $fullname = mysqli_real_escape_string($mysqli, $fullname);
        return mysqli_single_object(
            $mysqli,
            'select * from contacts'
            ." where idusers = $idusers"
            ." and fullname = '$fullname'"
            ." and idcontacts != $excludeid"
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from contacts'
            ." where idusers = $idusers"
            .' order by fullname'
        );
    }

    static function indexOnTag ($idusers, $tag) {
        global $mysqli;
        $tag = mysqli_real_escape_string($mysqli, $tag);
        return mysqli_query_object(
            $mysqli,
            'select * from contacts t'
            ." where idusers = $idusers"
            .' and exists ('
            .'  select idcontacts from contacttags tt'
            .'  where tt.idcontacts = t.idcontacts'
            ."  and tt.tagname = '$tag'"
            .' )'
            .' order by updatetime desc'
        );
    }

    static function search ($idusers, $keyword) {
        global $mysqli;
        include_once __DIR__.'/../fns/escape_like.php';
        $keyword = escape_like($keyword);
        $keyword = mysqli_real_escape_string($mysqli, $keyword);
        return mysqli_query_object(
            $mysqli,
            'select * from contacts'
            ." where idusers = $idusers and fullname like '%$keyword%'"
            .' order by fullname'
        );
    }

    static function searchOnTag ($idusers, $keyword, $tag) {
        global $mysqli;
        include_once __DIR__.'/../fns/escape_like.php';
        $keyword = escape_like($keyword);
        $keyword = mysqli_real_escape_string($mysqli, $keyword);
        $tag = mysqli_real_escape_string($mysqli, $tag);
        return mysqli_query_object(
            $mysqli,
            'select * from contacts t'
            ." where idusers = $idusers and fullname like '%$keyword%'"
            .' and exists ('
            .'  select idcontacts from contacttags tt'
            .'  where tt.idcontacts = t.idcontacts'
            ."  and tt.tagname = '$tag'"
            .' )'
            .' order by done, updatetime desc'
        );
    }

}
