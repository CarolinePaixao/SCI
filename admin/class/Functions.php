<?php
include_once 'Database.php';
/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 15/10/2015
 * Time: 19:20
 */
class Functions
{

    public static function verLogin($login, $senha){
        return Database::ReadOne('login', '*', "WHERE user_name = '$login' AND user_pass = '".$senha."'");

    }

    public static function selectLogin($login){
        return Database::ReadOne('login', '*', "WHERE user_name = '$login'");
    }

    public static function verLog($nivel){
        if(!isset($_SESSION['login']) || empty($_SESSION['login']) || $nivel > $_SESSION['login']['role'] ){
            unset($_SESSION);
            header('Location: login.html');
        }
    }


    public static function validDate($date){
        $data = explode("/","$date"); // fatia a string $date em pedados, usando / como referência
        $d = $data[0];
        $m = $data[1];
        $y = $data[2];

        $yMin = date('Y') - 90;
        $yMax = date('Y') - 16;
        if($y > $yMax || $y < $yMin)
            return false;

        // verifica se a data é válida!
        // 1 = true (válida)
        // 0 = false (inválida)
        $res = checkdate($m,$d,$y);
        if ($res == 0){
            return false;
        }else{
            return true;
        }
    }

    public static function pushMask($phone){
        return  '('.substr($phone,0,2).')'.substr($phone,2,4).'-'.substr($phone,6);
    }

    public static function validPhone($phone){
        if(!preg_match('/\((10)|([1-9][1-9])\)[2-6][0-9]{3}-[0-9]{4}/', $phone)){
            return false;
        }
        return true;
    }
    public static function validCelphone($phone){
        if(!preg_match('/\((10)|([1-9][1-9])\)[9][4-9][0-9]{2}-[0-9]{5}/', $phone)){
            return false;
        }
        return true;
    }

    public static function validEmail($email){
        //verifica se e-mail esta no formato correto de escrita
        if (!preg_match('/^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})/',$email)){
            return false;
        }else{
            //Valida o dominio
            $dominio=explode('@',$email);
            if(!checkdnsrr($dominio[1],'A')){
                return false;
            }
            else{
                return true;
            } // Retorno true para indicar que o e-mail é valido
        }
    }




    public static function sendEmailRecoverPass($email_from, $name, $senha)
    {
        $email = "cbp_caroline@hotmail.com";
        $assunto = 'SCI - Missão Calebe';
        $mensagem = '<html>
                    <head>
                        <title>Recuperação de Senha</title>
                    </head>
                    <p>
                        <p>Olá, ' . $name . '!</p>

                        <p>Estamos aqui para recuperar a sua senha perdida!
                        Sua senha é: <strong>' . $senha . '</strong></p>

                        <p>Att.</p>
                        <p>Missão Calebe</p>
                    </body>
                 </html>';

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: \"$name\" <$email_from>\r\n";
        if (mail($email, $assunto, $mensagem, $headers))
            return true;
        else
            return false;
    }

    public static function sendEmailContact($email, $name, $message, $assunto)
    {
        $mensagem = '<html>
                    <head>
                        <title>Email Contato - Missão Calebe</title>
                    </head>
                    <p>


                        <p>' . $message . '</p>

                        <p>Att.</p>
                        <p>' . $name . '</p>
                        <p>' . $email . '</p>
                    </body>
                 </html>';

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: \"$name\" <$email>\r\n";
        if (mail('cbp_caroline@hotmail.com', $assunto, $mensagem, $headers))
            return true;
        else
            return false;
    }

    public static function getState(){
        return Database::ReadAll('states', '*');
    }

    public static function getCity($where){
        return Database::ReadAll('city', '*', "WHERE $where");
    }

}