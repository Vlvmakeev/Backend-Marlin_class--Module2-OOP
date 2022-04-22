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

	/* Вызываем конструктор создания объекта класса Validator */

	public function __construct($_POST){
		$this->name = $this->clearData($_POST['name']);
		$this->age = $this->clearData($_POST['age']);
		$this->phone = $this->clearData($_POST['phone']);
		$this->email = $this->clearData($_POST['email']);
		$this->ip = $this->clearData($_POST['ip']);
		$this->url = $this->clearData($_POST['url']);
		$this->text = $this->clearData($_POST['text']);
	}
	
		/*
            Создаем функцию "очистки" получаемых данных 
            (на вход передаем данные, 
            функция проводит "очитстку" данных от возможных лишних символов 
            и возвращает данные после "очистки")
        */
	public function clearData($data){
		$data = trim($data); // Удаляет символы с начала и конца строки пробелами
		$data = stripslashes($data); // Удаляет экранирование символов
		$data = strip_tags($data); // Удаляет HTML и PHP теги из строки
		$data = htmlspecialchars($data); // Преобразовывает специальные символы в HTML сущности
		return $data;
	}
	
		/*
            Создаем функцию валидации получаемых данных 
            (на вход передаем данные, 
            функция проводит проверку данных на различные требования 
            и возвразает ошибки в случае неверного введения данных)
        */
	public function validate($name, $age, $phone, $email, $ip, $url, $text){

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
				header("Location:" . $_SERVER['HTTP_REFERER'] . "&mes=success");
			}

			if( $_GET['mes'] == 'success' ){
				return $this->err['success'] = '<div class="alert alert-success">Сообщение успешно отправлено</div>';
			}

		}
		
	}

	
}



?>