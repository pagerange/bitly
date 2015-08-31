<?php

/**
 * Bitly
 * A simple class to use with the Bitly API.
 * Requires a Bit.ly API access token.
 * @contact Steve George <steve@pagerange.com>
 * @created 2015-08-25
 * @updated 2015-08-25
 */

namespace Pagerange\Bitly;

class Bitly
{

    /**
     * Bitly API Access Token
     * @var String
     */
    private $access_token;

    /**
     * Set up Bitly object with access token
     * @param $access_token
     */
    public function __construct($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Convert a long url to a short url using Bitly API
     * @param $long_url
     * @return String a Bit.ly url | bool false
     * @throws Exception
     */
    public function url($long_url)
    {

        $get = 'https://api-ssl.bitly.com/v3/shorten?access_token=' .
            $this->access_token. '&longUrl=' . urlencode($long_url);

        if(!$response = json_decode(file_get_contents($get))) {
            throw new Exception('Could not retrieve Bitly link');
        }

        if(is_object($response) && $response->status_code == 200) {
            $data = $response->data;
            return $data->url;
        } else {
            return false;
        }
    }

}
