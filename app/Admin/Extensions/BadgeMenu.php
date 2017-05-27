<?php

namespace App\Admin\Extensions;

use App\Brend;
use App\Order;

class BadgeMenu
{

    public static function countOrder(){
        $countOrder = Order::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/orders"]');
            obj.append( '<span class="label label-danger" style="position:absolute; right: 10px" >$countOrder</span>' );
EOT;
        return $script;
    }

    public static function countBrand(){
        $countBrand = Brend::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/brends"]');
            obj.append( '<span class="label label-success" style="position:absolute; right: 10px" >$countBrand</span>' );
EOT;
        return $script;
    }
    
}