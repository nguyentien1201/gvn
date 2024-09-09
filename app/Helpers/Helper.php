<?php

namespace App\Helpers;

use App\Models\ConstantModel;
use Illuminate\Http\Request;

class Helper
{
    public static function setSessionOldUrl($request, $prefix = '')
    {
        if (session()->has($prefix)) {
            session()->forget($prefix);
        }
        $url = '?';
        session([$prefix => route($prefix) . $url . (isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '')]);
    }

    public static function getObjectByKey($array, $key)
    {
        $neededObject = array_filter(
            $array,
            function ($e) use (&$searchedValue, $key) {
                return $e->key == $key;
            }
        );
        return $neededObject;
    }

    public static function bindingDataFromRequest(Request &$request, $key, $type)
    {
        switch ($type) {
            case 'DATE':
                $request->offsetSet($key, $request->{$key} ? date('Y-m-d', strtotime($request->{$key})) : null);
                break;
            case 'DATETIME':
                $request->offsetSet($key, $request->{$key} ? date('Y-m-d H:i:s', strtotime($request->{$key})) : null);
                break;
            case 'CURRENCY':
                $request->offsetSet($key, $request->{$key} ? str_replace(',', '', $request->{$key}) : 0);
                break;
            default:
                break;
        }
    }

    public static function formatPhone($phone)
    {
        return preg_replace('/[^0-9]/', '', $phone);
    }

    public static function mappingMessage($obj, $message)
    {
        $orderTags = ConstantModel::ORDER_TAGS;
        foreach ($orderTags as $key => $value) {
            $message = str_replace('#' . $key, $obj->{$key}, $message);
        }
        return $message;
    }
}
