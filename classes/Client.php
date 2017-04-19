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
    public static function clientSelected(array $clients) {
        
        return collect($clients)->sum();
    }
    

    /**
     * 返回选中的客户端
     * @param integer $selected
     */
    public static function clients($selected) {
        
        $clients = [];
        
        if (self::IPHONE & $selected) $clients[] = self::IPHONE;
        if (self::ANDROID & $selected) $clients[] = self::ANDROID;
        if (self::H5 & $selected) $clients[] = self::H5;
        if (self::PC & $selected) $clients[] = self::PC;
        
        return $clients;
    }
    
}
