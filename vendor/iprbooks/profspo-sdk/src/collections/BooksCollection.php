<?php

namespace Profspo\Sdk\collections;

use Exception;
use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Collection;
use Profspo\Sdk\Models\Book;

class BooksCollection extends Collection
{

    /*
     * Фильтрация по заглавию
     */
    const TITLE = 's';

    private $apiMethod = '/books';


    /**
     * Конструктор BooksCollection
     * @param Client $client
     * @return BooksCollection
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
     * @return Book
     * @throws Exception
     */
    public function getItem($index)
    {
        parent::getItem($index);
        $item = new Book($this->getClient());
        $item->setResponse($this->createModelWrapper($this->data[$index]));
        return $item;
    }
}