<?php

namespace App\Services;

class Indicators
{
    private $url = 'https://api.taapi.io/bulk';
    private $query;
    private $curl;
    private $exchange;
    private $symbol;
    private $interval;


    public function __construct()
    {
        // create curl resource 
        $this->curl = curl_init($this->url);
    }

    /**
     * Get result
     *
     * @return Collection
     */
    public function get($signal = [])
    {
        $this->query = json_encode((object) array(

            "secret" => config('indodax.tap_secret'),
            "construct" => (object) array(
                "exchange" => $this->exchange ?? "binance",
                "symbol" => $this->symbol ?? "ETH/USDT",
                "interval" => $this->interval ?? "1h",
                "indicators" => array(
                    (object) array(
                        // Relative Strength Index
                        "id" => "rsi",
                        "indicator" => "rsi"
                    ),
                    (object) array(
                        // Chaikin Money Flow
                        "id" => "stoch",
                        "indicator" => "stoch"
                    ),
                    (object) array(
                        // MACD Backtracked 1
                        "id" => "macd",
                        "indicator" => "macd"
                    ),
                )
            )

        ));

        // Add query to CURL
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->query);

        // Define the content-type to JSON
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of printing.
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        // Send request.
        $result = curl_exec($this->curl);

        // Close curl resource to free up system resources 
        curl_close($this->curl);

        if ($signal) {
            return collect(optional(json_decode($result))->data)->filter(function ($value, $key) use ($signal) {
                return in_array($value->id, $signal);
            });
        }

        return collect(optional(json_decode($result))->data);
    }

    /**
     * Set the value of exchange
     *
     * @return  self
     */
    public function exchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Set the value of symbol
     *
     * @return  self
     */
    public function symbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Set the value of interval
     *
     * @return  self
     */
    public function interval($interval)
    {
        $this->interval = $interval;

        return $this;
    }
}
