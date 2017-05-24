<h3>Подбор матраса</h3>
<div class="line2"></div>
<div class="matress">
    <table cellpadding="1" cellspacing="3">
        <form name="select" method="POST" action="index.php?id=select">
            <TR>
                <TD>Бренд:</TD>
                <td>
                    <select name="brend">
                        <OPTION value="">Не важно</OPTION>

                    </select>
                </td>
            </TR>
            <tr>
                <TD>Размер:</TD>
                <td>
                    <select name="size">
                        <OPTION value="">Не важно</OPTION>

                    </select>
                </td>
            </tr>
            <tr>
                <TD>Высота:</TD>
                <td>
                    <select name="height">
                        <OPTION value="">Не важно</OPTION>

                    </select>
                </td>
            </tr>

            <tr>
                <TD>Пружинный блок:</TD>
                <td>
                    <select name="pr_block">
                        <OPTION value="">Не важно</OPTION>

                    </select>
                </td>
            </tr>
            <tr>
                <TD>Жесткость:</TD>
                <td>
                    <select name="hard">
                        <OPTION value="">Не важно</OPTION>

                    </select>
                </td>
            </tr>
            <tr>
                <TD nowrap="true">Вес на место:</TD>
                <td>
                    <select name="weight">
                        <OPTION value="">Не важно</OPTION>

                    </select>
                </td>
            </tr>
            <tr>
                <TD>Цена от/до (грн.):</TD>
                <td><input class="price_select" name="price_from" type="text" value="">
                    <input class="price_select" style="margin-left:10px" name="price_to" type="text" value="">
                </td>
            </tr>
            <tr>
                <TD colspan="2" align="center">
                    <input type="hidden" name="sort" id="sort" value="0">
                    <input class="button" type="submit" value="подобрать матрас">
                </TD>
            </tr>
        </form>
    </table>

</div>