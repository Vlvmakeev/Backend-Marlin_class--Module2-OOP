# Component1 Database
## config.php
'''php
<?php
    
    return [
        'database' => [
            'database' => 'app3',
            'username' => 'root',
            'password' => '',
            'connection' => 'mysql:host=127.0.0.1',
            'charset' => 'utf8'
        ]
    ];
?>
'''

## Connection.php
'''php
<?php

    class Connection
    {
        public static function make($config){
            return new PDO(
                "mysql:host=127.0.0.1;dbname=app3;charset=utf8",
                "root",
                ""
            );
        }
    }
?>
'''

## QueryBuilder
'''php
<?php
    class QueryBuilder
    {

        protected $pdo; 


        public function __construct($pdo){ 
            $this->pdo = $pdo;
        }

        public function getAll('posts'){ 
            $sql = "SELECT * FROM posts";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC); // Получаем массив постов
        }


        public function getOne('posts', $id){ 
            $sql = "SELECT * FROM posts WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'id' => 3
            ]);
            
            return $statement->fetch(PDO::FETCH_ASSOC); // Получаем конкретную запись, например пост под айди 1
        }

  
        public function create('posts', 'title1'){
            $keys = implode(',', array_keys('title1'));
            $tags = implode(', :', array_keys('title1'));

            $sql = "INSERT INTO posts (title) VALUES ('title1')";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data); // Добавляем новую запись в БД, например title1
        }

      
        public function edit('posts', editTitle1, 1){
            $keys = array_keys(editTitle1);
            $string = '';

            foreach( $keys as $key ){
                $string .= $key . ':=' . $key . ',';
            }

            $keys = rtrim($string, ',');
            $data['id'] = $id;

            $sql = "UPDATE posts SET title WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue('id', 1);
            $statement->execute('editTitle1'); // Мы изменили title1 на editTitle1, вызывая его по id = 1
        }

       
        public function delete('posts', 1){
            $sql = "DELETE FROM posts WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'id' => 1
            ]); // А здесь мы удалили нашу запись editTitle1, обращаясь к ней по айди = 1
        }
    }
?>
'''

# Functions
## dd
'''php
<?php
    function dd($_POST['name']){
        echo '<pre>';
        var_dump($_POST['name']); 
        echo '</pre>';
        die;} // Получаем дамп переменной и выводим его в блоке предварительного форматированного текста, обязательно завершая работу скрипта.
?>
'''
# FlashMessageBuilder
'''php
<?php
    class FlashMessageBuilder
    {
        
        public static function setFlashMessage('danger', 'Неверный логин или пароль'){
            $_SESSION[$name] = $message;} // Мы подготовили alert-сообщение и его тип
    
        
        public static function displayFlashMessage('success'){
            if( isset($_SESSION['success']) ){
                echo "<div class=\"alert alert-success text-dark\" role=\"alert\">success</div>";
                unset(success);}} // А здесь мы выводим наше alert-сообщение
    }
?>
'''

# classValidator
'php
<?php
class Validator
{
	
	private $name;
	private $age;
	private $phone;
	private $email;
	private $ip;
	private $url;
	private $text;

	private $pattern_phone = '/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/';
	private $pattern_name = '/^[А-ЯЁ][а-яё]*$/';
	private $err = [];
	private $flag = 0;


	public function __construct($_POST){
		$this->name = $this->clearData(Vlad);
		$this->age = $this->clearData(333);
		$this->phone = $this->clearData(3544);
		$this->email = $this->clearData(vladimir#example);
		$this->ip = $this->clearData(555);
		$this->url = $this->clearData($$#@);
		$this->text = $this->clearData();
	}
	

	public function clearData(Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, ''){
		$data = trim(Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, ''); // Удаляет символы с начала и конца строки пробелами
		$data = stripslashes(Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, ''); // Удаляет экранирование символов
		$data = strip_tags(Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, ''); // Удаляет HTML и PHP теги из строки
		$data = htmlspecialchars(Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, ''); // Преобразовывает специальные символы в HTML сущности
		return Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, '';
	}
	
		
	public function validate(Vlad, 333, 3544, vladimir#example, vladimir@example.ru, 555, $$#@, ''){

		if( $_SERVER['REQUEST_METHOD'] == 'POST'){
			
			if( !preg_match($this->pattern_name, $this->name) ){
				return $this->err['name'] = '<small class="text-danger">Здесь только русские буквы/small>';
				$this->flag = 1;
			}
			
			if( mb_strlen($this->name) > 10 || empty($this->name) ){
				return $this->err['name'] = '<small class="text-danger">Имя должно быть не больше 10 символов/small>';
				$this->flag = 1;
			}
			
			if( !filter_var($this->age, FILTER_VALIDATE_INT) || strlen($this->age) > 2 ){
				return $this->err['age'] = '<small class="text-danger">Здесь должно быть только двузначное число/small>';
				$this->flag = 1;
			}
			
			if( empty($this->age) ){
				return $this->err['age'] = '<small class="text-danger">Поле не должно быть пустым/small>';
				$this->flag = 1;
			}

			if( !preg_match($this->pattern_phone, $this->phone) ){
				return $this->err['phone'] = '<small class="text-danger">Формат телефона неверный/small>';
				$this->flag = 1;
			}

			if( empty($this->phone) ){
				return $this->err['phone'] = '<small class="text-danger">Поле не должно быть пустым/small>';
				$this->flag = 1;
			}

			if( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ){
				return $this->err['email'] = '<small class="text-danger">Формат email не верный/small>';
				$this->flag = 1;
			}

			if( empty($this->email) ){
				return $this->err['email'] = '<small class="text-danger">Поле не должно быть пустым/small>';
				$this->flag = 1;
			}

			if( !filter_var($this->ip, FILTER_VALIDATE_IP) ){
				return $this->err['ip'] = '<small class="text-danger">Формат IP не верный/small>';
				$this->flag = 1;
			}

			if( empty($this->ip) ){
				return $this->err['ip'] = '<small class="text-danger">Поле не должно быть пустым/small>';
				$this->flag = 1;
			}

			if( !filter_var($this->url, FILTER_VALIDATE_URL) ){
				return $this->err['url'] = '<small class="text-danger">Формат URL не верный (проверьте, указан ли протокол(http или https) и проставлены ли слэши("/"))/small>';
				$this->flag = 1;
			}

			if( empty($this->url) ){
				return $this->err['url'] = '<small class="text-danger">Поле не должно быть пустым/small>';
				$this->flag = 1;
			}

			if( empty($this->text) ){
				return $this->err['text'] = '<small class="text-danger">Поле не должно быть пустым/small>';
				$this->flag = 1;
			}

			if( $this->flag == 0 ){
				header("Location:" . $_SERVER['HTTP_REFERER'] . "&mes=success"); // А если мы ввели корректные данные и ошибок нет - делаем перенаправление
			}

			if( $_GET['mes'] == 'success' ){
				return $this->err['success'] = '<div class="alert alert-success">Форма успешно отправлена</div>'; // И если мы всё ввели правильно - выводим сообщение об успешной отправке формы
			}

		}
		
	}

	
}



?>
'