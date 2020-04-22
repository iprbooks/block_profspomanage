<?php

namespace Profspo\Sdk;

use Exception;
use Profspo\Sdk\Core\Curl;

final class Client
{
    /*
     * id организации
     */
    private $clientId;

    /*
     * token организации
     */
    private $token;

    /*
     * id пользователя
     */
    private $userId;

    /*
     * token пользователя
     */
    private $userToken;

    /**
     * Конструктор Client
     * @param $clientId
     * @param $secretKey
     * @param $email
     * @param $pass
     * @throws Exception
     */
    public function __construct($clientId, $secretKey, $email, $pass)
    {
        if (!is_numeric($clientId)) {
            throw new Exception('$clientId must be numeric');
        }

        $this->clientId = $clientId;

        $apiMethod = '/get-token';
        $params = array(
            'organization_id' => $clientId,
            'token_key' => $secretKey,
            'own' => 'profspo-sdk',
            'app' => 'other',
            'apc' => 'other',
            'apv' => 'other'
        );
        $res = Curl::exec($apiMethod, $params);
        $this->token = $res['data']['access_token'];

        $apiMethod = '/login';
        $params = array(
            'email' => $email,
            'password' => $pass,
            'organization_id' => $this->clientId,
            'access_token' => $this->token,
        );
        $res = Curl::exec($apiMethod, $params);
        $this->userId = $res['data']['user_id'];
        $this->userToken = $res['data']['user_token'];

    }

    public function makeRequest($apiMethod, array $params)
    {
        $params = array_merge(
            array(
                'organization_id' => $this->clientId,
                'access_token' => $this->token,
                'user_id' => $this->userId,
                'user_token' => $this->userToken
            ),
            $params);

        $result = Curl::exec($apiMethod, $params);
        return $result;
    }

}