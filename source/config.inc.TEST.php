<?php
error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE);
$this->dbName = 'oxid_test'; // database name
$this->sShopDir = __DIR__;
$this->sCompileDir = $this->sShopDir . '/tmp';

$this->iUtfMode = 0;

$this->iDebug = 1;

$this->blSkipViewUsage = true;
