<?php
$categories = \App\Category::where('status', 1)->orderBy('num', 'asc')->get();

function is_parent($categories, $id){
    foreach($categories as $category){
        if($category->parent_id == $id){
            return true;
        }
    }
    return false;
}
?>

<ul class="parent0">
    @foreach($categories as $menu)
        @if($menu->parent_id == 0)
            <li class="lin0">
                @if($menu->url)
                    <a href="{{ $menu->url }}">{{ $menu->title }}</a>
                @else
                    <span>{{ $menu->title }}</span>
                @endif
                @if(is_parent($categories, $menu->id))
                    <ul class="parent1">
                         @foreach($categories as $menu1)
                                @if($menu1->parent_id == $menu->id)
                                <li class="lin1"><a href="{{ $menu1->url }}">{{ $menu1->title }}</a>

                                    @if(is_parent($categories, $menu1->id))
                                     <ul class="parent2">
                                        @foreach($categories as $menu2)
                                            @if($menu2->parent_id == $menu1->id)
                                            <li class="lin2"><a href="{{ $menu2->url }}">{{ $menu2->title }}</a></li>
                                            @endif
                                         @endforeach
                                     </ul>
                                    @endif
                                </li>
                                @endif
                        @endforeach
                    </ul>
                 @endif
            </li>
        @endif
    @endforeach
</ul>
