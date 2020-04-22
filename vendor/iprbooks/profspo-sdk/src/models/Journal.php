<?php

namespace Profspo\Sdk\Models;

use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Model;

class Journal extends Model
{

    /**
     * Конструктор Journal
     * @param Client $client
     * @param $response
     * @throws \Exception
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

    public function getPublishers()
    {
        return $this->getValue('publishers');
    }

    public function getIsbn()
    {
        return $this->getValue('isbn');
    }

    public function getDescription()
    {
        return $this->getValue('description');
    }

    public function getBibliography()
    {
        return $this->getValue('bibliography');
    }

    public function getVak()
    {
        return $this->getValue('vak');
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

    public function getUgnpCodes()
    {
        return $this->getValue('ugnp_codes');
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

    public function getIssues()
    {
        return $this->getValue('issues');
    }

}