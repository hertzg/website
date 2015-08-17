<?php

function amount_html ($amount) {
    $amount = number_format($amount / 100, 2);
    if ($amount < 0) return "<span style=\"color: #e51919\">$amount</span>";
    return $amount;
}
