<?php

namespace app\models;

interface ModelInterface
{
    public static function find($condition);

    public static function tableName();
}