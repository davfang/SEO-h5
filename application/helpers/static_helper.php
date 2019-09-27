<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Static Resource Library
  |--------------------------------------------------------------------------
  |
  | Some simple code to help manage/serve static
  | files efficiently.
  |
 */

/**
 * print the html tag to include js file or files
 * @param mixed $include file name or names
 */
function include_js($include) {
    if (is_array($include)) {
        foreach ($include as $file) {
            include_single_js($file);
        }
    } else {
        include_single_js($include);
    }
}

/**
 * print the html tag to include css file or files
 * @param mixed $include file name or names
 */
function include_css($include) {
    if (is_array($include)) {
        foreach ($include as $file) {
            include_single_css($file);
        }
    } else {
        include_single_css($include);
    }
}
/**
 * print the html tag to include css file or files
 * @param mixed $include file name or names
 */
function include_fonts($include) {
    if (is_array($include)) {
        foreach ($include as $file) {
            include_single_fonts($file);
        }
    } else {
        include_single_fonts($include);
    }
}
/**
 * print the html tag to include js file
 * @param string $file file name
 */
function include_single_js($file) {
    $uri = js_url($file); // . '?v=' . auto_version($file, 'js/');
    echo '<script type="text/javascript" src="' . $uri . '"></script>';
}

/**
 * print the html tag to include css file
 * @param string $file file name
 */
function include_single_css($file) {
    $uri = css_url($file); // . '?v=' . auto_version($file, 'css/');
    echo '<link rel="stylesheet" type="text/css" href="' . $uri . '">';
}
/**
 * print the html tag to include fonts file
 * @param string $file file name
 */
function include_single_fonts($file) {
    $uri = fonts_url($file); // . '?v=' . auto_version($file, 'css/');
    echo '<link rel="stylesheet" type="text/css" href="' . $uri . '">';
}
/**
 * create the js file url
 * @param string $file file name
 * @return string url of the js file
 */
function js_url($file) {
    return config_item('static_url') . 'js/' . $file;
}

/**
 * create the css file url
 * @param string $file file name
 * @return string url of the css file
 */
function css_url($file) {
    return config_item('static_url') . 'css/' . $file;
}

/**
 * create the fonts file url
 * @param string $file file name
 * @return string url of the fonts file
 */
function fonts_url($file) {
    return config_item('static_url') . 'fonts/' . $file;
}

/**
 * create the image url
 * @param string $file image file name
 * @return string image url
 */
function image_url($file) {
    return config_item('static_url') . 'images/' . $file;
}

/**
 * create the version number buy file modify time
 * @param string $filename file name
 * @param string $path last folder name, for example: css/, js/
 * @return int the version number
 */
function auto_version($filename, $path) {
    $base_dir = getcwd() . '/' . config_item('static_path');
    ;
    return filemtime(config_item('static_url') . $path . $filename);
}

function get_url($menu, $menu_tag) {
    if (empty($menu)) {
        return array();
    }
    $CI = &get_instance();
    $CI->config->load('menu', FALSE, TRUE);
    $menu_arr = $CI->config->item('menu');
    $spec_menu_arr = $CI->config->item('special_menu');
    $data = array();
    foreach ($menu as $key => $val) {
        if (!in_array($val['NewsClassID'], $spec_menu_arr)) {
            $val['URL'] = site_url($menu_arr[$menu_tag][$val['NewsClassID']]);
        }
        $data[] = $val;
    }
    return $data;
}

/* 面包屑 */

function get_bread($categoryid) {
    $CI = &get_instance();
    static $cat_arr = array();
    $CI->load->model('sqlsrv_model', 'sqlsrv');
    $row = $CI->sqlsrv->getProductCategorybyCategoryID('{call getProductCategorybyCategoryID(?)}', array($categoryid));
    if ($row[0]['ParentID'] == 0) {
        $cat_arr[] = $row[0];
    } else {
        $cat_arr[] = $row[0];
        get_bread($row[0]['ParentID']);
    }
    return $cat_arr;
}

function get_bread_str($catgoryid) {
    $arr = get_bread($catgoryid);
    $html = '';
    if (empty($arr)) {
        return $html;
    }
    if (count($arr) > 1) {
        $arr = array_reverse($arr);
        for ($i = 0; $i < count($arr); $i++) {
            if ($i == 0) {
                $html .= '&nbsp;/&nbsp;<a href="' . site_url('prolist/index?catid=' . $arr[$i]['ProductCategoryID']) . '">' . $arr[$i]['ProductCategory'] . '</a>';
            } else {
                $html .= '&nbsp;/&nbsp;<a href="' . site_url('prolist/index?catid=' . $arr[$i - 1]['ProductCategoryID']) . '&scatid=' . $arr[$i]['ProductCategoryID'] . '">' . $arr[$i]['ProductCategory'] . '</a>';
            }
        }
    } else {
        $html .= '&nbsp;/&nbsp;<a href="' . site_url('prolist/index?catid=' . $arr[0]['ProductCategoryID']) . '">' . $arr[0]['ProductCategory'] . '</a>';
    }
    return $html;
}

function checkMobile($mob) {
    if (strlen($mob) == 11) {
        return preg_match("/^1\d{10}$/", $mob) ? true : false;
    } else {
        return false;
    }
}

function ajax_return_success($msg,$data = array()) {
//    header('Content-type: application/json;charset=utf-8');
    $data = array(
        'code' =>0,
        'info' =>$msg,
        'data' => $data
    );
    echo json_encode($data);
    die;
}
function ajax_return_error($msg,$data = array()) {
//    header('Content-type: application/json;charset=utf-8');
    $data = array(
        'code' =>-1,
        'info' =>$msg,
        'data' => $data
    );
    echo json_encode($data);
    die;
}


function ajax_return_errors($msg,$data = array()) {
//    header('Content-type: application/json;charset=utf-8');
    $data = array(
        'code' =>-2,
        'info' =>$msg,
        'data' => $data
    );
    echo json_encode($data);
    die;
}

function ajax_return_errores($msg,$data = array()) {
//    header('Content-type: application/json;charset=utf-8');
    $data = array(
        'code' =>-3,
        'info' =>$msg,
        'data' => $data
    );
    echo json_encode($data);
    die;
}

/* End of file static_helper.php */
/* Location: ./application/helpers/static_helper.php */
