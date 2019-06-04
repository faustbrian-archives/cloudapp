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

use Plients\Http\HttpResponse;

class Gift extends AbstractAPI
{
    public function redeem(string $code): HttpResponse
    {
        return $this->client->put("gift_cards/{$code}");
    }

    public function details(string $code): HttpResponse
    {
        return $this->client->get("gift_cards/{$code}");
    }
}
