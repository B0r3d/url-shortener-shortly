<?php


namespace App\Http\Action;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class Home extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('base.html.twig');
    }
}