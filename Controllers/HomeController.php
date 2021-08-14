<?php
namespace Controllers;

use \Core\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController extends Controller {

	private $user;

    public function __construct()
    {
        // $this->user = new Usuarios();

        // if (!$this->user->verifyLogin()) {
        //     header("Location: ".BASE_URL."login");
        //     exit;
		// }

		// if (!$this->user->hasPermission('dashboard_view')) {
		// $this->loadView('404/500');
        // exit;
        // } 
    }

	public function index()
	{
		$data = array('user' => $this->user);

		$data['titulo'] = 'Descomplica Zap';
		$data['menu'] = 'home';


		$this->loadTemplate('home/home', $data);
	}

    public function email()
    {
        if(isset($_POST['name']) && !empty($_POST['name'])) {

            $lead_name  = $_POST['name'];
            $lead_email = $_POST['email'];
            $lead_phone = $_POST['phone'];
            $message    = $_POST['message'];

            try {

                $lista   = $_POST['dados'];
                $vendor  = $_POST['vendor'];
                $cliente = $_POST['cliente'];
                $email   = $_POST['email'];
                $total   = $_POST['total'];

                $to = MAIL['host'];
                $from = $lead_email;
                $name = "Contato via Site";
                $subject = utf8_encode("Mais Informações");
                $cmessage = "Pedido para aprovação";

                $headers = "From: $from";
                $headers = "From: " . $from . "\r\n";
                $headers .= "Reply-To: ". $from . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


                $body = '<!DOCTYPE html>
                        <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1" />
                            <title>E-mail</title>
                        </head>
                        <body>
                                <p>$message</p>
                        </body>
                        </html>';

                mail($to, $subject, $body, $headers);

                $resposta['code'] = 0;
                $resposta['message'] = 'E-mail enviado com sucesso.';
                echo json_encode($resposta);
                exit;

            } catch (Exception $e) {
                $resposta['code'] = 1;
                $resposta['message'] = 'Algo deu errado tente novamente.';
                echo json_encode($resposta);
                exit;
            }
        }

    }
}