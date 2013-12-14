<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Contacts {

    static function add ($idusers, $fullname, $address, $email, $phone1, $phone2) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into contacts'
                .' (idusers, fullname, address, email, phone1, phone2)'
                ." values (#u, '#s', '#s', '#s', '#s', '#s')",
                array($idusers, $fullname, $address, $email, $phone1, $phone2)
            )
        );

        return mysqli_insert_id($mysqli);

    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object($mysqli, "select count(*) count from contacts where idusers = $idusers")->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from contacts'
                .' where idusers = #u and idcontacts = #u',
                array($idusers, $id)
            )
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from contacts where idusers = $idusers");
    }

    static function edit ($idusers, $id, $fullname, $address, $email, $phone1, $phone2) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update contacts set'
                ." fullname = '#s',"
                ." address = '#s',"
                ." email = '#s',"
                ." phone1 = '#s',"
                ." phone2 = '#s'"
                .' where idusers = #u and idcontacts = #u',
                array($fullname, $address, $email, $phone1, $phone2, $idusers, $id)
            )
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from contacts'
                .' where idusers = #u and idcontacts = #u',
                array($idusers, $id)
            )
        );
    }

    static function getByFullName ($idusers, $fullname, $excludeid = null) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from contacts'
                .' where idusers = #u'
                ." and fullname = '#s'"
                .' and idcontacts != #u',
                array($idusers, $fullname, $excludeid)
            )
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from contacts'
                .' where idusers = #u'
                .' order by fullname',
                array($idusers)
            )
        );
    }

    static function search ($idusers, $keyword) {
        global $mysqli;
        $keyword = str_replace(array('\\', '%', '_'), array('\\\\', '\\%', '\\_'), $keyword);
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from contacts'
                ." where idusers = #u and fullname like '%#s%'"
                .' order by fullname',
                array($idusers, $keyword)
            )
        );
    }
}
