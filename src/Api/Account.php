<?php

/*
 * This file is part of CloudApp PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\CloudApp\Api;

use BrianFaust\Unified\AbstractApi;
use BrianFaust\CloudApp\Models\Account;

class Account extends AbstractApi
{
    public function changeSecurity($private_items)
    {
        $this->setFormParameters(['user' => compact('private_items')]);

        $response = $this->put('account');

        return $this->getMapper()->raw($response);
    }

    public function changeMail($email, $current_password)
    {
        $this->setFormParameters(['user' => compact('email', 'current_password')]);

        $response = $this->put('account');

        return $this->getMapper()->raw($response);
    }

    public function changePassword($password, $current_password)
    {
        $this->setFormParameters(['user' => compact('password', 'current_password')]);

        $response = $this->put('account');

        return $this->getMapper()->raw($response);
    }

    public function forgotPassword($email)
    {
        $this->setFormParameters(['user' => compact('email')]);

        return $this->post('reset');
    }

    public function register($email, $password, $accept_tos = true)
    {
        $this->setFormParameters(['user' => compact('email', 'password', 'accept_tos')]);

        $response = $this->post('register');

        return $this->getMapper()->raw($response);
    }

    public function setCustomDomain($domain, $domain_home_page)
    {
        $this->setFormParameters(['user' => compact('domain', 'domain_home_page')]);

        $response = $this->put('account');

        return $this->getMapper()->raw($response);
    }

    public function details()
    {
        $response = $this->get('account');

        return $this->getMapper()->raw($response);
    }

    public function stats()
    {
        $response = $this->get('account/stats');

        return $this->getMapper()->raw($response, $this->modelStat);
    }
}
