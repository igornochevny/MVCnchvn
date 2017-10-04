<?php

namespace app\models;

class Post extends Model{

    public $id;
    public $message;
    public $time;

    public static $fields = [
        'id', 'message', 'time'
    ];
    public static function tableName()
    {
        return 'post';
    }
}