<?php

namespace App\UserAdminBundle\Form\Type\User;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Options class
 */
class Options
{
	// public function getPlainPasswordOptions(array $fieldOptions, array $builderOptions = array())
	// {
	// 	// var_dump(get_class($this)); die();
	// 	// die();
		
	// 	$fieldOptions['constraints'] = array(
	// 			new \Parabol\AdminCoreBundle\Validator\Constraints\EqualFields(array('fields' => ['plainPassword', 'plainPasswordConfirmation'])),
 //        );

	// 	return $fieldOptions;
	// }

	public function getRolesOptions(array $fieldOptions, array $builderOptions = array())
	{
		
		$fieldOptions = array(
				'multiple' => true,
                'expanded' => true,
                'choices' => array(
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    // 'ROLE_SEO' => 'ROLE_SEO',
                    // 'ROLE_USER' => 'ROLE_USER',
                 )
		);

		return $fieldOptions;
	
	}
}
