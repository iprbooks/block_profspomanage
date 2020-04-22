<?php

namespace Profspo\Sdk\Core;

class Curl
{

    const HOST = 'https://profspo.ru/api';

    /**
     * Отправка запроса
     * @param $host
     * @param $apiMethod
     * @param $token
     * @param array $params
     * @return array|mixed
     */
    public static function exec($apiMethod, array $params)
    {
        if (!empty($params)) {
            $apiMethod = sprintf("%s?%s", $apiMethod, http_build_query($params, '', '&'));
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_URL, self::HOST . $apiMethod);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $curlResult = curl_exec($curl);

        if (curl_errno($curl)) {
            return Curl::getError('Curl error ' . curl_errno($curl) . ': ' . curl_error($curl), 500);
        }

        return json_decode($curlResult, true);
    }


    /**
     * Формирование сообщения в случае ошибки
     * @param $message
     * @param $code
     * @return array
     */
    private static function getError($message, $code)
    {
        return array(
            'success' => false,
            'message' => $message,
            'status' => $code,
            'data' => null,
        );
    }
}
