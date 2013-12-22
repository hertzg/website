<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Bookmarks {

    static function add ($idusers, $title, $url, $tags) {
        global $mysqli;
        $title = mysqli_real_escape_string($mysqli, $title);
        $url = mysqli_real_escape_string($mysqli, $url);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $inserttime = $updatetime = time();
        mysqli_query(
            $mysqli,
            'insert into bookmarks'
            .' (idusers, title, url, tags, inserttime, updatetime)'
            ." values ($idusers, '$title', '$url', '$tags', $inserttime, $updatetime)"
        );
        return mysqli_insert_id($mysqli);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from bookmarks where idusers = $idusers"
        )->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from bookmarks where idusers = $idusers and idbookmarks = $id"
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from bookmarks where idusers = $idusers");
    }

    static function edit ($idusers, $id, $title, $url, $tags) {
        global $mysqli;
        $title = mysqli_real_escape_string($mysqli, $title);
        $url = mysqli_real_escape_string($mysqli, $url);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $updatetime = time();
        mysqli_query(
            $mysqli,
            'update bookmarks set'
            ." title = '$title',"
            ." url = '$url',"
            ." tags = '$tags',"
            ." updatetime = $updatetime"
            ." where idusers = $idusers and idbookmarks = $id"
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from bookmarks'
            ." where idusers = $idusers and idbookmarks = $id"
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            "select * from bookmarks where idusers = $idusers"
            .' order by updatetime desc'
        );
    }

    static function indexOnTag ($idusers, $tag) {
        global $mysqli;
        $tag = mysqli_real_escape_string($mysqli, $tag);
        return mysqli_query_object(
            $mysqli,
            'select * from bookmarks t'
            ." where idusers = $idusers"
            .' and exists ('
            .'  select idbookmarks from bookmarktags bt'
            .'  where bt.idbookmarks = t.idbookmarks'
            ."  and bt.tagname = '$tag'"
            .' )'
            .' order by updatetime desc'
        );
    }

}
