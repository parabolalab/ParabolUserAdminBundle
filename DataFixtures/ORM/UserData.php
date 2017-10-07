<?php
namespace Aliso\ApartmentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Parabol\AdminCoreBundle\Entity\User;


class UserData implements FixtureInterface, ContainerAwareInterface 
{
 
    /**
     * @var ContainerInterface
     */
    private $container;
 
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    private $manager;
  
    public function load(ObjectManager $manager)
    {

        $this->manager = $this->container->get('fos_user.user_manager');  

        $users = $this->container->getParameter('default_users');
        
        if($users)
        {
            foreach($users as $user)
            {
                $this->createUser($user['username'], $user['email'], $user['password'], 'ROLE_ADMIN'); 
            }
        }        
      
    }


    public function createUser($name, $email, $pass, $role)
    {
        $user = $this->manager->createUser();
        $user->setUsername($name);
        $user->setEmail($email);
        $user->setPlainPassword($pass);
        $user->addRole($role);
        $user->setEnabled(true);

        $this->manager->updateUser($user);
    }

}