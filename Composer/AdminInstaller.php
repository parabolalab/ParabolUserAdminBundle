<?php

namespace Parabol\UserAdminBundle\Composer;

use Symfony\Component\ClassLoader\ClassCollectionLoader;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;
use Composer\Script\Event;
use Parabol\BaseBundle\Component\Yaml\Yaml;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Marcin Kalota <marcin@parabolalab.com>
 */
class AdminInstaller extends \Parabol\BaseBundle\Composer\BaseScriptHandler
{

    protected static $bundles = [
        'FOS\UserBundle\FOSUserBundle',
    ];

    /**
     * Asks if the new directory structure should be used, installs the structure if needed.
     *
     * @param Event $event
     */
    public static function run(Event $event)
    {

        $options = static::getOptions($event);

        static::createUser($event, $options);

    }

    

    protected static function createUser($event, $options)
    {
        $io = static::getIO();


        if($io->confirm('Do you want create admin user?'))
        {
            $params = ['--super-admin' => ''];

            $params['username'] = $io->ask('username', 'admin');   
            $params['password'] = $io->askHidden('password', 'admin');

            $params['email'] = $io->askUntilIncorrect('email', 'admin@example.com', function($value) use ($io) { 
                        if(filter_var($value, FILTER_VALIDATE_EMAIL)) return $value;
                        else {
                            $io->error('Wrong email address.');
                            return false;
                        } 

            });

            static::executeCommand($options['symfony-bin-dir'], \FOS\UserBundle\Command\CreateUserCommand::class ,'fos:user:create', $params, $options['process-timeout']);

        }
        
    }

   

}
