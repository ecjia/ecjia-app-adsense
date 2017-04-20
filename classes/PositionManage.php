<?php

namespace Ecjia\App\Adsense;

use Ecjia\App\Adsense\Repositories\CycleImageRepository;

class PositionManage
{
    
    protected $type;
    
    protected $city;
    
    
    
    
    public function __construct($type, $city)
    {
        $this->type = $type;
        $this->city = $city;
    }
    
    
    public function getAllGroups()
    {
    
        if ($this->type == 'cycleimage') {
            
            $repository = new CycleImageRepository();
            return $repository->getAllGroups();
            
        }
        
    }
    
    
    
    
    
    
    
    
    
}