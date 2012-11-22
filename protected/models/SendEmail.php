<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendEmail
 *
 * @author RAJU
 */
class SendEmail 
{

  function send($email=array())
  {
            if(isset($email['from'])&& isset($email['from_name']) && isset($email['to']) && isset($email['message']) && isset($email['subject']) ){

            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
            $mailer->IsSMTP();
            $mailer->Host ="ssl://smtp.gmail.com";
            $mailer->Port ="465";
            $mailer->SMTPAuth = true;
            $mailer->Username ="enterpi.php@gmail.com";
            $mailer->Password ="touchwithraju";
            
            
            $mailer->From = $email['from'];
            #$mailer->AddReplyTo('wei@example.com');
            $mailer->AddAddress($email['to']);
            $mailer->FromName = $email['from_name'];
            $mailer->CharSet = 'UTF-8';
            $mailer->Subject = Yii::t('demo', $email['subject']);
            $mailer->Body = $email['message'];
            $mailer->IsHTML(true);
            $mailer->Send();
            }
  }
    //put your code here
}
?>
