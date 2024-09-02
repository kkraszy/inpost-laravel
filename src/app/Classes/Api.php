<?php

namespace PatrykSawicki\InPost\app\Classes;

use PatrykSawicki\InPost\app\Traits\functions;

class Api
{
    use functions;

    protected static ?string $dynamicApiKey = null;
    protected static ?bool $sandbox = null;

    protected ?string $apiKey;
    protected string $url;

    public static function setSandbox(bool $sandbox = true): void
    {
        self::$sandbox = $sandbox;
    }

    public static function setApiKey(string $apiKey): void
    {
        self::$dynamicApiKey = $apiKey;
    }

    public function __construct()
    {
        $sandbox = (self::$sandbox === null) ? config('inPost.sandbox') : self::$sandbox;

        // set api key from config or dynamic
        $this->apiKey = (self::$dynamicApiKey === null) ?? config('inPost.api_key');
        $this->url =  $sandbox ? config('inPost.sandbox_url') : config('inPost.api_url');

        // check if api key is set
        if (is_null($this->apiKey)) {
            throw new \Exception('InPost API key is not set.');
        }
    }
}
