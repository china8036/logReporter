<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Qqes\LogReporter;

/**
 * Description of DataProvider
 *
 * @author wang
 */
interface DataProvider {

    //根据appid 获取appkey
    public function getAppKeyByAppId($appid);
}
