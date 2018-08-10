<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;


$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'ciel_w', // 여기 db 사용자명
    'password' => 'Hw2656110*', // 여기 db 비번
    'database' => 'ciel_w', // DB 이름
    'dbdriver' => 'mysqli', // 가능하면 mysqli 권장. (php7 부턴 mysql 함수는 없음)
    'dbprefix' => '', // 이건 비어두셈
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci', // 자신의 DB 설정에 맞게 변경
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
