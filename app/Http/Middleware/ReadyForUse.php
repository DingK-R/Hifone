<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class ReadyForUse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 去掉try catch,因为就算获取配置失败也会false
        // 产生歧义,实际要取数据库里的信息merge,容易理解为读取config/setting.php
        if (!Config::get('setting.site_name')) {
            return Redirect::to('install');
        }

        return $next($request);
    }
}
