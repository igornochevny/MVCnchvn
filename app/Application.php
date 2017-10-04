<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 9/27/17
 * Time: 7:18 PM
 */
namespace app;
use app\http\Controller;
/**
 *
 * Класс, который представляет собой приложение, которое мы вообще щапускаем
 * (по-хорогему надо было еще замутить Шаблон Синглтон и на этот класс)
 * http://designpatternsphp.readthedocs.io/ru/latest/Creational/Singleton/README.html
 *
 * Class Application
 * @package app
 */
class Application
{
    /** в жтом свойстве будет храниться экземпляр соединения с базой данных */
    /** @var  \PDO $pdo */
    public static $pdo;

    public $config;

    /** @var  Controller $controller */
    public $controller;

    /** @var QueryHandler $queryHandler */
    private $queryHandler;

    public function __construct(array $config)
    {

        $this->config = $config;

        $this->connectDatabase($this->config['host'],$this->config['username'],$this->config['password'],$this->config['database']);

        $this->queryHandler = QueryHandler::getInstance();
    }
    /**
     * Функция запуска приложения
     *
     * В ней запускается вызванный контроллер после того как
     * обработчик запроса редит какой контроллер нужно вызвать
     *
     */
    public function run(){

        $this->controller = $this->queryHandler->handle($_SERVER['REQUEST_URI']);

        echo $this->controller->runAction();
    }
    /**
     * Функция для подключения к БД, используя PDO
     *
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     * @param null $options
     */
    public function connectDatabase(string $host, string $user, string $password, string $database, $options = null){
        try{

            self::$pdo = new \PDO("mysql:host=$host;dbname=$database", $user, $password, $options);
        }catch (\PDOException $exception){

            echo "Connection issue: ".$exception->getMessage();
            exit();

        }
    }
}