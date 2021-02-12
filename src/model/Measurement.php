<?php
include_once 'Model.php';
class Measurement extends Model
{
    protected $tableName = 'measurements';
    protected $tableFields = ['id', 'user_id', 'weight', 'date'];
}