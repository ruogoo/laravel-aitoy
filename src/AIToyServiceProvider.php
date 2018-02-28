<?php
/**
 * This file is part of ruogoo.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\AIToy;

use Illuminate\Support\ServiceProvider;

class AIToyServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->singleton('ruogoo.ai.couplet', function () {
            return new MicrosoftCouplet();
        });
    }

    public function boot()
    {
        //
    }

    public function provides(): array
    {
        return ['ruogoo.ai.couplet'];
    }
}
