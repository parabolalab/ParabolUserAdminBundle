<?php

namespace App\UserAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use FOS\UserBundle\Controller\SecurityController as FOSUserSecurityController;

class SecurityController extends FOSUserSecurityController
{
    
    protected function renderLogin(array $data)
    {

        $request = $this->container->get('request_stack')->getCurrentRequest();

        $layout_name = preg_replace('#'.$request->getBaseUrl().'/{0,1}(.*)/[\w]+$#', '$1', $request->getRequestUri());
        
        try
        {
            $template = $this->render('FOSUserBundle:Security:login_'.$layout_name.'.html.twig', $data);    
        }
        catch(\Exception $ex)
        {
            $template = $this->render('FOSUserBundle:Security:login.html.twig', $data);    
        }

        return  $template;
        
    }

    
}
