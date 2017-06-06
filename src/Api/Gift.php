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

class Gift extends AbstractApi
{
    public function redeem($code)
    {
        $response = $this->put("gift_cards/$code");

        return $this->getMapper()->raw($response);
    }

    public function details($code)
    {
        $response = $this->get("gift_cards/$code");

        return $this->getMapper()->raw($response);
    }
}
