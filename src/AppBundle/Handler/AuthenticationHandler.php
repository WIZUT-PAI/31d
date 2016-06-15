<?php
namespace AppBundle\Handler;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {
  private $router;
  public function __construct(Router $router) {
    $this->router = $router;
  }
  public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
    //if ($request->isXmlHttpRequest()) {
      $result = array('success' => true);
      $response = new Response(json_encode($result));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    //}
  }
  public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
    //if ($request->isXmlHttpRequest()) {
      $result = array('success' => false, 'message' => $exception->getMessage());
      $response = new Response(json_encode($result));
      $response->headers->set('Content-Type', 'application/json');
      $response->setStatusCode(Response::HTTP_BAD_REQUEST);
      return $response;
    //}
  }
}