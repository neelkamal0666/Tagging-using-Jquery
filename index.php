<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="bootstrap.min.css">
<style type="text/css">
.tags {
background-color:#b3cee1; width:auto; float:left; border-bottom:1px solid #b3cee1; border-right:1px solid #b3cee1;padding: 3px 4px 3px 4px;margin: 2px 2px 2px 0;
}
a.boxclose{
    float:right;
    cursor:pointer;
    color: #fff;
    font-size: 17px;
    font-weight: bold;
    display: inline-block;
    line-height: 0px;
    padding: 11px 3px;       
}

.boxclose:before {
    content: "×";
}
</style>
<title>Test</title>

</head>

<body id="body">
<input type="hidden" name="tags" id="tagged_value" />
<div id="tagged"></div><br />
<input id="tags" style="width:200px;" type="text" placeholder="tags" class="form-control"/>
<div id="display" style="clear:both;"></div>

</body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var server='http://localhost/tag';
$(document).ready(function(){
$("#tags").keyup(function() {
var key = $(this).val();
var dataString = 'key='+ key;
if(key==''){
} else {
	$.ajax({
	type: "POST",
	url: server+"/suggestion.php",
	data: dataString,
	cache: false,
	success: function(html) {
	$("#display").html(html).show();	  
	  	jQuery(document).ready(function() {
			$(".tag_suggestion").click(addTag);
			 $(".tags").click(removeTag);
		});    
	}

});
}return false;    
});
});
function addTag(flag) {
	if(flag==1) {
		var val=$('#tags').val().trim();
	} else {
		var val=$(this).attr("id");
	} var val1=1;
	    $( "#tagged" ).append('<p class="tags" id="rem_'+val+'">'+val+'<a class="boxclose" val="'+val1+'" ></a></p>');
		var new_tag = $("#tagged_value").val();
		if(new_tag=='') {
		new_tag = val;
		} else {
		new_tag=new_tag+','+val;
		}
		$("#tagged_value").val(new_tag);
		$("#tags").val('');
		$("#display").replaceWith('<div id="display" style="clear:both;"></div>');
        return false; // <--- important, prevents the link's href (hash in this example) from executing.
      }
 function removeTag() {
 		var old_tag = $("#tagged_value").val();
 		var res_arr = old_tag.split(",");
		var new_tag='';
		for (i=0;i<res_arr.length;i++) {
			if(res_arr[i] != rem_val ){
				if(new_tag=='') {
				new_tag = res_arr[i] 
				} else {
				new_tag=new_tag+','+res_arr[i];
				}
			}
		}
		var rem_val = $(this).atrr("val");
		$("#tagged_value").val(new_tag);
		$( "#rem_" +rem_val).remove();
		
        return false; // <--- important, prevents the link's href (hash in this example) from executing.
      }
  jQuery(document).ready(function() {
		 $(".tags").click(removeTag);
      });         
 $('#tags').keypress(function(event){
 	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		 addTag(1);	
	}
 
});

</script>
