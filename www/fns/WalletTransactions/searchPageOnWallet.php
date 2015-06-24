<?php

namespace WalletTransactions;

function searchPageOnWallet ($mysqli, $id_wallets,
    $keyword, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $fromWhere = "from wallet_transactions where id_wallets = $id_wallets"
        ." and description like '%$keyword%'";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time desc"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
