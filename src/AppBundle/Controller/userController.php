<?php
namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of userController
 *
 * @author komputer
 */
class userController extends FOSRestController {
  public function getUserAction() {
    if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
      return "NULL";
    }
    $user = $this->get('security.token_storage')->getToken()->getUser();
    return $user;
  }
}