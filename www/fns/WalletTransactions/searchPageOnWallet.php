<?php

namespace WalletTransactions;

function searchPageOnWallet ($mysqli, $id_wallets,
    $includes, $excludes, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $fromWhere = "from wallet_transactions where id_wallets = $id_wallets";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $fromWhere .= " and description like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $fromWhere .= " and description not like '%$exclude%'";
    }

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time desc"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
