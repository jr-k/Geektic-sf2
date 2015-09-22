<?php

namespace Fiona\Geektic\CoreBundle\Controller;

use Fiona\Geektic\CoreBundle\Entity\Visit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends BaseController
{
    public function profileAction($id)
    {
        $geek = $this->getRepository('Geek')->find($id);

        if (!is_object($geek)) {
            return $this->redirect($this->generateUrl('fiona_geektic_core_homepage'));
        }

        $visit = new Visit();
        $visit->setIp($_SERVER['REMOTE_ADDR']);
        $visit->setGeek($geek);
        $this->persistAndFlush($visit);


        return $this->render('FionaGeekticCoreBundle:Profile:profile.html.twig', array(
            'geek' => $geek,
            'interets' =>  $this->getRepository('Interest')->findAll(),
        ));
    }
}
