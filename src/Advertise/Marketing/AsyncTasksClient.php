<?php
/**
 * Created by PhpStorm.
 * User: monday41
 * Date: 2019/4/3
 * Time: 4:22 PM
 */

namespace EasyWeChat\Advertise\Marketing;

class AsyncTasksClient extends Client
{
    /**
     * Async task report file download endpoint
     *
     * @var string
     */
    protected $downloadEndpoint = 'https://dl.e.qq.com/v1.1';

    /**
     * Async task type
     *
     */
    const TASK_TYPE_AD_GROUP_HOURLY_REPORT = 'TASK_TYPE_AGENCY_ADGROUP_HOURLY_REPORT';

    /**
     * Async task spec template list
     *
     * @var array
     */
    protected static $TASK_SPEC_TEMPLATE = [
        'TASK_TYPE_AGENCY_ADGROUP_HOURLY_REPORT'  => [
            "task_type_agency_adgroup_hourly_report_spec"   => [
                "date"  => "%s"
            ],
        ],
    ];

    /**
     * Add advertise async task
     *
     * @param string   $taskName
     * @param string   $taskType
     * @param array    $taskSpec
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     */
    public function addHourlyTask(string $taskName, $date)
    {
        $taskSpec           = sprintf(self::$TASK_SPEC_TEMPLATE[self::TASK_TYPE_AD_GROUP_HOURLY_REPORT], $date);

        $params = [
            'version'       => self::VERSION,
            'task_name'     => $taskName,
            'task_type'     => self::TASK_TYPE_AD_GROUP_HOURLY_REPORT,
            'task_spec'     => json_encode($taskSpec),
        ];

        return $this->httpPostJson('marketing/async_tasks/add', $params);
    }

    /**
     * Get advertise async tasks
     *
     * @param array   $filtering
     * @param int     $page
     * @param int     $pageSize
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     */
    public function tasks(array $filtering = [], int $page = 1, int $pageSize = 10)
    {
        $params = [
            'version'       => self::VERSION,
            'filtering'     => json_encode($filtering),
            'page'          => $page,
            'pageSize'      => $pageSize,
        ];

        return $this->httpPostJson('marketing/async_tasks/get', $params);
    }

    /**
     * Get advertise async tasks
     *
     * @param array   $filtering
     * @param int     $page
     * @param int     $pageSize
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     */
    public function taskFiles(int $taskId, int $fileId)
    {
        //todo
    }
}
