<?php

namespace PatrykSawicki\InPost\app\Classes;

use PatrykSawicki\InPost\app\Traits\functions;

class Api
{
    use functions;

    protected static ?string $dynamicApiKey = null;

    protected ?string $apiKey;
    protected string $url;

    public static function setApiKey(string $apiKey): void
    {
        self::$dynamicApiKey = $apiKey;
    }

    public function __construct()
    {
        // set api key from config or dynamic
        $this->apiKey = self::$dynamicApiKey ?? config('inPost.api_key');
        $this->url = config('inPost.sandbox') ? config('inPost.sandbox_url') : config('inPost.api_url');

        // check if api key is set
        if (is_null($this->apiKey)) {
            throw new \Exception('InPost API key is not set.');
        }
    }
}
