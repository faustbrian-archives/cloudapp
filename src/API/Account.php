<?php

declare(strict_types=1);

/*
 * This file is part of CloudApp PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\CloudApp\API;

use BrianFaust\Http\HttpResponse;
use BrianFaust\CloudApp\Models\Account;

class Account extends AbstractAPI
{
    public function changeSecurity(string $private_items): HttpResponse
    {
        return $this->client->put('account', [
            'user' => compact('private_items'),
        ]);
    }

    public function changeMail(string $email, string $current_password): HttpResponse
    {
        return $this->client->put('account', [
            'user' => compact('email', 'current_password'),
        ]);
    }

    public function changePassword(string $password, string $current_password): HttpResponse
    {
        return $this->client->put('account', [
            'user' => compact('password', 'current_password'),
        ]);
    }

    public function forgotPassword(string $email): HttpResponse
    {
        return $this->client->post('reset', [
            'user' => compact('email'),
        ]);
    }

    public function register(string $email, string $password, bool $accept_tos = true): HttpResponse
    {
        return $this->client->post('register', [
            'user' => compact('email', 'password', 'accept_tos'),
        ]);
    }

    public function setCustomDomain(string $domain, string $domain_home_page): HttpResponse
    {
        return $this->client->put('account', [
            'user' => compact('domain', 'domain_home_page'),
        ]);
    }

    public function details(): HttpResponse
    {
        return $this->client->get('account');
    }

    public function stats(): HttpResponse
    {
        return $this->client->get('account/stats');
    }
}
