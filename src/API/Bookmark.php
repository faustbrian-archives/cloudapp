<?php

declare(strict_types=1);

/*
 * This file is part of CloudApp PHP Client.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plients\CloudApp\API;

use Plients\CloudApp\Models\Item;
use Plients\Http\HttpResponse;

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
