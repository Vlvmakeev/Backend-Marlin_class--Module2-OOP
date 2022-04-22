<?php
    
    // Здесь мы создаем класс соединения с базой данных, статичная (чтобы мы могли вызывать её из любого места в проекте) функция make() принимает на вход данные конфигурации нашей БД (название БД, логин, пароль и хост сервера БД, кодировку); создает объект PDO

    class Connection
    {
        public static function make($config){
            return new PDO(
                "{$config['connection']};dbname={$config['database']};charset={$config['charset']}",
                $config['username'],
                $config['password']
            );
        }
    }
?>