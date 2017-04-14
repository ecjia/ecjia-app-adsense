<?php

namespace Ecjia\App\Adsense\Repositories;

use Royalcms\Component\Repository\Repositories\AbstractRepository;

class CycleImageRepository extends AbstractRepository
{
    
    
    protected $model = 'Ecjia\App\Adsense\Models\AdPositionModel';
    
    /**
     * 类型：轮播图(cycleimage)
     * @var string
     */
    protected $type = 'cycleimage';
    
    
    
    /**
     * 添加轮播图
     * 
     * @param string $code  唯一标识符
     * @param string $name  广告位名称
     * @param string $desc  广告位描述
     * @param integer $cityId   城市ID
     * @param string $cityName  城市名称
     * @param integer $maxNumber    最大可调用广告数量
     * @param integer $width    建议广告大小宽度
     * @param integer $height   建议广告大小高度
     */
    public function addCycleImage($code, $name, $desc, $cityId, $cityName, $maxNumber, $width, $height)
    {
        
    }
    
    
}
