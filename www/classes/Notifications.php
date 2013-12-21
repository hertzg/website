<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';
include_once 'Channels.php';
include_once 'Notifications.php';
include_once 'Users.php';

class Notifications {

    static function add ($idusers, $idchannels, $channelname, $notificationtext) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into notifications'
                .' (idusers, idchannels, channelname, notificationtext, inserttime)'
                ." values (#u, #u, '#s', '#s', #u)",
                array($idusers, $idchannels, $channelname, $notificationtext, time())
            )
        );
        Channels::addNumNotifications($idusers, $idchannels, 1);
        Users::addNumNotifications($idusers, 1);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from notifications where idusers = $idusers"
        )->count;
    }

    static function deleteAll ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from notifications where idusers = #u',
                array($idusers)
            )
        );
        Channels::clearNumNotifications($idusers);
    }

    static function deleteOnChannel ($idusers, $idchannels) {
        global $mysqli;
        $notifications = self::index($idusers, $idchannels);
        Channels::addNumNotifications($idusers, $idchannels, -count($notifications));
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from notifications where idchannels = #u',
                array($idchannels)
            )
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from notifications where idusers = $idusers");
    }

    static function index ($idusers) {

        global $mysqli;

        $notifications = mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from notifications where idusers = #u',
                array($idusers)
            )
        );

        usort($notifications, function ($a, $b) {
            return $a->inserttime > $b->inserttime ? -1 : 1;
        });

        return $notifications;

    }

    static function indexOnChannel ($idusers, $idchannels) {

        global $mysqli;

        $notifications = mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from notifications'
                .' where idusers = #u and idchannels = #u',
                array($idusers, $idchannels)
            )
        );

        usort($notifications, function ($a, $b) {
            return $a->inserttime > $b->inserttime ? -1 : 1;
        });

        return $notifications;

    }

    static function textToHtml ($notificationtext) {
        return nl2br(
            preg_replace(
                '#(http://.*?)(\s|$)#',
                '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                htmlspecialchars($notificationtext)
            )
        );
    }

}
