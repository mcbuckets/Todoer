<?php

class TaskOps
{

    public static function get_priority($priority)
    {

        switch ($priority) {
            case '1':
                $priority = 'Low';
                break;
            case '2':
                $priority = 'Normal';
                break;
            case '3':
                $priority = 'High';
                break;
            default:
                $priority = 'Low';
        }
        return $priority;
    }

    public static function get_status($status)
    {

        switch ($status) {
            case '0':
                $status = 'Not Completed';
                break;
            case '1':
                $status = 'Completed';
                break;
            default:
                $status = 'Not completed';
        }
        return $status;
    }

    public static function sort_lists($order_by)
    {

        switch ($order_by) {
            case 'byName':
                $order_by = '_name';
                break;
            case 'byTime':
                $order_by = '_time_created';
                break;
            case 'byDeadline':
                $order_by = '_deadline';
                break;
            case 'byPriority':
                $order_by = '_priority';
                break;
            case 'byStatus':
                $order_by = '_completed';
                break;
            default:
                $order_by = '_name';
        }

        return $order_by;

    }

    public static function sort_tasks($order_by)
    {

        switch ($order_by) {
            case 'byName':
                $order_by = '_name';
                break;
            case 'byTime':
                $order_by = '_time_created';
                break;
            case 'byDeadline':
                $order_by = '_deadline';
                break;
            case 'byPriority':
                $order_by = '_priority DESC';
                break;
            case 'byStatus':
                $order_by = '_completed';
                break;
            default:
                $order_by = '_name';
        }

        return $order_by;

    }

}
