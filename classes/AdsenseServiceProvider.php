<?php

namespace Ecjia\App\Adsense;

use Royalcms\Component\App\AppServiceProvider;

class AdsenseServiceProvider extends  AppServiceProvider
{
    
    public function boot()
    {
        $this->package('ecjia/app-adsense');
    }
    
    public function register()
    {
        
    }
    
    
    
}