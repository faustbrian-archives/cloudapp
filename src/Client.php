<?php

/*
 * This file is part of CloudApp PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\CloudApp;

use BrianFaust\Http\Http;

class Client
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Create a new client instance.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Create a new API service instance.
     *
     * @param string $name
     *
     * @return \BrianFaust\CloudApp\API\AbstractAPI
     */
    public function api(string $name): API\AbstractAPI
    {
        $client = Http::create()
            ->withBaseUri('https://my.cl.ly/v3/')
            ->withDigestAuth($this->username, $this->password);

        $class = "BrianFaust\\CloudApp\\API\\{$name}";

        return new $class($client);
    }
}
