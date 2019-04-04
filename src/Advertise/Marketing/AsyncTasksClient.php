<?php
/**
 * Created by PhpStorm.
 * User: monday41
 * Date: 2019/4/3
 * Time: 4:22 PM
 */

namespace EasyWeChat\Advertise\Marketing;

use EasyWeChat\Kernel\Http\StreamResponse;
use Psr\Http\Message\ResponseInterface;

class AsyncTasksClient extends Client
{
    /**
     * Async task report file download endpoint
     *
     * @var string
     */
    protected $downloadBaseUri = 'https://dl.e.qq.com/v1.1/async_task_files/get';

    /**
     * Async task type
     *
     */
    const TASK_TYPE_AD_GROUP_HOURLY_REPORT = 'TASK_TYPE_ADGROUP_HOURLY_REPORT';

    /**
     * Aync task spec type
     */
    const TASK_SPEC_TYPE_AD_GROUP_HOURLY_REPORT = 'task_type_adgroup_hourly_report_spec';

    /**
     * Async task spec template list
     *
     * @var array
     */
    protected static $TASK_SPEC_TEMPLATE = [
        self::TASK_TYPE_AD_GROUP_HOURLY_REPORT  => [
            self::TASK_SPEC_TYPE_AD_GROUP_HOURLY_REPORT   => [
                "date"  => ""
            ],
        ],
    ];

    /**
     * Add advertise async task.
     *
     * @param string   $taskName
     * @param string   $taskType
     * @param array    $taskSpec
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function addHourlyTask(string $taskName, $date)
    {
        $taskSpec           = self::$TASK_SPEC_TEMPLATE[self::TASK_TYPE_AD_GROUP_HOURLY_REPORT];
        $taskSpec[self::TASK_SPEC_TYPE_AD_GROUP_HOURLY_REPORT]['date']    = $date;

        $params = [
            'task_name'     => $taskName,
            'task_type'     => self::TASK_TYPE_AD_GROUP_HOURLY_REPORT,
            'task_spec'     => $taskSpec,
        ];

        return $this->httpPostJson('marketing/async_tasks/add', $params, self::$DEFAULT_OPTION);
    }

    /**
     * Get advertise async tasks.
     *
     * @param array   $filtering
     * @param int     $page
     * @param int     $pageSize
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function tasks(array $filtering = [], int $page = 1, int $pageSize = 10)
    {
        $params = [
            'filtering'     => $filtering,
            'page'          => $page,
            'page_size'     => $pageSize,
        ] + self::$DEFAULT_OPTION;

        return $this->httpGet('marketing/async_tasks/get', $params);
    }

    /**
     * Download async task data as a table file.
     *
     * @param int     $taskId
     * @param int     $fileId
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @return \EasyWeChat\Kernel\Http\Response
     */
    public function taskFiles(int $taskId, int $fileId)
    {
        $response = $this->requestRaw('marketing/async_task_files/get', 'GET', [
            'query' => [
                    'task_id' => $taskId,
                    'file_id' => $fileId,
                ] + self::$DEFAULT_OPTION,
        ]);

        if (false !== stripos($response->getHeaderLine('Content-Type'), 'application/x-www-form-urlencoded')) {
            return $this->castResponseToType($response, 'raw');
        }

        return StreamResponse::buildFromPsrResponse($response);
    }
}
