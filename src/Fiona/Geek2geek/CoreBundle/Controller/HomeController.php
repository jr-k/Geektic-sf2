<?php

namespace Fiona\Geek2geek\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends BaseController
{
    public function homeAction()
    {
        return $this->render('FionaGeek2geekCoreBundle:Home:home.html.twig', array());
    }
}
