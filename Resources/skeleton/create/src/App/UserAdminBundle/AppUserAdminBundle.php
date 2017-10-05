<?php

namespace Parabol\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppUserAdminBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
