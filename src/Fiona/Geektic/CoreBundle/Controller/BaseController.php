<?php

namespace Fiona\Geektic\CoreBundle\Controller;

use Fiona\Geektic\ApiBundle\Exception\ApiAccessDenied;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Base Controller
 */
class BaseController extends Controller {



    public function render($view, array $parameters = array(), \Symfony\Component\HttpFoundation\Response $response = null) {
        $response = parent::render($view, $parameters, $response);
        return $response;
    }

    public function getRequest() {
        return $this->get('request_stack')->getCurrentRequest();
    }

    /**
     * Shortcut to throw an AccessDeniedException($message) if the user is not authenticated
     */
    protected function forwardIfNotAuthenticated($message = 'warn.user.notAuthenticated'){
        if (!is_object($this->getUser()))
        {
            return new ApiAccessDenied($message);
        }

        return null;
    }


    protected function formToJsonResponse($form)
    {
        $errors = $form->getErrors(true);
        $output = array();

        foreach($errors as $error) {
            $output[] = $this->get('translator')->trans($error->getMessage(), array(), 'FionaGeekticCoreBundle');
        }

        return new JsonResponse(array('errors' => $output), Response::HTTP_BAD_REQUEST);
    }



    protected function exceptionToJsonResponse($exception)
    {
        return new JsonResponse(array(
            'code' => $exception->getStatusCode(),
            'message' => $this->get('translator')->trans($exception->getMessage(), array(), 'FionaGeekticCoreBundle')
        ), Response::HTTP_BAD_REQUEST);
    }


    public function persistAndFlush($object){
        $em = $this->getEntityManager();
        $em->persist($object);
        $em->flush();
        return $object;
    }


    public function removeAndFlush($object){
        $em = $this->getEntityManager();
        $em->remove($object);
        $em->flush();
        return $object;
    }

    public function strtocamel($k,$sep="_"){
        $camelVar = explode($sep,$k);
        $camelVarOut = "";foreach($camelVar as $camel){ $camelVarOut .= ucfirst(strtolower($camel)); }
        return $camelVarOut;
    }

    public function p($str){
        return $this->container->getParameter($str);
    }

    public function filefyname($filename) {

        if ($filename == "::1" || $filename == "127.0.0.1")
            return 1;

        $bad = array_merge(
            array_map('chr', range(0,31)),
            array("<", ">", ":", '"', "/", "\\", "|", "?", "*"));
        return str_replace($bad, "", $filename);
    }


    public function rmfiles($paths){
        foreach($paths as $path){
            if (file_exists($path)) { unlink($path);}
        }
    }

    public static function delTree($dir) {
        if (is_dir($dir)) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
        return null;
    }


    public function findOne($class) {
        $object = $this->getRepository($class)->findAll();
        $object = $object[0];
        return $object;
    }

    protected function isEmail($email) {
        return !empty($email) && preg_match(('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+[._a-z\p{L}0-9-]*\.[a-z0-9]+$/ui'), $email);
    }

    protected function trans($path, $array = null, $file = 'FionaGeekticCoreBundle') {
        if ($array == null)
            $array = array();
        return $this->get('translator')->trans($path, $array, $file);
    }

    /**
     * Get Entity Manager
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager() {
        return $this->getDoctrine()->getManager();
    }

    protected function getSecuredUser() {
        return $this->container->get('security.context')->getToken()->getUser();
    }

    /**
     * Get Security Context
     *
     * @return Symfony\Component\Security\Core\SecurityContext
     */
    protected function getSecurity() {
        return $this->get('security.context');
    }



    /**
     * Get a Repository
     *
     * @param string $class the entity class
     *
     * @return Doctrine\ORM\EntityRepository
     */
    protected function getRepository($class, $path = "FionaGeekticCoreBundle") {
        return $this->getDoctrine()->getManager()->getRepository($path . ":" . $class);
    }

    /**
     * Add Flash
     *
     * @param string $type type
     * @param string $text text
     */
    protected function addFlash($type, $text, $clear = false) {
        if ($clear) {
            $this->get('session')->getFlashBag()->clear();
        }

        $this->get('session')->getFlashBag()->add($type, $text);
    }


    protected function file_get_contents_utf8($fn) {
        $content = @file_get_contents($fn);
        return mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    }

    protected function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    protected function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
    }


}
