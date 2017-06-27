<?php

namespace App\Admin\Extensions;

use App\Brand;
use App\Item;

class BadgeMenu
{

    public static function countItem(){
        $countOrder = Item::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/items"]');
            obj.append( '<span class="label label-danger" style="position:absolute; right: 10px" >$countOrder</span>' );
EOT;
        return $script;
    }

}