<?php
  
namespace App\Enums;
 
enum CategoryStatusEnum:int {
    case Active = 1;
    case Inactive = 0;
    public static function fromName(string $name){
    
        return constant("self::$name");
    }
}