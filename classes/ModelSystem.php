<?php

namespace Hermer29\Core;

abstract class ModelSystem
{
    protected static $pdo;
    private const CONN_STRING = "sqlite:main.db";
    public function __construct()
    {
        $this -> pdo = new \PDO(self::CONN_STRING);
    }
}