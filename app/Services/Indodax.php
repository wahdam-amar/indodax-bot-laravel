<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class Indodax
{
    private $key;
    private $secret;
    private $url;
    private $curl;
    private $user;

    /**
     * Get all Indodax API configuration and initialize curl
     */
    public function __construct()
    {
        $this->url    = config('indodax.private_api_url');
        $this->curl   = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; INDODAXCOM PHP client;' . php_uname('s') . '; PHP/' . phpversion() . ')');
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    }

    /**
     * Build request which will be sent to the API
     * @param String    $method     API method
     * @param Array     $data       API parameters to be sent
     */
    private function buildRequest($method, $data = [])
    {

        $data = [
            'method' => $method,
            'nonce'  => time()
        ];
        $data = http_build_query($data, '', '&');
        $headers = [
            'Sign: ' . hash_hmac('sha512', $data, $this->secret),
            'Key: '  . $this->key,
        ];
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
    }

    private function tradeRequest($method, $data = [])
    {
        $data = array_merge($data, array('method' => $method));

        if (!array_key_exists('nonce', $data)) {
            Log::warning('tidak ada');
            $data = array_merge($data, array('nonce' => time()));
        }

        debug($data);

        $data = http_build_query($data, '', '&');
        $headers = [
            'Sign: ' . hash_hmac('sha512', $data, $this->secret),
            'Key: '  . $this->key,
        ];
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Get response from builded query
     * @return StdClass     Response from Indodax API or null if failed
     */
    private function getResponse()
    {
        $response = null;
        try {
            curl_setopt($this->curl, CURLOPT_URL, $this->url);
            $res = curl_exec($this->curl);
            $res !== false ?: Log::warning('Could not get reply: ' . curl_error($this->curl));

            $response = json_decode($res);
            $response ?: Log::warning('Invalid data received, please make sure connection is working and requested API exists: ' . $res);

            curl_close($this->curl);
        } catch (Throwable $e) {
            Log::warning('an error occured while get response from indodax: ' . $e->getMessage());
        }
        return (object) $response;
    }

    /**
     * Get personal info of registered API account
     * @return StdClass     Personal Info
     */
    public function info()
    {
        $self = new self;
        $self->setUser($this->user);
        $self->buildRequest('getInfo');
        return $self->getResponse();
    }

    /**
     * Get personal transaction history of registered API account
     * @return StdClass             Transaction history
     */
    public function transhistory()
    {
        $self = new self;
        $self->buildRequest('transHistory');
        return $self->getResponse();
    }

    /**
     * Get personal trade history of registered API account
     * @return StdClass             Transaction history
     */
    public function tradehistory($pair = 'eth_idr')
    {
        $self = new self;
        $self->tradeRequest('tradeHistory', $pair);
        return $self->getResponse();
    }


    /**
     * Get personal order history of both order buy and sell.
     * @param String    $pair       Pair to get the information from ex: btc_idr, ltc_btc, doge_btc, etc
     * @param Integer   $count      Total requested record count
     * @param Integer   $from       Start index of order history
     * @return StdClass             Order History
     */
    public function orderHistory($pair = 'btc_idr', $count = 100, $from = 0)
    {
        $self = new self;
        $self->buildRequest('orderHistory', compact('pair', 'count', 'from'));
        return $self->getResponse();
    }

    /**
     * Get all open orders
     *
     * @return type
     * @throws conditon
     **/
    public function openOrders()
    {
        $self = new self;
        $self->setUser($this->user);
        $self->buildRequest('openOrders');
        return $self->getResponse()->return->orders ?? null;
    }


    /**
     * Get personal specific order details
     * @param Integer   $order_id   Order Id
     * @param String    $pair       Pair to get the information from ex: btc_idr, ltc_btc, doge_btc, etc
     * @return StdClass             Order details
     */
    public function orderDetails($order_id, $pair = 'btc_idr')
    {
        $self = new self;
        $self->buildRequest('getOrder', compact('pair', 'order_id'));
        return $self->getResponse();
    }

    public function makeOrder(String $pair, int $price, int $idr, String $type = 'buy')
    {
        $method = 'trade';
        $self = new self;
        $self->setUser($this->user);
        $self->tradeRequest('trade', compact('pair', 'type', 'price', 'idr'));
        return $self->getResponse();
    }

    /**
     * Set request to get last price of BTC/IDR
     * @return StdClass             Last Price of BTC/wIDR
     */
    public function lastBtcIdrPrice()
    {
        $self = new self;
        $self->url = config('indodax.btc_idr_ticker_url');
        return $self->getResponse();
    }

    /**
     * Get coin price
     * @return integer 
     */
    public function getCoinPrice($name, $amount = 1)
    {
        $self = new self;
        // $self->setUser($this->user);
        $self->url = config('indodax.ticker_url') . $name . '_idr/ticker';
        return $self->getResponse()->ticker->last * $amount;
    }

    /**
     * Get Saldo 
     **/
    public function getSaldoIdr()
    {

        $totalSaldo = collect();
        $info = collect($this->info());

        if (!$info->get('success') == 1) {
            return 0;
        }

        collect($info['return'])->only(['balance', 'balance_hold'])->each(function ($value, $key) use ($totalSaldo) {
            foreach (collect($value)->except('idr') as $coin => $amount) {
                if ($amount != "0.00000000") {
                    $totalSaldo->push((int) $this->getCoinPrice($coin, $amount));
                }
            }
            $totalSaldo->push((int) collect($value)->get('idr'));
        });

        return number_format($totalSaldo->sum());
    }

    public function pairs()
    {
        $self = new self;
        $self->url = config('indodax.ticker_url') . 'pairs';
        return $self->getResponse();
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        if (is_int($user)) {
            $this->user = User::find($user);
        } else {
            $this->user = $user;
        }

        if ($this->user->api()->exists()) {
            $this->user->load('api');
            $this->key    = $this->user->api->api_key;
            $this->secret = $this->user->api->secret_key;
        }

        return $this;
    }
}
