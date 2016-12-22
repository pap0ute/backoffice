<?php

namespace TP\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TPTestBundle:Default:index.html.twig');
    }
}
