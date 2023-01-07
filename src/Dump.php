<?php
	namespace HerminigildoSebastiao\Dump;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	class Dump{

		private $user_database, $passwd_database, $name_database, $server_ip, $server_user;

		public function __construct($user, $passwd, $database, $server_user){
			$this->user_database = $user;
			$this->passwd_database = $passwd;
			$this->name_database = $database;
			$this->server_user = $server_user;
		}

		public function database(){
			$name_bkp = date('h-i-s-').strtolower($this->name_database).'.sql';
			system('
				mysqldump -u '.$this->user_database.
				' --databases '.$this->name_database.' >> /home/'.
				$this->server_user.'/'.$name_bkp.' -p'.$this->passwd_database, $re);
			if($re == 0){
				echo "Shell executada com successo"; 
				$this->notify($name_bkp);
			}else{ 
				echo "Erro na execusao de shell";
			}
		}

		public function notify($file){
			$mail = new PHPMailer(true);
			try{
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				$mail->isSMTP();                                        //Send using SMTP
    				$mail->Host       = 'mail.lsiconstrutora.com';                  //Set the SMTP server to send through
    				$mail->SMTPAuth   = true;                               //Enable SMTP authentication
    				$mail->Username   = 'no-replay@lsiconstrutora.com';          //SMTP username
    				$mail->Password   = 'Laide2022!';                           //SMTP password
    				$mail->SMTPSecure = 'ssl';            			//Enable implicit TLS encryption
    				$mail->Port       = 465;
				$mail->setLanguage("br");
            			$mail->CharSet = "utf-8";

				//Recipients
            			$mail->setFrom('no-replay@lsiconstrutora.com', 'Backup Database System');
            			$mail->addAddress('herminigildosebastiaoali@gmail.com', 'Herminigildo Ali Sebastiao');
            			
            			$mail->isHTML(true);                                  //Set email format to HTML
            			$mail->Subject = 'Envio de Backup de banco de dados MariaDB';
            			$mail->Body    = 'Enviando o banco de dados maria DB para o email';
    				
				//Attachments
    				$mail->addAttachment('/home/denny/'. $file);         //Add attachments        
				
				$mail->send();
			}catch(Exception $e){
			
			}
		}
	}
