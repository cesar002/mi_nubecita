<?php

namespace Services;

/**
 *  SendEmail Class
 * Clase que permite el envio de emails
 */
use Services\InitFileData;

class SendEmail{

    /**
     * Envia un correo basico a un destinatario
     *
     * @param String $to
     * Dirección de correo electronico a quien se le va a enviar el mensaje
     * @param String $messege
     * Mensaje que se va a enviar, puede tener formato HTML
     * @return void
     */
    public static function sendBasicEmail(String $to, String $messege):void{
        mail($to, "", $messege);
    }

    /**
     * Envia un correo a un destinatario con un titulo de correo
     *
     * @param String $to
     * Dirección de correo electronico a quien se le va a enviar el mensaje
     * @param String $subject
     * Titulo del mensaje
     * @param String $messege
     * Mensaje que se va a enviar, puede tener formato HTML
     * @return void
     */
    public static function sendEmail(String $to, String $subject, String $messege):void{
        $head  = 'MIME-Version: 1.0' . "\r\n";
        $head .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $head .= 'From: Mi Nubecita' . "\r\n" .
                 'Reply-To: webmaster@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $messege, $head);
    }
    
    /**
     * Envia el correo de verificación de cuenta con a un email
     *
     * @param String $email
     * Dirección de correo electronico a quien se le va a enviar el mensaje
     * @param String $verificationToken
     * Token de verificacion que se enviará en la dirección de correo electronico
     * @return void
     */
    public static function sendEmailVerificationAccount(String $email, String $verificationToken):void {
        $urlServer = InitFileData::getIniFileData()['url_server'];

        $to = $email;
        $subject = "Confirmación cuenta";
        $text = "
        <html>
            <body>
                <h1><strong>¡Verifica tu cuenta porfavor!</strong></h1>
                <br>
                <p>para poder disfrutar de nuestro maravilloso servicio acceda a la siguiente liga</p>
                <p><a href='$urlServer/routes/verificarRegistro.php?code=$verificationToken'>verifica tu cuenta</a></p>
                <br>
                <p>si usted no recuerda haberse registrado ignore este mensaje</p>
                <p><small>atte. staff de espotifai</small></p>
            </body>
        </html>";
        $head  = 'MIME-Version: 1.0' . "\r\n";
        $head .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $head .= 'From: Mi Nubecita' . "\r\n" .
                 'Reply-To: webmaster@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

        mail($to,$subject,$text,$head);
    }

    /**
     * Envia el correo de recuperación de contraseña
     *
     * @param String $email
     * Dirección de correo electronico a quien se le va a enviar el mensaje
     * @param String $verificationToken
     * Token de verificacion que se enviará en la dirección de correo electronico
     * @return void
     */
    public static function sendEmailRecoveryPassword(String $email, String $verificationToken):void{
        $urlServer = \InitFileData::getIniFileData()['url_server'];

        $to = $email;
        $subject = "Recuperación de contraseña";
        $text = "
        <html>
            <body>
                <h1><strong>Recuperación de contraseña</strong></h1>
                <br>
                <p>para poder recuperar su contraseña entre a la siguiente ligar</p>
                <p><a href='$urlServer/routes/recuperarContraseña.php?code=$verificationToken'>aquí</a></p>
                <br>
                <p><small>atte. staff de espotifai</small></p>
            </body>
        </html>";
        $head  = 'MIME-Version: 1.0' . "\r\n";
        $head .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $head .= 'From: Mi Nubecita' . "\r\n" .
                 'Reply-To: webmaster@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

        mail($to,$subject,$text,$head);
    }

}