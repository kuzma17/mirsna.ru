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
                        <?php
                        $body->options("brend");
                        while ($row=mysql_fetch_array($body->sql_res)){
                            echo '<OPTION value="'.$row["id"].'"';
                            if($_POST["brend"] && $_POST["brend"]==$row["id"]){
                                echo ' selected';}
                            echo '>'.$row["name"].'</OPTION>';
                        }
                        ?>
                    </select>
                </td>
            </TR>
            <tr>
                <TD>Размер:</TD>
                <td>
                    <select name="size">
                        <OPTION value="">Не важно</OPTION>
                        <?php
                        $body->options("size");
                        while ($row=mysql_fetch_array($body->sql_res)){
                            echo '<OPTION value="'.$row["id"].'"';
                            if($_POST["size"] && $_POST["size"]==$row["id"]){
                                echo ' selected';}
                            echo '>'.$row["name"].'</OPTION>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <TD>Высота:</TD>
                <td>
                    <select name="height">
                        <OPTION value="">Не важно</OPTION>
                        <?php
                        $body->options("height");
                        while ($row=mysql_fetch_array($body->sql_res)){
                            echo '<OPTION value="'.$row["id"].'"';
                            if($_POST["height"] && $_POST["height"]==$row["id"]){
                                echo ' selected';}
                            echo '>'.$row["name"].'</OPTION>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <TD>Пружинный блок:</TD>
                <td>
                    <select name="pr_block">
                        <OPTION value="">Не важно</OPTION>
                        <?php
                        $body->options("pr_block");
                        while ($row=mysql_fetch_array($body->sql_res)){
                            echo '<OPTION value="'.$row["id"].'"';
                            if($_POST["pr_block"] && $_POST["pr_block"]==$row["id"]){
                                echo ' selected';}
                            echo '>'.$row["name"].'</OPTION>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <TD>Жесткость:</TD>
                <td>
                    <select name="hard">
                        <OPTION value="">Не важно</OPTION>
                        <?php
                        $body->options("select_hard");
                        while ($row=mysql_fetch_array($body->sql_res)){
                            echo '<OPTION value="'.$row["id"].'"';
                            if($_POST["hard"] && $_POST["hard"]==$row["id"]){
                                echo ' selected';}
                            echo '>'.$row["name"].'</OPTION>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <TD nowrap="true">Вес на место:</TD>
                <td>
                    <select name="weight">
                        <OPTION value="">Не важно</OPTION>
                        <?php
                        $body->options("weight");
                        while ($row=mysql_fetch_array($body->sql_res)){
                            echo '<OPTION value="'.$row["id"].'"';
                            if($_POST["weight"] && $_POST["weight"]==$row["id"]){
                                echo ' selected';}
                            echo '>'.$row["name"].'</OPTION>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <TD>Цена от/до (грн.):</TD>
                <td><input class="price_select" name="price_from" type="text" value="<?php echo $_POST['price_from']; ?>">
                    <input class="price_select" style="margin-left:10px" name="price_to" type="text" value="<?php echo $_POST['price_to']; ?>">
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