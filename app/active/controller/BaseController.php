<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/4
 * Time: 17:36
 */

namespace app\active\controller;


use think\Config;
use think\Controller;
use think\Request;
use think\View;

class BaseController extends Controller
{

    public function __construct(Request $request = null)
    {
        // init Request Set
        if (is_null($request)) {
            $request = Request::instance();
        }
        $this->request = $request;

        // init View Set
        $this->_initializeView();
        $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));

        // Before
        $this->_initialize();
    }

    protected function _initialize()
    {
        //  TODO Something
        if (cmf_is_wechat()){
            $this->weerr();
        }
    }


    // 初始化视图配置  Copy Admin
    protected function _initializeView()
    {
        $cmfAdminThemePath    = config('template.cmf_admin_theme_path');
        $cmfAdminDefaultTheme = cmf_get_current_admin_theme();

        $themePath = "{$cmfAdminThemePath}{$cmfAdminDefaultTheme}";

        $root = cmf_get_root();

        //使cdn设置生效
        $cdnSettings = cmf_get_option('cdn_settings');
        if (empty($cdnSettings['cdn_static_root'])) {
            $viewReplaceStr = [
                '__ROOT__'     => $root,
                '__TMPL__'     => "{$root}/{$themePath}",
                '__STATIC__'   => "{$root}/static",
                '__WEB_ROOT__' => $root
            ];
        } else {
            $cdnStaticRoot  = rtrim($cdnSettings['cdn_static_root'], '/');
            $viewReplaceStr = [
                '__ROOT__'     => $root,
                '__TMPL__'     => "{$cdnStaticRoot}/{$themePath}",
                '__STATIC__'   => "{$cdnStaticRoot}/static",
                '__WEB_ROOT__' => $cdnStaticRoot
            ];
        }

        config('template.view_base', WEB_ROOT . "$themePath/");
        config('view_replace_str', $viewReplaceStr);
    }
}