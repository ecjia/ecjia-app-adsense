<?php

namespace Ecjia\App\Adsense;

use Ecjia\App\Adsense\Repositories\CycleImageRepository;

class CityManage
{
    
    protected $type;
    
    public function __construct($type)
    {
        $this->type = $type;
    }
    

    public function getAllCitys()
    {
        
        if ($this->type == 'cycleimage') {
            $repository = new CycleImageRepository();
            return $repository->getAllCitys();
        }
        
        
    }
    
    
    
    
    

}


