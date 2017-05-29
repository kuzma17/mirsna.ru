$(document).ready(function(){  
$('.menu ul li').hover(
        function () {
            $('ul', this).stop(true, true);
            $('ul', this).slideDown(300);
            $("ul li ul", this).hide();
        },
        function () {
           $('ul', this).hide();
        });

$('.price_select').bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});

$('.sortseach a').click(function(){
var sortitem = $(this).attr('sort');
	$("#sort").val(sortitem);
	$("form:first").submit();
	});

	$('button#reset').click(function(){
		$("select option:selected").each(function(){
			this.selected=false;
		});
	});

$('.list_item').click(function(){
var urlpage = $(this).attr('urlpage');
	window.location.href = urlpage;
});

var key_video = 1;
$('#video_a').click(function() {
if(key_video==1){
bringback1 = $("#fr").clone(true);
$('#video').animate({height: "hide"}, 700,function(){
$("iframe").remove();
});
$('.video_box').animate({marginLeft: "0px",width: "140px"}, 700);
$('.video_box').animate({marginTop: "0px"}, 400);
$('#video_a').text("показать видео");
key_video = 0;
}else{
$('.video_box').animate({marginTop: "30px"}, 400);
$('.video_box').animate({marginLeft: "70px",width: "560px"}, 700, function(){
 $('#fr').html(bringback1);
$('#fr').show('fast');
});
$('#video_a').text("скрыть видео");
key_video = 1;
}
});

var cache = {};
$('a.info').hover(
	function (e) {
	var id_info = $(this).attr('rel');
	var xinfo = e.pageX + 5; // X coordinates mouse
	var yinfo = e.pageY + 5; // Y coordinates mouse
	if(id_info in cache){
	showInfo(cache[id_info].text);
		}else{
			$('div.floating').css({top: yinfo, left: xinfo, width: 100});
			$('div.floating').prepend('<img src="images/294.gif">');
			$('div.floating').stop(false, true).show();
				$.ajax({
           			url: "modules/info.php",
           			type: "POST",
           			data: {"id_info":id_info},
           			cache: false,
           			success: function(response){
               				if(response == 0){
					$('div.floating').hide();
                  			alert("нет записей");
               					}else{	
						$('div.floating').empty(); // Clean InfoBlock
		 				$('div.floating').stop(false, true).hide();
						cache[id_info] = {text: response}; // insert data to cache
						showInfo(response);
               				}
            			}
         		});
		}

function showInfo(textInfo){
	var bodyX = $(window).width(); // size X BODY
	//var bodyY = $(window).height(); // size Y BODY
	var infoWidth = 200;    // size default InfoBlock 
	var infoWidthMin = 200; // min size InfoBlock
	var infoWidthMax = 400; // max size InfoBlock
	if(textInfo.length > 600){
		infoWidth = infoWidthMax;
		}else{
		infoWidth = infoWidthMin;
		}
	if((xinfo + infoWidth + 10) > bodyX){
	xinfo = xinfo - infoWidth - 10;
	}
	$('div.floating').css({top: yinfo, left: xinfo, width: infoWidth});
	$('div.floating').prepend(textInfo); //Insert data
	$('div.floating').stop(false, true).slideDown(500);
	}
},
	function () {
           $('div.floating').stop(false, true).hide();
	$('div.floating').empty();
        }
);

 });

