<?php

namespace Profspo\Sdk\Models;

use Profspo\Sdk\Client;
use Profspo\Sdk\Core\Model;

class User extends Model
{

    /*
     * Студент
     */
    const STUDENT = 2;

    /*
     * Преподаватель
     */
    const PROFESSOR = 5;

    /**
     * User constructor.
     * @param Client $client
     * @param null $response
     * @return User
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

    public function getName()
    {
        return $this->getValue('name');
    }

    public function getEmail()
    {
        return $this->getValue('email');
    }

    public function getRole()
    {
        return $this->getValue('role');
    }

    public function getIsBlocked()
    {
        return $this->getValue('is_blocked');
    }

    public function getBlockAfter()
    {
        return $this->getValue('block_after');
    }

    public function getRegistrationDate()
    {
        return $this->getValue('registration_date');
    }

    public function getOrganizationId()
    {
        return $this->getValue('organization_id');
    }

    public function getOrganization()
    {
        return $this->getValue('organization');
    }

}