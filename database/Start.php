<?php
    include __DIR__ . '/../config.php';
    include __DIR__ . 'Connection.php';
    include __DIR__ . 'QueryBuilder.php';

    /*
        Создаем новый объект класса QueryBuilder, 
        передавая ему аргументом статичную функцию make() класса Connection с аргументом конфигурации БД; 
        возвращаем объект QueryBuilder.
    */
    return new QueryBuilder(
        Connection::make($config['database'])
    );
?>