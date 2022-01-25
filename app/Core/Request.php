<?php
/*
 * File: Request.php
 * Project: Core
 * File Created: Sunday, 23rd May 2021 8:22:46 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 25th January 2022 11:10:51 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

namespace App\Core;

use App\Core\Traits\Singleton;

class Request
{

    use Singleton;

    public $app;
    public $slug;
    public $uri;
    public $url;
    public $server;
    public $host;
    public $https;
    public $port;
    public $serverIp;
    public $requestIp;
    public $method;
    public $rawQueryString;
    public $queryStringArray;
    public $rawRequest;

    public function __construct($app)
    {
        $this->server = $_SERVER;
        $uri = $this->server['PHP_SELF'];
        $this->uri = $uri === "/" ? $uri : \preg_replace("/\/$/", '', $this->server['PHP_SELF']);
        if ($this->uri !== '/') {
            $this->uri = \preg_replace("/^\//", '', $this->uri);
        }

        $this->url = $this->server['REQUEST_URI'];
        $this->app = $app;

        // Why?
        // $this->slug = \preg_replace('/[_|\s|\/]/', '-', $this->uri);

        $this->slug = $this->uri;

        $this->host = $this->server['HTTP_HOST'] ?? null;
        $this->https = isset($this->server['HTTPS']) && $this->server['HTTPS'] === 'on' ? true : false;
        $this->port = $this->server['SERVER_PORT'] ?? null;
        $this->serverIp = $this->server['SERVER_ADDR'] ?? null;
        $this->requestIp = $this->server['REMOTE_ADDR'] ?? null;
        $this->method = $this->server['REQUEST_METHOD'] ?? null;
        $this->rawQueryString = $this->server['QUERY_STRING'] ?? null;
        $this->queryStringArray = $this->parseQueryString($this->rawQueryString);
    }

    /**
     * Parse the query string in the request
     *
     * @param string $query    The full query string to parse
     *
     * @return array
     */
    private function parseQueryString(string $query): array
    {
        $stringArr = explode("&", $query);
        if (!sizeOf($stringArr)) {
            return [];
        }

        $qs = [];
        foreach ($stringArr as $qsv) {
            $split = explode("=", $qsv);
            if (sizeof($split)) {
                $qs[$split[0]] = $split[1] ?? null;
            }
        }

        return $qs;
    }

    /**
     * Read all input into the app
     *
     * @return array
     */
    public function all(): array
    {
        return array_merge([], $_REQUEST, $this->queryStringArray);
    }

    /**
     * Get an input of the request
     * @param string $key       The input key to get
     * @param string $default   The default value
     */
    public function input($key = null, $default = null)
    {

        if (!$key) {
            return $this->all();
        }

        return $this->all()[$key] ?? $default;

        return input($key, $default);
    }

    /**
     * Read from the query string
     * @param string $key       The key to get
     * @param string $default   The default value
     */
    public function query($key, $default = null)
    {
        return $this->queryString[$key] ?? $default;
    }

    /**
     * Get the raw request
     */
    public function getContent()
    {
        return $this->rawRequest;
    }

    public function accepts($key): bool
    {
        $accept = explode(",", $this->server['HTTP_ACCEPT']);
        return $accept[$key] ? true : false;
    }

}
