<?php

use App\Services\Indicators;
use App\Services\Indodax;

if (!function_exists('getCalculatePercentageChange')) {
    function getCalculatePercentageChange($original, $new): float
    {
        $diff = $new - $original;
        $increase = ($diff / $original) * 100;
        return $increase;
    }
}

if (!function_exists('getProfit')) {
    function getProfit(int $buy, int $increase): int
    {
        return $buy * $increase / 100;
    }
}

if (!function_exists('coinName')) {
    function coinName(String $coin): String
    {
        $formatCoin = str_replace('_', ' ', $coin);
        return strtoupper($formatCoin);
    }
}

if (!function_exists('formatTime')) {
    function formatTime(String $time): String
    {
        return (date("Y-m-d", $time));
    }
}

if (!function_exists('indodax')) {
    /**
     * Get indodax instance with auth user
     *
     * @return App\Services\Indodax
     */
    function indodax($user = null)
    {
        if (!auth()->check() && !is_null($user)) {
            return (new indodax);
        }

        return (new indodax)->setUser($user ?? auth()->id());
    }
}

if (!function_exists('indicator')) {
    /**
     * Get indodax instance with auth user
     *
     * @return App\Services\Indicators
     */
    function indicator($signal = []): Indicators
    {
        return (new Indicators($signal));
    }
}
