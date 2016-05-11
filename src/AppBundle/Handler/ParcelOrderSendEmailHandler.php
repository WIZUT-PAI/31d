<?php
namespace AppBundle\Handler;

class ParcelOrderSendEmailHandler implements ParcelOrderSendEmailHandlerInterface 
{
    private $twig;
    private $mailer;
    public function __construct($twig,$mailer){
	$this->twig = $twig;
	$this->mailer = $mailer;
    }
    public function sendEmail(array $parcelOrder)
    {
	//var_dump($parcelOrder);
	//die();
        $message = \Swift_Message::newInstance()
            ->setSubject( 'ParcelOrder Notification' )
            ->setFrom( $parcelOrder['sender']['email'] )
            ->setTo( $parcelOrder['receiver']['email'] )
            ->setBody(
                $this->twig->render(
                    // app/Resources/views/ParcelOrder/confirmation_email.html.twig
                    'AppBundle::ParcelOrder/confirmation_email.html.twig',
            		array(
			'weight' => $parcelOrder['parcel']['weight'],		'note' => $parcelOrder['parcel']['note'],
			'name1' => $parcelOrder['sender']['first_name'],	'name2' => $parcelOrder['receiver']['first_name'],  
			'surname1' => $parcelOrder['sender']['last_name'], 	'surname2' => $parcelOrder['receiver']['last_name'],
			'city1' => $parcelOrder['sender']['city'],		'city2' => $parcelOrder['receiver']['city'],
			'street1' => $parcelOrder['sender']['city'],		'street2' => $parcelOrder['receiver']['city'],
			'code1' => $parcelOrder['sender']['postal_code'],	'code2' => $parcelOrder['receiver']['postal_code'],
			'phone1' => $parcelOrder['sender']['phone'],		'phone2' => $parcelOrder['receiver']['postal_code'],
			'email1' => $parcelOrder['sender']['email'],		'email2' => $parcelOrder['receiver']['email']
			) 
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->mailer->send($message);
    }
}


