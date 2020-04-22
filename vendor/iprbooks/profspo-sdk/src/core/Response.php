<?php

namespace Profspo\Sdk\Core;

use Exception;
use Profspo\Sdk\Client;

class Response
{

    /*
     * Инстанс клиента
     */
    private $client;

    /*
     * Ответ
     */
    protected $response;

    /*
     * Общее кол-во
     */
    protected $total;

    /*
     * Данные ответа
     */
    protected $data;


    /**
     * Конструктор Response
     * @param Client $client
     * @param $response
     * @throws Exception
     */
    public function __construct(Client $client)
    {
        if (!$client) {
            throw new Exception('client is not init');
        }

        $this->client = $client;
        return $this;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
        if (array_key_exists('total', $response['data'])) {
            $this->total = $response['data']['total'];
        }

        if (array_key_exists('values', $response['data'])) {
            $this->data = $response['data']['values'];
        }
    }

    /**
     * Получить клиент
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Получить значение по ключу
     * @param $name
     * @return string
     */
    protected function getValue($name)
    {
        if (is_array($this->data) && array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return '';
        }
    }

    /**
     * Возвращает статус запроса
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->response['success'];
    }

    /**
     * Возвращает текстовое сообщение ошибки
     * @return mixed
     */
    public function getMessage()
    {
        return $this->response['message'];
    }

    /**
     * Возвращает общее кол-во записей
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Возвращает статус ответа
     * @return mixed
     */
    public function getStatus()
    {
        return $this->response['status'];
    }

}