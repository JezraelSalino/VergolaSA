<?php  
/*
expected input variable:

$mailer_params = array(
  'mailer_type' => '', 
  'host' => '', 
  'username' => '', 
  'password' => '', 
  'sender' => array(
        'name' => '', 
        'email' => ''
  ), 
  'recipients' => array(
        0 => array(
            'name' => '', 
            'email' => ''
        )
  ), 
  'ccs' => array(
        0 => array(
            'name' => '', 
            'email' => ''
        )
  ), 
  'subject' => '', 
  'content' => '', 
  'do_send' => false, 
);
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$config = array();
$config['path']['libraries_base'] = '/includes/vic/libraries';
$config['path']['phpmailer_base'] = $config['path']['libraries_base'] . '/PHPMailer/src';


require $config['path']['phpmailer_base'] . '/Exception.php';
require $config['path']['phpmailer_base'] . '/PHPMailer.php';
require $config['path']['phpmailer_base'] . '/SMTP.php';


$mailer_results = array(
    'datetime' => date('Y-m-d H:i:s'), 
    'message' => ''
);


if (isset($mailer_params['mailer_type']) && 
    isset($mailer_params['host']) && 
    isset($mailer_params['username']) && 
    isset($mailer_params['password']) && 
    isset($mailer_params['sender']['email']) && 
    isset($mailer_params['sender']['name']) && 
    isset($mailer_params['recipients']) && 
    isset($mailer_params['ccs']) && 
    isset($mailer_params['subject']) && 
    isset($mailer_params['content'])) {

    if ($mailer_params['mailer_type'] == 'smtp') {
        $mailer = new PHPMailer(true);

        try {
            $mailer->SMTPDebug = 3;
            $mailer->isSMTP();
            $mailer->Mailer = $mailer_params['mailer_type'];
            $mailer->Host = $mailer_params['host'];
            $mailer->SMTPAuth = true;
            $mailer->SMTPAutoTLS = false;
            $mailer->SMTPSecure = 'tls'; /* tls, ssl */
            $mailer->Port = 587; /* 587, 465 */

            $mailer->Username = $mailer_params['username'];
            $mailer->Password = $mailer_params['password'];

            $mailer->setFrom($mailer_params['sender']['email'], $mailer_params['sender']['name']);
            foreach ($mailer_params['recipients'] as $key1 => $value1) {
                if ((isset($value1['email']) && strlen($value1['email']) > 0) && 
                    (isset($value1['name']) && strlen($value1['name']) > 0)) {
                    $mailer->AddAddress($value1['email'], $value1['name']);
                }
            }
            $mailer->AddReplyTo($mailer_params['sender']['email'], $mailer_params['sender']['name']);
            foreach ($mailer_params['ccs'] as $key1 => $value1) {
                if ((isset($value1['email']) && strlen($value1['email']) > 0) && 
                    (isset($value1['name']) && strlen($value1['name']) > 0)) {
                    $mailer->AddCC($value1['email'], $value1['name']);
                }
            }

            $mailer->isHTML(true);
            $mailer->Subject = $mailer_params['subject'];
            $mailer->Body = $mailer_params['content'];
            $mailer->AltBody = $mailer_params['content'];

            if (isset($mailer_params['do_send'])) {
                if ($mailer_params['do_send'] == false) {
                    //do nothing
                } else {
                    $mailer->Send();
                }
            } else {
                $mailer->Send();
            }

            $mailer_results['message'] = 'Successfully sent message.';
        } catch (Exception $e) {
            $mailer_results['message'] = 'Fail sending message: ' . $mailer->ErrorInfo;
        }
    }
} else {
    $mailer_results['message'] = 'Params not found.';
}
