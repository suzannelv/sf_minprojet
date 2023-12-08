<?php

namespace App\EventSubscriber;
use App\Repository\LanguageRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;



class DropDownLangSubscriber implements EventSubscriberInterface

{
  const ROUTES = ['course_page'];
  public function __construct(
    private LanguageRepository $languageRepository, 
    private Environment $twig
    ){

  }
  public function injectGlobalVariable(RequestEvent $event):void
  {
      $route = $event->getRequest()->attributes->get('_route');
      if(in_array($route, self::ROUTES)) {
         $languages = $this->languageRepository->findAll();
         $this->twig->addGlobal('allLangues', $languages);
      }
  }
  public static function getSubscribedEvents()
  {
    return [KernelEvents::REQUEST=>'injectGlobalVariable'];
  }
}