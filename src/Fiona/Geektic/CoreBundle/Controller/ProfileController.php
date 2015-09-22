<?php

namespace Fiona\Geek2geek\CoreBundle\Controller;

use Fiona\Geek2geek\CoreBundle\Entity\Visit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends BaseController
{
    public function profileAction($id)
    {
        $geek = $this->getRepository('Geek')->find($id);

        if (!is_object($geek)) {
            return $this->redirect($this->generateUrl('fiona_geek2geek_core_homepage'));
        }

        $visit = new Visit();
        $visit->setIp($_SERVER['REMOTE_ADDR']);
        $visit->setGeek($geek);
        $this->persistAndFlush($visit);


        return $this->render('FionaGeek2geekCoreBundle:Profile:profile.html.twig', array(
            'geek' => $geek,
            'interets' =>  $this->getRepository('Interest')->findAll(),
        ));
    }
}
