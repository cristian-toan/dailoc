<?php

namespace Gaumap\Helpers;

class Response {
    
    public static function message($message = null) {
        self::responseFormat(200, __('Thành công', 'gaumap'), $message, null);
    }
    
    public static function data($message = null, $data = null) {
        self::responseFormat(200, __('Thành công', 'gaumap'), $message, $data);
    }
    
    public static function createSuccess($message = null) {
        self::responseFormat(201, __('Thành công', 'gaumap'), $message, null);
    }
    
    public static function badRequest($message = null) {
        self::responseFormat(400, __('Yêu cầu không hợp lệ', 'gaumap'), $message, null);
    }
    
    public static function objectNotFound() {
        self::responseFormat(404, __('Không tìm thấy', 'gaumap'), __('Không tìm thấy', 'gaumap'), null);
    }
    
    public static function error($message = null, $data = null) {
        self::responseFormat(500, __('Lỗi hệ thống', 'gaumap'), $message, $data);
    }
    
    public static function responseFormat($code, $title, $message, $data, $status = 'success') {
        wp_send_json([
                         'version' => '1.0',
                         'domain'  => get_bloginfo('url'),
                         'status'  => $status,
                         'code'    => $code,
                         'time'    => date('Y-m-d H:i:s', time()),
                         'message' => [
                             'title'  => $title,
                             'detail' => $message,
                         ],
                         'data'    => $data,
                     ], $code);
    }
    
}
