<?php

namespace Profspo\Sdk\collections;

use Exception;
use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Collection;
use Profspo\Sdk\Models\Journal;

class JournalsCollection extends Collection
{
    /*
     * фильтрация по заглавию
     */
    const TITLE = 's';

    private $apiMethod = '/periodicals';


    /**
     * Конструктор JournalsCollection
     * @param Client $client
     * @return JournalsCollection
     * @throws Exception
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
        if ($field == self::TITLE) {
            return true;
        }
        return false;
    }

    /**
     * Возвращает элемент выборки
     * @param $index
     * @return Journal
     * @throws Exception
     */
    public function getItem($index)
    {
        parent::getItem($index);
        $item = new Journal($this->getClient());
        $item->setResponse($this->createModelWrapper($this->data[$index]));
        return $item;
    }

}