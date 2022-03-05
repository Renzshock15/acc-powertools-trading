<?php

// Get product sale price (Price - Discount)
function minusPercentage($original_price, $percentage)
{
    if (intval($percentage) == 0) {
        return $original_price;
    } else {
        $divide_discount = intval($percentage) / 100;
        $total_discount = $divide_discount * intval($original_price);
        $sale_price = intval($original_price) - $total_discount;
        return number_format($sale_price, 2, '.', '');
    }
}
