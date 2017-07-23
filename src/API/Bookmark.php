<?php

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
use BrianFaust\CloudApp\Models\Item;

class Bookmark extends AbstractAPI
{
    public function single(string $redirect_url, array $parameters = []): HttpResponse
    {
        return $this->client->post('items', [
            'item' => compact('redirect_url') + $parameters,
        ]);
    }

    public function multi(string $redirect_url, array $parameters = []): HttpResponse
    {
        return $this->client->post('items', [
            'items' => compact('redirect_url') + $parameters,
        ]);
    }
}
