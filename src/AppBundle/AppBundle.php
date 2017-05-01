<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
* Get FosUserBundle
*/
class AppBundle extends Bundle
{
    /**
    * @return string
    */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
