<?php
namespace Aliso\ApartmentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
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
        $output = new ConsoleOutput();

        $users = $this->container->getParameter('default_users');
        
        if($users)
        {
            foreach($users as $user)
            {
                if(!isset($user['password']) || $user['password'])
                {
                    $password = $this->generateRandomString(12);    
                }
                else {
                    $password = $user['password'];       
                }
                
                $output->writeln('Password for user <options=bold>' . $user['username'] . '</>: <fg=yellow;options=bold>' . $password. '</>');
                
                $this->createUser($user['username'], $user['email'], $password, $user['role']); 
            }
        }        
      
    }

    private function generateRandomString($length = 10) {
        $characters = '01234567890123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&()!@#$%^&()!@#$%^&()!@#$%^&()';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
