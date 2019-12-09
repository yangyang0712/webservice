<?php

namespace Overtrue\Webservice;

use GuzzleHttp\Client;
use Overtrue\Webservice\Exceptions\HttpException;
use Overtrue\Webservice\Exceptions\InvalidArgumentException;

class GeographyCode
{
    protected $key;
    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getGeographyCode($address, $city = false, string $format = 'json')
    {
        $url = "https://restapi.amap.com/v3/geocode/geo";

        if (!in_array($format, ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: ' . $format);
        }

        $query = array_filter([
            'key'     => $this->key,
            'address' => $address,
            'city'    => $city,
            'output'  => $format,
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

            // 4. 返回值根据 $format 返回不同的格式，
            // 当 $format 为 json 时，返回数组格式，否则为 xml。
            return $format === 'json' ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            // 5. 当调用出现异常时捕获并抛出，消息为捕获到的异常消息，
            // 并将调用异常作为 $previousException 传入。
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}