<?php

namespace Club\APIBundle\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseListener
{
  protected $container;

  public function __construct($container)
  {
    $this->container = $container;
  }

  public function onKernelResponse(FilterResponseEvent $event)
  {
    if (!preg_match("/^\/api/", $this->container->get('request')->getPathInfo()))
      return;

    $response = $event->getResponse();
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $event->setResponse($response);
  }
}
