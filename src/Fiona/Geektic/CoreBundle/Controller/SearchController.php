<?php

namespace Fiona\Geek2geek\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends BaseController
{
    public function searchAction(Request $request)
    {

        $name = $request->get('gsearch', "");
        $gender = $request->get('ggender', "BOTH");
        $interests = $request->get('ginteret', array());

        $indexedInterests = array();

        foreach ($interests as $interest) {
            $indexedInterests[$interest] = $interest;
        }

        $geeks = $this->getRepository('Geek')->getGeekLike($name, $gender);
        $matchGeeks = array();

        if (empty($interest)) {
            $matchGeeks = $geeks;
        } else {
            foreach($geeks as $geek) {
                $found = false;

                foreach($indexedInterests as $idInterest) {
                    if ($geek->hasInterest($idInterest)) {
                        $found = true;
                        break;
                    }
                }

                if ($found) {
                    $matchGeeks[] = $geek;
                }
            }
        }

        return $this->render('FionaGeek2geekCoreBundle:Search:search.html.twig', array(
            'geeks' => $matchGeeks,
            'interets' =>  $this->getRepository('Interest')->findAll(),
            'gsearchvalue' => $name,
            'ggendervalue' => $gender,
            'indexedInterests' => $indexedInterests
        ));
    }
}
