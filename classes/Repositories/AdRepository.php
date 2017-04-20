<?php

namespace Ecjia\App\Adsense\Repositories;

use Royalcms\Component\Repository\Repositories\AbstractRepository;
use Ecjia\App\Adsense\Client;

class AdRepository extends AbstractRepository
{
    protected $model = 'Ecjia\App\Adsense\Models\AdModel';
    
    protected $orderBy = ['sort_order' => 'desc'];
    
    protected $type;
    
    public function __construct($type)
    {
        parent::__construct();
        
        $this->type = $type;
    }
    
    /**
     * 获取所有的客户端列表
     * 
     * @return array
     */
    public function getAllClients() {
        $clients = array(
            'iPhone' => Client::IPHONE,
            'Android'=> Client::ANDROID,
            'H5' 	 => Client::H5,
            'PC'     => Client::PC
        );
        return $clients;
    }
    
    
    public function getAvailableClients($position) {
        $clients = $this->getAllClients();
        
        $available = collect($clients)->mapWithKeys(function ($item, $key) use ($position) {
            $where = [
                'position_id' => $position,
                'show_client' => ['show_client', '&', $item],
                ];
        	$count = $this->findWhere($where, ['ad_id'])->count();
        	if ($count > 0)
        	   return [$key => $count];
        	return [];
        });

        return $available->toArray();
    }
    
    
    public function getAds($position, $client) {
        if (empty($client))
        {
            return [];
        }
        
        $where = [
        	'position_id' => $position,
            'show_client' => ['show_client', '&', $client],
        ];
        $result = $this->findWhere($where, ['ad_id', 'ad_code', 'ad_link', 'sort_order']);

        return $result->toArray();
    }
    
    
    
}