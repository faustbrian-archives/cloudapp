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
use GuzzleHttp\Post\PostFile;
use BrianFaust\CloudApp\Models\Item;

class Items extends AbstractApi
{
    public function changeSecurity($item, $private)
    {
        $this->setFormParameters(['item' => compact('private')]);

        $response = $this->put($item);

        return $this->getMapper()->raw($response);
    }

    public function destroy($href)
    {
        $response = $this->delete($href);

        return $this->getMapper()->raw($response);
    }

    public function items($page = 1, $per_page = 5, $type = null, $deleted = false, $source = null)
    {
        $this->setQuery(compact('page', 'per_page', 'type', 'deleted', 'source'));

        $response = $this->get('http://my.cl.ly/items');

        return $this->getMapper()->raw($response);
    }

    public function recover($href, $deleted_at)
    {
        $this->setFormParameters(['deleted' => true, 'item' => compact('deleted_at')]);

        $response = $this->put($href);

        return $this->getMapper()->raw($response);
    }

    public function rename($href, $name)
    {
        $this->setFormParameters(['item' => compact('name')]);

        $response = $this->put($href);

        return $this->getMapper()->raw($response);
    }

    public function addFile($path)
    {
        $this->setFormParameters();

        // Check if file exists
        if (! file_exists($path)) {
            throw new Exception('File at path \''.$path.'\' not found');
        }

        // Check if path points to a file
        if (! is_file($path)) {
            throw new Exception('Path \''.$path.'\' doesn\'t point to a file');
        }

        // Check if file is readable
        if (! is_readable($path)) {
            throw new Exception('File at path \''.$path.'\' isn\'t readable');
        }

        // Request S3 data
        $this->setQuery(compact('private'));
        $s3 = $this->get('items/new');

        // Check if we can upload
        if (isset($s3['uploads_remaining']) && $s3['uploads_remaining'] < 1) {
            throw new Exception('Insufficient uploads remaining. Please consider upgrading to CloudApp Pro');
        }

        // Create body and upload file
        $params = [];
        foreach ($s3['params'] as $key => $value) {
            $params[$key] = $value;
        }
        // $params['file'] = new PostFile('file', fopen($path, 'r'));
        $this->setMultipart('file', fopen($path, 'r'));

        $location = $this->upload($s3['url'], $params);

        // finish upload
        $response = $this->get($location);

        return $this->getMapper()->raw($response);
    }

    public function domainDetails($href)
    {
        $response = $this->get($href);

        return $this->getMapper()->raw($response);
    }

    public function item($href)
    {
        $response = $this->get($href);

        return $this->getMapper()->raw($response);
    }

    private function upload($url, $body)
    {
        $this->setFormParameters([
            'headers' => ['Content-Type' => 'multipart/form-data'],
            'body' => $body,
            'allow_redirects' => false,
        ]);

        return $this->post($url)->getHeader('Location');

        // $client = new \GuzzleHttp\Client();

        // $response = $client->post($url, [
        //     'headers' => ['Content-Type' => 'multipart/form-data'],
        //     'body' => $body,
        //     'allow_redirects' => false,
        // ]);

        // return $response->getHeader('Location');
    }
}
