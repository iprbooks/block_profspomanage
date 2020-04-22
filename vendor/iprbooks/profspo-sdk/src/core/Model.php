<?php

namespace Profspo\Sdk\Core;

use Exception;
use Profspo\Sdk\Client;

abstract class Model extends Response
{

    /**
     * Конструктор Model
     * @param Client $client
     * @param $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client);
        $this->setResponse($response);
        return $this;
    }

}