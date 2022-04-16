<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;
use function Symfony\Component\String\s;

class ConvertCurrency
{
    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();

            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }


    public static function convert($summ)
    {
        self::loadContainer();

        $codeFromContainer = session('currency', 'RUB');

        $targetCurrency = self::$container[$codeFromContainer];

//        dd($targetCurrency->created_at->startOfDay());
        if ($targetCurrency->rate != 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()){
            CurrencyRates::getRates();
            self::loadContainer();
            $targetCurrency = self::$container[$codeFromContainer];
        }

        return round($summ / (is_null($targetCurrency->rate) ? 1 : $targetCurrency->rate), 2);
    }


    public static function getCurrencySimbol()
    {
        self::loadContainer();
        return self::$container[session('currency', 'RUB')]->simbol;
    }

    public static function getCurrencies()
    {
        self::loadContainer();
        return self::$container;
    }


    public static function getBaseCurrency()
    {
        self::loadContainer();
        foreach (self::$container as $code => $currency) {
            if ($currency->isMain()){
                return $currency;
            }
        }
    }

}
