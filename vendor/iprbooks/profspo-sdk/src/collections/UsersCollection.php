<?php

namespace Profspo\Sdk\collections;

use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Collection;
use Profspo\Sdk\Models\User;

class UsersCollection extends Collection
{

    /*
     * фильтрация по полному имени пользователя
     */
    const FULLNAME = 's';

    private $apiMethod = '/userlist';


    /**
     * Конструктор UsersCollection
     * @param Client $client
     * @return UsersCollection
     * @throws \Exception
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        return $this;
    }


    /**
     * Возвращает метод api
     * @return string
     */
    protected function getApiMethod()
    {
        return $this->apiMethod;
    }

    /**
     * Проверка значений фильтра
     * @param $field
     * @return boolean
     */
    protected function checkFilterFields($field)
    {
        if ($field == self::FULLNAME) {
            return true;
        }
        return false;
    }

    /**
     * Возвращает элемент выборки
     * @param $index
     * @return User
     * @throws \Exception
     */
    public function getItem($index)
    {
        parent::getItem($index);
        $item = new User($this->getClient());
        $item->setResponse($this->createModelWrapper($this->data[$index]));
        return $item;
    }

}