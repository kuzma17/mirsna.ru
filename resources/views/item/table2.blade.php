<?php
$size = \App\SizePillow::find($item->price_pillow->size_id);
?>

<table class="price" cellspacing="1" cellpadding="1" style="width:70%">
    <tr>
        <td>Размер (мм)</td>
        <td>Стоимость модели (грн.)</td>
    </tr>
    <tr>
        <td>{{ $size->x.' x '.$size->y.' x '.$size->h }}</td>
            <td>
                @if($discount)
                    <span style="text-decoration:line-through; color:#8E8E8E">
                        {{ $item->price_pillow->price }}
                    </span><br>
                    <span style="color:red">
                        {{ $item->price_pillow->price - (($item->price_pillow->price / 100) * $discount) }}
                    </span>
                @else
                    {{ $item->price_pillow->price }}
                @endif
            </td>

    </tr>
</table>