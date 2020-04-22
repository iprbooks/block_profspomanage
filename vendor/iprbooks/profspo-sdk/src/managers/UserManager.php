<?php

namespace Profspo\Sdk\Managers;

use Exception;
use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Response;
use Profspo\Sdk\Models\User;

class UserManager extends Response
{

    /**
     * Конструктор UserManager
     * @param $client
     * @return UserManager
     * @throws Exception
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        if (!$client) {
            throw new Exception('client is not init');
        }
        return $this;
    }


    /**
     * Создает нового пользователя
     * @param $name
     * @param $email
     * @param $password
     * @param $role
     * @param null $isBlocked
     * @return User
     * @throws Exception
     */
    public function registerNewUser($name, $email, $password, $role, $isBlocked = null)
    {
        $apiMethod = '/create-user';
        $params = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'is_blocked' => $isBlocked,
        );

        $this->setResponse($this->getClient()->makeRequest($apiMethod, $params));
        return $this->response['data']['user_id'];
    }

    /**
     * Редактирование атрибутов пользователя
     * @param $id
     * @param null $name
     * @param null $email
     * @param null $password
     * @param null $role
     * @param null $isBlocked
     * @return bool|mixed
     * @throws Exception
     */
    public function editUser($id, $name = null, $email = null, $password = null, $role = null, $isBlocked = null)
    {
        $apiMethod = '/update-user';
        $params = array(
            'edited_user_id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'is_blocked' => $isBlocked,
        );

        $this->setResponse($this->getClient()->makeRequest($apiMethod, $params));
        return $this->getSuccess();
    }

}