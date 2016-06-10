<?php
namespace AppBundle\Handler;

Interface PasswordResettingSendEmailInterface
{
	public function sendResetingEmail(array $userData);
}
