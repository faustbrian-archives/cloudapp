<?php

/*
 * This file is part of CloudApp PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\CloudApp\Request\Modifiers;

use BrianFaust\Contracts\HttpClient;
use BrianFaust\Modifiers\AbstractModifier;

class AuthenticationModifier extends AbstractModifier
{
    public function apply()
    {
        $httpClient = $this->httpClient;

        $httpClient->setDefaultOption('auth', [
            $httpClient->getConfig('username'),
            $httpClient->getConfig('password'),
            'digest',
        ]);

        return $httpClient;
    }
}
