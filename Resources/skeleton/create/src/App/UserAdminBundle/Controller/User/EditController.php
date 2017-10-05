<?php

namespace App\UserAdminBundle\Controller\User;

use Admingenerated\AppUserAdminBundle\BaseUserController\EditController as BaseEditController;

/**
 * EditController
 */
class EditController extends BaseEditController
{
	public function postSave(\Symfony\Component\Form\Form $form, \Parabol\UserBundle\Entity\User $User)
    {
    	$request = $this->get('request_stack')->getCurrentRequest();
    
    	$values = $request->get($form->getName());
    	if(isset($values['plainPassword'])) 
    	{
    		$User->setPlainPassword($values['plainPassword']);
    		$this->get('fos_user.user_manager')->updateUser($User);
    	}
    	

    	
    }
}
