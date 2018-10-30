<?php
namespace Qqes\LogReporter;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Qqes\LogReporter;

/**
 * Description of SimpleDataProvider
 *
 * @author wang
 */
class SimpleDataProvider implements DataProvider {

    //put your code here

    private $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function getAppKeyByAppId($appid) {
        return isset($this->config[$appid]) ? $this->config[$appid] : '';
    }

}
