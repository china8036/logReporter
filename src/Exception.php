<?php
namespace Qqes\LogReporter;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Exception as BaseException;
/**
 * Description of Exception
 *
 * @author wang
 */
class Exception extends BaseException {
    //put your code here
    
    const SIGN_NOT_MATCH = -1;
    
    
    
    const SIGN_TIMEOUT  = -2;
}
