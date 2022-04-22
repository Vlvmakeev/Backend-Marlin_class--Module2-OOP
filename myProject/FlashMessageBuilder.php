<?php
    class FlashMessageBuilder
    {
        
        /*
            Создаем функцию подготовки флеш-сообщения 
            (на вход передаем тип сообщения и текст сообщения, 
            функция передает в глобальный массив $_SESSION в ключ тип сообщения, а в значение - текст сообщения, 
            и ничего не возвращает)
        */
        public static function setFlashMessage($name, $message){
            $_SESSION[$name] = $message;}
    
        /*
            Создаем функцию вывода флеш-сообщения на странице 
            (на вход передаем тип сообщения, 
            функция проверяет, есть ли в глобальном массиве $_SESSION такой тип сообщения, и если есть - выводим сообщение определенного типа
            и удаляем из глобального массива $_SESSION этот тип сообщения, 
            и ничего не возвращает)
        */
        public static function displayFlashMessage($name){
            if( isset($_SESSION[$name]) ){
                echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
                unset($_SESSION[$name]);}}
    }
?>