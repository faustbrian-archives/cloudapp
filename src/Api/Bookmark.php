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
use BrianFaust\CloudApp\Models\Item;

class Bookmark extends AbstractApi
{
    public function single($redirect_url, $name = null, $private = false)
    {
        $this->setFormParameters(['item' => compact('name', 'redirect_url')]);

        $response = $this->post('items');

        return $this->getMapper()->raw($response);
    }

    public function multi($redirect_url, $name = null, $private = false)
    {
        $this->setFormParameters(['items' => compact('name', 'redirect_url')]);

        $response = $this->post('items');

        return $this->getMapper()->raw($response);
    }
}
