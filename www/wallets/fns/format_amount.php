<?php

function format_amount ($amount) {
    $amount = number_format($amount / 2, 2);
    if ($amount < 0) return "<span style=\"color: #911\">$amount</span>";
    return $amount;
}
