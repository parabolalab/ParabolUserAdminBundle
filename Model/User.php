<?php

namespace Parabol\UserAdminBundle\Model;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class User extends BaseUser
{

    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @Assert\Count(
     *      min = 1
     * )
     */
    protected $roles;

    protected $enabled = true;

    protected $plainPasswordConfirmation;

    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_ADMIN');
    }

   

    public function hasPlainPasswordConfirmation()
    {
        return true;
    }

    public function setPlainPasswordConfirmation($plainPasswordConfirmation)
    {
        $this->plainPasswordConfirmation = $plainPasswordConfirmation;

        return $this;
    }

    public function getPlainPasswordConfirmation()
    {
        return $this->plainPasswordConfirmation;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('username', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Email());
        // $metadata->addPropertyConstraint('plainPasswordConfirmation', new Assert\Length(array(
        //                             'min' => 8,
        //                             'max' => 40,
        //                             'minMessage' => "Password must be at least {{ limit }} characters long.",
        //                             'maxMessage' => "Password cannot be longer than {{ limit }} characters.",
        //                  )));

    }


}
