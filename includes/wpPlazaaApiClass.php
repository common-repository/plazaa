<?php

if (!class_exists('wpPlazaaApiClass')) {

class wpPlazaaApiClass
{
    private $apiHost = 'http://api.plazaa.de/api/';
    private $cacheData = array();
    private $cacheTimeout = 8;
    
    public function __construct()
    {
        $this->cacheTimeout = get_option('plazaaCacheTimeout');
    }
    
    public function getUserRatings($userName, $limit)
    {
        if (!$userName) {
            return array();
        }
        
        $method = 'ratings/list';
        $params = array(
            'userName' => $userName,
            'limit' => $limit
        );

        $data = $this->getFromCache($method, $params);

        if ($data !== false) {
            return $data;
        } 

        $url = $this->makeUrl($method, $params);
        $data = $this->makeApiRequest($url);
 
        if ($data['status'] == 0) {
            $data = $data['data'];
            $this->storeInCache($method, $params, $data);
        } else {
            $data = array();
        }

        return $data;
    }
    
    public function getProfile($userName)
    {
        if (!$userName) {
            return array();
        }
        
        $method = 'users/detail';
        $params = array(
            'userName' => $userName
        );

        $data = $this->getFromCache($method, $params);

        if ($data !== false) {
            return $data;
        } 

        $url = $this->makeUrl($method, $params);
        $data = $this->makeApiRequest($url);
 
        if ($data['status'] == 0) {
            $data = $data['data'];
            $this->storeInCache($method, $params, $data);
        } else {
            $data = array();
        }

        return $data;
    }
    
    public function getFromCache($method, $params)
    {
        $this->retrieveCache();
        if (!isset($this->cacheData[$method])) {
            return false;
        }
        
        $data = $this->cacheData[$method];
        if ($data['params'] != $params) {
            return false;
        } 

        $timeCacheTimeout = $data['timestamp'] + 60 * 60 * $this->cacheTimeout;
        if ($timeCacheTimeout < time()) {
            return false;
        }

        return $data['data'];
    }

    public function storeInCache($method, $params, $data)
    {
        $this->retrieveCache();

        $this->cacheData[$method] = array(
            'timestamp' => time(),
            'params' => $params,
            'data' => $data
        );

        $this->storeCache();
    }

    public function retrieveCache()
    {
        $this->cacheData = get_option('plazaaCache');
        if (!$this->cacheData) {
            $this->cacheData = array();
        }
    }

    public function storeCache()
    {
        update_option('plazaaCache', $this->cacheData);
    }

    public function makeUrl($method, $params)
    {
        $url = $method;
        foreach ($params as $name => $value) {
            $url .= '/' . $name . ':' . $value;
        }

        return $url;
    }

    public function makeApiRequest($url)
    {
        $url = $this->apiHost . $url;
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
        } else {
            $response = file_get_contents($url);
        }
        
        return json_decode($response, true);
    }
}

}

