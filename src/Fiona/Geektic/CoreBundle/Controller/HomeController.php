<?php

namespace Fiona\Geektic\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends BaseController
{
    public function homeAction()
    {
        return $this->render('FionaGeekticCoreBundle:Home:home.html.twig', array());
    }
}
