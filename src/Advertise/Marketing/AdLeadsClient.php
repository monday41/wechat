<?php
/**
 * Created by PhpStorm.
 * User: monday41
 * Date: 2019/4/3
 * Time: 4:22 PM
 */

namespace EasyWeChat\Advertise\Marketing;

class AdLeadsClient extends Client
{
    /**
     * Get Wechat advertise leads list.
     *
     * @param array   $dateRange
     * @param array   $filtering
     * @param int     $page
     * @param int     $pageSize
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function get(array $dateRange, array $filtering = [], int $page = 1, int $pageSize = 10)
    {
        $params = [
            'date_range'    => $dateRange,
            'filtering'     => $filtering,
            'page'          => $page,
            'page_size'     => $pageSize,
        ] + self::$DEFAULT_OPTION;

        return $this->httpGet('marketing/wechat_ad_leads/get', $params);
    }
}
