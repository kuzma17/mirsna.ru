<h3>Подбор матраса</h3>
<div class="line2"></div>
<div class="matress">
    <table cellpadding="1" cellspacing="3">
        <form id="select_form" name="select" method="POST" action="/select">
            {{ csrf_field() }}
            <TR>
                <TD>Бренд:</TD>
                <td>
                    <select name="brand">
                        <OPTION value="">Не важно</OPTION>
                        @foreach(\App\Brand::where('status', 1)->orderBy('num', 'asc')->get() as $brand)
                            <option value="{{ $brand->id }}" @if(Request::input('brand') == $brand->id) selected="selected" @endif>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </td>
            </TR>
            <tr>
                <TD>Размер:</TD>
                <td>
                    <select name="size">
                        <OPTION value="">Не важно</OPTION>
                        @foreach(\App\Size::where('status', 1)->orderBy('num', 'asc')->get() as $size)
                            <option value="{{ $size->id }}" @if(Request::input('size') == $size->id) selected="selected" @endif>{{ $size->x.' x '.$size->y }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <TD>Высота:</TD>
                <td>
                    <select name="height">
                        <OPTION value="">Не важно</OPTION>
                        @foreach(\App\Height::where('status', 1)->orderBy('num', 'asc')->get() as $height)
                            <option value="{{ $height->id }}" @if(Request::input('height') == $height->id) selected="selected" @endif>{{ $height->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <TD>Пружинный блок:</TD>
                <td>
                    <select name="spring">
                        <OPTION value="">Не важно</OPTION>
                        @foreach(\App\Spring::where('status', 1)->orderBy('num', 'asc')->get() as $spring)
                            <option value="{{ $spring->id }}" @if(Request::input('spring') == $spring->id) selected="selected" @endif>{{ $spring->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <TD>Жесткость:</TD>
                <td>
                    <select name="hard">
                        <OPTION value="">Не важно</OPTION>
                        @foreach(\App\Hard::where('status', 1)->orderBy('num', 'asc')->get() as $hard)
                            <option value="{{ $hard->id }}" @if(Request::input('hard') == $hard->id) selected="selected" @endif>{{ $hard->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <TD nowrap="true">Вес на место:</TD>
                <td>
                    <select name="weight">
                        <OPTION value="">Не важно</OPTION>
                        @foreach(\App\Weight::where('status', 1)->orderBy('num', 'asc')->get() as $weight)
                            <option value="{{ $weight->id }}" @if(Request::input('weight') == $weight->id) selected="selected" @endif>{{ $weight->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <TD>Цена от/до (грн.):</TD>
                <td><input class="price_select" name="price_from" type="text" value="{{ Request::input('price_form') }}">
                    <input class="price_select" style="margin-left:10px" name="price_to" type="text" value="{{ Request::input('price_to') }}">
                </td>
            </tr>
            <tr>
                <TD></TD>
                <td>
                    <button type="reset" id="reset" style="width:100%"> очистить </button>
                </td>
            </tr>
            <tr>
                <TD colspan="2" align="center">
                    <input type="hidden" name="sort" id="sort" value="asc">
                    <input class="button" type="submit" value="подобрать матрас">
                </TD>
            </tr>
        </form>
    </table>

</div>