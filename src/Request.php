<?php

namespace Qqes\LogReporter;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author wang
 */
class Request {

    /**
     *
     * @var string 
     */
    private $appid;

    /**
     *
     * @var string 
     */
    private $appkey;

    /**
     * @var DataPrivoder
     */
    private $dataPrivoder;

    /**
     *
     * @var string
     */
    private $log_file;

    /**
     *
     * @var string 
     */
    private $logs;

    public function __construct(DataProvider $dataPrivoder) {
        $this->dataPrivoder = $dataPrivoder;
        $this->verSign();
    }

    /**
     * 验证签名
     * @return boolean
     * @throws Exception
     */
    private function verSign() {
        $this->log_file = $this->getHeaderValue('HTTP_REPORT_FILE');
        $report_timestamp = $this->getHeaderValue('HTTP_REPORT_TIME');
        $this->appid = $this->getHeaderValue('HTTP_REPORT_APPID');
        $md5 = $this->getHeaderValue('HTTP_REPORT_MD5');
        $this->logs = file_get_contents("php://input");
        $this->appkey = $this->dataPrivoder->getAppKeyByAppId($this->appid);
        $sign = md5($this->log_file . '|' . $this->logs . '|' . $report_timestamp . '|' . $this->appkey);
        if ($sign != $this->getHeaderValue('HTTP_REPORT_MD5')) {
            throw new Exception('sign not match', Exception::SIGN_NOT_MATCH);
        }
        if (abs($report_timestamp - time()) > 60) {
            throw new Exception('illegal request 2', Exception::SIGN_TIMEOUT);
        }
        return true;
    }

    /**
     * 获取Header数据
     * @param string $key
     * @return string
     */
    private function getHeaderValue($key) {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : '';
    }

    /**
     * 获取上报的日志
     * @return string
     */
    public function getLogs() {
        return $this->logs;
    }
    
    /**
     * 获取appid
     * @return type
     */
    public function getAppid(){
        return $this->appid;
    }

    /**
     * 获取上报的文件名称
     * @return string
     */
    public function getLogFile() {
        return $this->log_file;
    }

}
