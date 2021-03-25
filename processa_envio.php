<?php

    require "./bibliotecas/PHPMailer/Exception.php";
    require "./bibliotecas/PHPMailer/OAuth.php";
    require "./bibliotecas/PHPMailer/PHPMailer.php";
    require "./bibliotecas/PHPMailer/POP3.php";
    require "./bibliotecas/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
        }
        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem) ){
                return false;
            }
            return true;
        }
    }


    $mensagem = new Mensagem();

    $mensagem-> __set('para', $_POST['para']);
    $mensagem-> __set('assunto', $_POST['assunto']);
    $mensagem-> __set('mensagem', $_POST['mensagem']);


#print_r($mensagem);


    if(!$mensagem->mensagemValida()){
        echo "mensagem não é validada";
        die();
    }

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'hostappsendmail@gmail.com';                 // SMTP username
        $mail->Password = 'w&wlHkEpd9';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('hostappsendmail@gmail.com', 'Web completo rementente');
        $mail->addAddress('hostappsendmail@gmail.com', 'Web completo Destinatario');     // Add a recipient
        // $mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'oi eu sou o assunto';
        $mail->Body    = 'oi eu sou o conteudo do <strong>email</strong>';
        $mail->AltBody = 'oi eu sou o conteudo do email';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Não foi possível enviar este e-mail! Por favor tente mais tarde';
        echo 'Detalhes do erro ' . $mail->ErrorInfo;
    }











?>