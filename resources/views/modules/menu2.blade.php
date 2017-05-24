<ul class="parent0">
    <?php
    //$num_menu=2; // select menu

    $menu = [
            [
                    'url' => 1,
                    'name' => 'home'
            ],
            [
                    'url' => 2,
                    'name' => 'contacts'
            ],
            [
                    'url' => 3,
                    'name' => 'about'
            ],
    ];

    $sub_menu1 = [
            [
                    'url' => 1,
                    'name' => 'home'
            ],
            [
                    'url' => 2,
                    'name' => 'contacts'
            ],
            [
                    'url' => 3,
                    'name' => 'about'
            ],
    ];
    $sub_menu2 = [
            [
                    'url' => 1,
                    'name' => 'home'
            ],
            [
                    'url' => 2,
                    'name' => 'contacts'
            ],
            [
                    'url' => 3,
                    'name' => 'about'
            ],
    ];

    $sub_menu3_ = [
            [
                    'url' => 1,
                    'name' => 'home'
            ],
            [
                    'url' => 2,
                    'name' => 'contacts'
            ],
            [
                    'url' => 3,
                    'name' => 'about'
            ],
    ];

    // $menu=$body->menu($num_menu, 0);
    for ($i=0; $i < count($menu); $i++){
        echo '<li class="lin0">';
        if($menu[$i]["url"]!=''){
            echo '<a href="'.$menu[$i]["url"].'">'.$menu[$i]['name'].'</a>';
        }else{ echo '<span>'.$menu[$i]['name'].'</span>'; }
        //$sub_menu1=$body->menu($num_menu, $menu[$i]['id']);
        if(isset($sub_menu1) && is_array($sub_menu1)){
            echo '<ul class="parent1">';
            for ($s1=0; $s1 < count($sub_menu1); $s1++){
                echo '<li ';
                if($sub_menu1[$s1]["url"]!=''){
                    echo 'class="lin1"><a href="'.$sub_menu1[$s1]["url"].'">'.$sub_menu1[$s1]['name'].'</a>';
                }else{ echo 'class="lin1_arrow"><span>'.$sub_menu1[$s1]['name'].'</span>'; }
                // $sub_menu2=$body->menu($num_menu, $sub_menu1[$s1]['id']);
                if(isset($sub_menu2) && is_array($sub_menu2)){
                    echo '<ul class="parent2">';
                    for ($s2=0; $s2 < count($sub_menu2); $s2++){
                        echo '<li class="lin2">';
                        if($sub_menu2[$s2]["url"]!=''){
                            echo '<a href="'.$sub_menu2[$s2]["url"].'">'.$sub_menu2[$s2]['name'].'</a>';
                        }else{ echo '<span>'.$sub_menu2[$s2]['name'].'</span>'; }
//-----
                        //$sub_menu3=$body->menu($num_menu, $sub_menu2[$s2]['id']);
                        if(isset($sub_menu3) && is_array($sub_menu3)){
                            echo '<ul class="parent3">';
                            for ($s3=0; $s3 < count($sub_menu3); $s3++){
                                echo '<li class="lin3"><a href="'.$sub_menu3[$s3]["url"].'">'.$sub_menu3[$s3]['name'].'</a>';
                                echo "</li>\n";
                            }
                            echo "</ul>\n";
                        }
//-----
                        echo "</li>\n";
                    }
                    echo "</ul>\n";
                }
                echo "</li>\n";
            }
            echo "</ul>\n";
        }
        echo "</li>\n";
    }
    ?>
</ul>
