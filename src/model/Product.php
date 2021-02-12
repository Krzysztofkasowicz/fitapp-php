<?php
include_once 'Model.php';
class Product extends Model
{
    protected $tableName = 'products';
    protected $tableFields = ['name', 'energy_kcal', 'energy_kj', 'carbohydrates', 'proteins', 'salt', 'fat'];
}