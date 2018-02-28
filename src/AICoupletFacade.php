<?php
/**
 * This file is part of ruogoo.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\AIToy;

use Illuminate\Support\Facades\Facade;

class AICoupletFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ruogoo.ai.couplet';
    }
}
