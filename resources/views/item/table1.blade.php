<table class="price" cellspacing="1" cellpadding="1">
    <tr>
        <td width="96">Размеры</td>
        <td colspan="{{ count($arr_x) }}">Ширина (мм)</td>
    </tr>
    <tr>
        <td>Длина (мм)</td>
        @foreach($arr_x as $x)
            <td>{{ $x }}</td>
        @endforeach
    </tr>
    @foreach($arr_y as $y)
        <tr>
            <td>{{ $y }}</td>
            @foreach($arr_x as $x)
                <td>
                    @if($discount)
                        <span style="text-decoration:line-through; color:#8E8E8E">
                                {{ $arr_price[$x][$y]['price'] or '-'}}
                            </span><br>
                        <span style="color: red">
                                {{ $arr_price[$x][$y]['price2'] or ''}}
                            </span>
                    @else
                        {{ $arr_price[$x][$y]['price'] or '-'}}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
    @if(isset($item->custom_price))
        <tr>
            <td colspan="{{ count($arr_x) + 1 }}">
                Нестандартный размер (стоимость за 1 кв. м.) -
                @if($discount)
                    <span style="text-decoration:line-through; color:#8E8E8E">
                               {{ $item->custom_price->price }}
                        </span>
                    <span style="color: red">
                                {{ $item->custom_price->price - (($item->custom_price->price / 100) * $discount) }}
                        </span>
                @else
                    {{ $item->custom_price->price }}
                @endif
            </td>
        </tr>
    @endif
</table>