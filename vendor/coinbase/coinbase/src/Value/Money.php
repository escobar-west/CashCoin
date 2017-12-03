<?php

namespace Coinbase\Wallet\Value;

use Coinbase\Wallet\Enum\CurrencyCode;

class Money
{
    private $amount;
    private $currency;

    /**
     * Creates a new bitcoin money object.
     *
     * @return Money A new money instance
     */
    public static function btc($amount)
    {
        return new static($amount, CurrencyCode::BTC);
    }

    public static function eth($amount)
    {
        return new static($amount, CurrencyCode::ETH);
    }

    public function __construct($amount, $currency)
    {
        $this->amount = (string) $amount;
        $this->currency = $currency;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}
