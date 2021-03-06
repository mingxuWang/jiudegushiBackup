<?php
/*
Plugin Name: Hermit
Plugin URI: http://mufeng.me/hermit-for-wordpress.html
Description: Wordpress 音乐播放器 Hermit music player for wordpress
Version: 1.9.1
Author: Mufeng
Author URI: http://mufeng.me
*/

define('HERMIT_VERSION', '1.9.1');
define('HERMIT_URL', plugins_url('', __FILE__));
define('HERMIT_PATH', dirname( __FILE__ ));
define('HERMIT_ADMIN_URL', admin_url());

global $HMT, $HMTJSON;

require HERMIT_PATH . '/class.json.php';
require HERMIT_PATH . '/class.hermit.php';

if(!isset($HMT)){
	$HMT = new hermit();
}

if(!isset($HMTJSON)){
	$HMTJSON = new HermitJson();
}

/**
 * 定义数据库
 */
global $wpdb, $hermit_table_name, $hermit_cat_name;
$hermit_table_name = $wpdb->prefix . 'hermit';
$hermit_cat_name = $wpdb->prefix . 'hermit_cat';

/**
 * 加载类
 */
//require HERMIT_PATH . '/class.hermit.php';

/**
 * 加载函数
 */
require HERMIT_PATH . '/hermit.functions.php';

/**
 * 插件激活,新建数据库
 */
register_activation_hook(__FILE__, 'hermit_install');

/**
 * 插件停用, 删除数据库
 */
//register_deactivation_hook(__FILE__, 'hermit_uninstall');