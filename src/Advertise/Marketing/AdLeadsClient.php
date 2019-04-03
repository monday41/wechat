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
     */
    public function get(array $dateRange, array $filtering, int $page = 1, int $pageSize = 10)
    {
        $params = [
            'date_range'    => json_encode($dateRange),
            'filtering'     => json_encode($filtering),
            'page'          => $page,
            'pageSize'      => $pageSize,
        ];

        return $this->httpGet('marketing/wechat_ad_leads/get', $params);
    }
}
