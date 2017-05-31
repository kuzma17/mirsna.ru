/**
 * Created by kuzma on 27.05.17.
 */

$(document).ready(function () {


    $(document).on("click", ".btn-success", function () {

        ///var htm = $('.size_id').html();

        num_el = $('select.size_id').size();

        last_el = $('select.size_id').last().html();

        //alert(last_el);

        i = 0;
        arr_opt = new Array();

        n = 2;
        t = 0;

        $('select.size_id').each(function (e)
        {
            if(i == (num_el - 1)){
               // $(this).find('[value=1]').remove();
               // $(this).find('[value=' + n + ']').remove();
                while(t < arr_opt.length){
                    alert(arr_opt[t]);
                    $(this).find('[value=' + arr_opt[t] + ']').remove();
                    t++;
                };
                alert($(this).html());
            }else{
                arr_opt[i] = $(this).val();
                //alert($(this).val())
            }


           // alert($(this).html() + '||' + $(this).val())
            i++;
        });

        //alert('arr ' + arr_opt.length);

       // $.each(arr_opt, function (key, value) {
           // alert(value);
        //})

        alert($('select.size_id').html());

    });




  //$('button[type="submit"]').click(function () {
   //   $("form").submit(function(){
     //     alert($('input#price').val());
  //        alert(42243); return false;});
//
     // alert(3213213);
  //})

});
