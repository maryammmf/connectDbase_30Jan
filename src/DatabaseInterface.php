<?php

interface DatabaseInterface
{

    public function table(string $table);

    public function insert(array $column , array $values);

    public function update(array $column , array $values);

    public function select(array $column = ['*']);

    public function delete();

    public function where(string $column , array $values , string $operation,string $logicOperation=null);

    public function execute():self;

    public function fetchAll():array;

}