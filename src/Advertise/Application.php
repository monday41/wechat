<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Advertise;

use EasyWeChat\BasicService;
use EasyWeChat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author monday41
 *
 * @property \EasyWeChat\Advertise\Auth\AccessToken                           $access_token
 * @property \EasyWeChat\Advertise\Marketing\Client                           $marketing
 * @property \EasyWeChat\Advertise\Marketing\AdLeadsClient                    $adleads
 * @property \EasyWeChat\Advertise\Marketing\AsyncTasksClient                 $asynctasks
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Marketing\ServiceProvider::class,
        // Base services
        BasicService\QrCode\ServiceProvider::class,
        BasicService\Media\ServiceProvider::class,
        BasicService\Url\ServiceProvider::class,
        BasicService\Jssdk\ServiceProvider::class,
    ];
}
