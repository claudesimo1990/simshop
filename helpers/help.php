<?php

/**
 * @author Claude Simo <jeanclaude.simo@abus-kransysteme.de>
 * @copyright ABUS Kransysteme GmbH
 * @license proprietary
 */

use App\Models\Product;

if (! function_exists('format_price')) {

    function format_price(string $price): string
    {
        return $price . '€';
    }
}
if (! function_exists('getProduct')) {
    function getProduct(string $id): Product
    {
        return Product::find($id);
    }
}
