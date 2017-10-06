<?php

namespace App\UserAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="Parabol\UserAdminBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User extends \Parabol\UserAdminBundle\Model\User
{
	
}
