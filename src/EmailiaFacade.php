<?php

namespace Hadefication\Emailia;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hadefication\Emailia\Emailia
 */
class EmailiaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emailia';
    }
}
