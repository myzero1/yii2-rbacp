<?php

namespace rbacp\components;
/**
 * 执行字符串中的php
 *
 * @author qinxuanwu
 *
 */
class ExecPHPString {
    private $string;
    private $position;
    public function stream_open($path, $mode, $options, &$opened_path) {
        $url = parse_url($path);
        $input = $url["host"];
        //构造php文件
        $this->string = '<?php ' . $input;
        $this->position = 0;
        return true;
    }
    public function stream_read($count) {
        $ret = substr($this->string, $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }
    public function stream_eof() {}
    public function stream_stat() {}

    /**
     * 执行字符串中的php
     *
     * 调用实例：ExecPHPString::exec('function test(){ $a=1; return $a; }  return test();');
     *
     * @param   string $input
     * @return  midex
     **/
    public static function exec($input){
        stream_wrapper_register("var", __CLASS__);
        include('var://function test(){ $a=1; } test();echo 123; ');
        exit;
        // $input = "function test(){echo 'It is working!';} test();echo 123;";
        $url = sprintf('var://%s', $input);
        return include ($url);
    }
}