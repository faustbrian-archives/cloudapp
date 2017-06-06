<?php

/*
 * This file is part of CloudApp PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\CloudApp;

use BrianFaust\Unified\AbstractHttpClient;
use BrianFaust\CloudApp\Request\Modifiers\AuthenticationModifier;

class HttpClient extends AbstractHttpClient
{
    protected $options = [
        'base_url' => 'https://my.cl.ly/',
        'headers' => [
            'Accept' => 'application/json',
            'User-Agent' => 'BrianFaust/CloudApp',
        ],
    ];

    protected $requestModifiers = [AuthenticationModifier::class];
}
