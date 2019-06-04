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

class Items extends AbstractAPI
{
    public function changeSecurity(string $item, bool $private): HttpResponse
    {
        return $this->client->put($item, ['item' => compact('private')]);
    }

    public function destroy(string $href): HttpResponse
    {
        return $this->client->delete($href);
    }

    public function items(array $parameters = []): HttpResponse
    {
        return $this->client->get('http://my.cl.ly/items', $parameters);
    }

    public function recover(string $href, string $deleted_at): HttpResponse
    {
        return $this->client->put($href, ['deleted' => true, 'item' => compact('deleted_at')]);
    }

    public function rename(string $href, string $name): HttpResponse
    {
        return $this->client->put($href, ['item' => compact('name')]);
    }

    public function addFile(string $path): HttpResponse
    {
        $s3 = $this->client->get('items/new', compact('private'));

        if (isset($s3['uploads_remaining']) && $s3['uploads_remaining'] < 1) {
            throw new Exception('Insufficient uploads remaining. Please consider upgrading to CloudApp Pro.');
        }

        $params = $s3['params'] + ['file' => fopen($path, 'r')];

        $location = $this->upload($s3['url'], $params);

        return $this->client->get($location);
    }

    public function domainDetails(string $href): HttpResponse
    {
        return $this->client->get($href);
    }

    public function item(string $href): HttpResponse
    {
        return $this->client->get($href);
    }

    private function upload(string $url, string $body): HttpResponse
    {
        return $this
            ->client
            ->asMultipart()
            ->withoutRedirecting()
            ->post($url, compact('body'))
            ->header('Location');
    }
}
