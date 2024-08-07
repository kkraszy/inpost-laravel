<?php

namespace PatrykSawicki\InPost\app\Classes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SendingMethods extends Api
{
    /**
     * Get a list of the available services.
     *
     * @param bool $returnJson
     * @return string|array
     */
    public function list(bool $returnJson = false)
    {
        $cacheName = 'inPost_sendingMethods_' . $returnJson;

        return Cache::remember($cacheName, config('inPost.cache_time'), function () use ($returnJson) {
            $route = '/v1/sending_methods';

            $data = [];

            $response = Http::withHeaders($this->requestHeaders())->get($this->url . $route, $data);

            if ($response->status() != 200)
                abort(400, $response->body());

            return $returnJson ? $response->body() : json_decode($response->body(), true);
        });
    }
}
