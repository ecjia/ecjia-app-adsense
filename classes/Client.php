<?php

namespace Ecjia\App\Adsense;

/**
 * 广告展示在多个客户端的处理
 * 
 * @author royalwang
 *
 */
class Client
{
    
    
    const IPHONE = 0x00000001;
    
    const ANDROID = 0x00000010;
    
    const H5 = 0x00000100;
    
    const PC = 0x00001000;
    
    /**
     * 计算客户端选中的总数
     * @param array $clients
     * @return integer
     */
    public function clientSelected(array $clients) {
        
        return collect($clients)->sum();
    }
    

    
}
