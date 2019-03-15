<?php

namespace App\UserAdminBundle\Form\Type\User;

use Admingenerated\AppUserAdminBundle\Form\BaseUserType\EditType as BaseEditType;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * EditType
 */
class EditType extends BaseEditType
{
	use \Parabol\BaseBundle\Form\Type\Base\BaseType;

	public function getOptionsPlainPassword(array $builderOptions = array())
	{
		
		$fieldOptions = parent::getOptionsPlainPassword($builderOptions);

		$fieldOptions['constraints'] = array(
							new Assert\Length(array(
                                    'min' => 8,
                                    'max' => 40,
                                    'minMessage' => "Password must be at least {{ limit }} characters long.",
                                    'maxMessage' => "Password cannot be longer than {{ limit }} characters.",
                         	)),
                         	new \Parabol\AdminCoreBundle\Validator\Constraints\EqualFields(array('fields' => ['plainPassword', 'plainPasswordConfirmation'])),
        );

		return $fieldOptions;
	
	}

	protected function getTypeRoles()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\ChoiceType';
    }
}
