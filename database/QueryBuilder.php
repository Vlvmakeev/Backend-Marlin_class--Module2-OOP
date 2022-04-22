<?php
    class QueryBuilder
    {
        /* 
            Создаем свойство PDO, здесь затем будет находиться соединение с базой данных
        */
        protected $pdo; 

        /*
            Через конструктов получаем соедиение с базой данных и "кладем" его в свойство $pdo
        */
        public function __construct($pdo){ 
            $this->pdo = $pdo;
        }

        /*
            Создаем функцию получепния всех записей из БД 
            (на вход передаем название таблицы, 
            функция делает запрос в БД, забирает все записи 
            и возвращает их в ассоциативном массиве)
        */
        public function getAll($table){ 
            $sql = "SELECT * FROM {$table}";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }


        /*
            Создаем функцию получения одной записи из БД по id 
            (на вход передаем название таблицы и id записи нашего экземпляра, 
            функция делает запрос в БД, берет запись с указаным нами id 
            и возвращает её ассоциативным массивом)
        */
        public function getOne($table, $id){ 
            $sql = "SELECT * FROM {$table} WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'id' => $id
            ]);
            
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        /*
            Создаем функцию создания записи в БД 
            (на вход передаем название таблицы и данные для записи в поля, 
            функция получает все данные "ключ-значение", делает запрос в БД с созданием новой записи 
            и ничего не возвращает)
        */
        public function create($table, $data){
            $keys = implode(',', array_keys($data));
            $tags = implode(', :', array_keys($data));

            $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
        }

        /*
            Создаем функцию изменения записи в БД 
            (на вход передаем название таблицы, данные для изменения даных в записи в БД, а также id нужной записи, 
            функция получает все данные "ключ-значение", делает запрос в БД с изменением нужной нам записи 
            и ничего не возвращает)
        */
        public function edit($table, $data, $id){
            $keys = array_keys($data);
            $string = '';

            foreach( $keys as $key ){
                $string .= $key . ':=' . $key . ',';
            }

            $keys = rtrim($string, ',');
            $data['id'] = $id;

            $sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue('id', $id);
            $statement->execute($data);
        }

        /*
            Создаем функцию удаления записи из БД 
            (на вход передаем название таблицы и id нужной записи, 
            функция делает запрос в БД с удалением нужной нам записи 
            и ничего не возвращает)
        */
        public function delete($table, $id){
            $sql = "DELETE FROM {$table} WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'id' => $id
            ]);
        }
    }
?>