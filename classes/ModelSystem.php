<?php

namespace Hermer29\Core;

abstract class ModelSystem
{
    protected $pdo;
    private const CONN_STRING = "sqlite:main.db";
    public function __construct()
    {
        $this -> pdo = new \PDO(self::CONN_STRING);
    }
}