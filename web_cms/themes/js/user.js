function sel_slct(){
	$("select option").each(function(){
		if (!$(this).find("option:selected").length){
        if($(this).val()==$(this).closest('select').attr('title')){ 
            $(this).attr("selected","selected");    
        }
		}
    });
	}
function hidebtn(){
$('input[type=submit]').attr("disabled", "disabled");
$('input[type=submit]').css("opacity", "0.5")
}
function showbtn(){
$('input[type=submit]').removeAttr("disabled");
$('input[type=submit]').css("opacity", "1")
}

$(document).ready(function(){
$('form').each(function(){$(this).validate();}) 	

$("#wait").bind("ajaxSend", function(){
   $(this).show();
 }).bind("ajaxComplete", function(){
   $(this).hide();
 });	

$('a[name="Delete"]').click(function(){return confirm("Are You sure")});
$('addnew a, a[name=Edit],.addnew,.pop').fancybox({
 			'hideOnContentClick' : false,
			'hideOnOverlayClick' : false,
			'onComplete': function() {
				$(".editor").cleditor({ controls: "source bold italic underline subscript superscript size | bullets numbering | outdent indent | alignleft center alignright justify | undo redo | link unlink | cut copy paste pastetext | table",height:350});
			$("#fancybox-title").css({'top':'0px', 'bottom':'auto', 'margin-top':'-10px', 'left':'auto'});
			$('input[type=date],.dt').datepicker();
			$("#fancybox-content form").validate();
			upload_file_av();
			
			
			
			$("#fancybox-content").find('input[type=text],textarea,select').filter(':visible:first').focus();
				}
		});
 	
	sel_slct();		
 
$('input.dt').datepicker();
$('a[name="Print"]').attr("target","_blank");
$("#wait").fadeOut('fast');
var loc = window.location.href;
$("a").each(function() {
	if(this.href == loc){$(this).addClass('sl');}
	if(!$(this).attr('title') && $(this).attr('href')){
	$(this).attr('title', $(this).text());
	}
	});

 
/*****Delete Bill*****/
$(".del_aj").click(function(){
				if (confirm("Are you sure you want to delete Bill no "+$(this).attr("title"))) {
					$(this).closest('tr').fadeTo('slow', 0.5);
					$.ajax({
						type: "POST",
						data: "k_del_id=" + $(this).attr("id")
						+'&&f_year='+$('#f_year').val(),
						url: "functions/bill_ajax.php?del_aj=okdelfdf",
							success: $.proxy(function(msg){
							if(msg==1){	$(this).closest('tr').remove();}
							else {alert('Error! Please reload Page.');}
							
						},this),
					  error: function() {
						alert("Error! Delete Process");
						  }
						  }); 
				clickEvent.preventDefault(); return false; }
	});
						  
$("#page > table:not(.bo_tbl) tr").click(function(){
	$(this).closest("table").find('.tbl_row').removeClass("tbl_row");
	$(this).addClass("tbl_row");
	$('html,body').animate({scrollTop: $(".tbl_row").offset().top-=200},'slow');
})

$('#set_nmu').toggle(

        function() {
			$(this).html('&#8690;');
            $('#activity_menu').animate({ top: -$("#activity_menu").height()+100 }, 'slow', 'easeInOutQuart')
        },
        function() {
			$(this).html('&#8689;');
            $('#activity_menu').animate({ top: '100' }, 'slow', 'easeInOutQuart')
        }
);
$('#set_nmu').click();

$("a[rel=vw_pg]").fancybox({'titleShow': false,});
});


  ( jQuery );
