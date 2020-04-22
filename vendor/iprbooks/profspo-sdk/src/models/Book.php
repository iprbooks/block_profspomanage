<?php

namespace Profspo\Sdk\Models;

use Exception;
use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Model;

class Book extends Model
{

    /**
     * Конструктор Book
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
        return $this;
    }

    public function getId()
    {
        return $this->getValue('id');
    }

    public function getTitle()
    {
        return $this->getValue('title');
    }

    public function getTitleAdditional()
    {
        return $this->getValue('title_additional');
    }

    public function getAuthors()
    {
        return $this->getValue('authors');
    }

    public function getPublishers()
    {
        return $this->getValue('publishers');
    }

    public function getYear()
    {
        return $this->getValue('year');
    }

    public function getVolume()
    {
        return $this->getValue('volume');
    }

    public function getIsbn()
    {
        return $this->getValue('isbn');
    }

    public function getType()
    {
        return $this->getValue('type');
    }

    public function getMark()
    {
        return $this->getValue('mark');
    }

    public function getCycle()
    {
        return $this->getValue('cycle');
    }

    public function getUgnpCodes()
    {
        return $this->getValue('ugnp_codes');
    }

    public function getDescription()
    {
        return $this->getValue('description');
    }

    public function getSelected()
    {
        return $this->getValue('selected');
    }

    public function getViews()
    {
        return $this->getValue('views');
    }

    public function getRating()
    {
        return $this->getValue('rating');
    }

    public function getExcluded()
    {
        return $this->getValue('excluded');
    }

    public function getExcludedAt()
    {
        return $this->getValue('excluded_at');
    }

    public function getCreatedAt()
    {
        return $this->getValue('created_at');
    }

    public function getUpdatedAt()
    {
        return $this->getValue('updated_at');
    }

    public function getCover()
    {
        return $this->getValue('cover');
    }

}