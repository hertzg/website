<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class Bookmarks {

    static function add ($idusers, $title, $url, $tags) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
            $mysqli,
                'insert into bookmarks'
                .' (idusers, title, url, tags, inserttime, updatetime)'
                ." values (#u, '#s', '#s', '#s', #u, #u)",
                array($idusers, $title, $url, $tags, time(), time())
            )
        );
        return mysqli_insert_id($mysqli);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object($mysqli, "select count(*) count from bookmarks where idusers = $idusers")->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from bookmarks'
                .' where idusers = #u and idbookmarks = #u',
                array($idusers, $id)
            )
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from bookmarks where idusers = $idusers");
    }

    static function edit ($idusers, $id, $title, $url, $tags) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update bookmarks set'
                ." title = '#s',"
                ." url = '#s',"
                ." tags = '#s',"
                .' updatetime = #u'
                .' where idusers = #u and idbookmarks = #u',
                array($title, $url, $tags, time(), $idusers, $id)
            )
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from bookmarks'
                .' where idusers = #u and idbookmarks = #u',
                array($idusers, $id)
            )
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from bookmarks where idusers = #u'
                .' order by updatetime desc',
                array($idusers)
            )
        );
    }

    static function indexOnTag ($idusers, $tag) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from bookmarks t'
                .' where idusers = #u'
                .' and exists ('
                .'  select idbookmarks from bookmarktags bt'
                .'  where bt.idbookmarks = t.idbookmarks'
                ."  and bt.tagname = '#s'"
                .' )'
                .' order by updatetime desc',
                array($idusers, $tag)
            )
        );
    }

}
