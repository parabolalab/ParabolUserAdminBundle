<?php

namespace Parabol\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ParabolUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
