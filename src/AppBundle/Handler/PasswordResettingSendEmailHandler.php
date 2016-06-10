<?php
namespace AppBundle\Handler;

class PasswordResettingSendEmailHandler implements PasswordResettingSendEmailInterface
{
	private $twig;
	private $mailer;
	public function __construct($twig,$mailer){
		$this->twig = $twig;
		$this->mailer = $mailer;
	}
	public function sendResettingEmail(array $user_data){
		$message = \Swift_Message::newInstance()
			->setSubject( 'Password Reset Notification' )
			->setFrom( 'test@local.com' )
			->setTo( $user_data['email']
			->setBody( $this->twig->render(// app/Resources/views/email/password_ressetting.email.twig
			'AppBundle::UserBundle/confirmation_email.html.twig',
			array(
			'user.username' => $user_data['username'],
			'user.password' => $password['password']
			),
			'text/html'
		)
		$this->mailer->send($message);
	}
}
