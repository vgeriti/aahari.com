function initMap() {
	//alert(mapDat);
	var latlng = new google.maps.LatLng(mapDat.lat, mapDat.lon)
  var mapOptions = {
    zoom: 14,
    //center: new google.maps.LatLng(-34.397, 150.644)
    center: latlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  var marker = new google.maps.Marker({
      position: latlng,
      map: map
  });
}
 
function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +'callback=initMap';
  document.body.appendChild(script);
}
	

function add_to_cart(id){
	//alert('adding');
//	var input='id=';
		$.ajax({
			type: "POST",
			url: "manag/php/cart_util.php",
			data: {rest_id:id, quant:$('#quant_'+id).val()},
			cache: false,
			dataType: "json",
			success: function(data)
			{
				var dishes = data['html'];
				$('.cart_items').html(dishes);
				$('#sub_total').html(data['total_price']);
			}
		});
}

function remove_from_cart(id){	
		$.ajax({
			type: "POST",
			url: "manag/php/cart_util.php",
			data: {dsh_rm:id},
			cache: false,
			dataType: "json",
			success: function(data)
			{
				var dishes = data['html'];
				$('.cart_items').html(dishes);								
			}
		});
}

function increase_quantity(id){	
		$.ajax({
			type: "POST",
			url: "manag/php/cart_util.php",
			data: {dsh_inc:id},
			cache: false,
			dataType: "json",
			success: function(data)
			{
				var dishes = data['html'];
				$('.cart_items').html(dishes);								
			}
		});
}

function decrease_quantity(id){	
		$.ajax({
			type: "POST",
			url: "manag/php/cart_util.php",
			data: {dsh_dec:id},
			cache: false,
			dataType: "json",
			success: function(data)
			{
				var dishes = data['html'];
				$('.cart_items').html(dishes);								
			}
		});
}


$(document).ready(function(){
//alert("validated value"+$('#reviewsForm').valid());
$( "#reviewsForm" ).submit(function( event ) {
	alert('submitted');
		event.preventDefault();
		
	if($("#reviewsForm").valid())
	{
		alert('valid');
		var form = document.reviewsForm;
		alert(form);
		var dataString=$(form).serialize();
		alert(dataString);
		$.ajax({
			type: "POST",
			url: "../manag/php/util.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				var _p = $.parseJSON(html);
				if(_p.status = "Success")
				{
					$('#review_message').html(_p.message);
					$('.comment_sec').html(_p.data);
					$('#reviewsForm')[0].reset();

				}

			}
		});
	}
});

$("#reviewsForm").validate({
		rules:{
			rev_name:"required",
			rev_message:"required",
			rateng:"required"
		},
		messages:{
			rev_name:"Enter title",
			rev_message:"Enter your review",
			rateng:"Select rating"
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			//alert($(element).parents('.control-group'));
			//$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			//$(element).parents('.control-group').removeClass('error');
			//$(element).parents('.control-group').addClass('success');
		}
});

$("#OrderForm").validate({
		rules:{
			order_type:"required",
			dorder_time:"required",
			oname:"required",
			oemail:"required",
			omobile:"required",
			oaddress:"required",
			opayment:"required"
		},
		messages:{
			order_type:"Select order type",
			dorder_time:"When to deliver",
			oname:"Enter your name",
			oemail:"Enter your email",
			omobile:"Enter your email",			
			oaddress:"Where to deliver",			
			opayment:"Select payment type"
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			//alert($(element).parents('.control-group'));
			//$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			//$(element).parents('.control-group').removeClass('error');
			//$(element).parents('.control-group').addClass('success');
		}
});

$( "#val_order_sum" ).click(function( event ) {
	//alert('Trying to place order');
		event.preventDefault();
		
	if($("#OrderForm").valid())
	{
		alert('Data entered is valid');
		
		$('#OrderForm').submit();
		/*
		var form = document.OrderForm;
		//alert(form);
		var dataString=$(form).serialize();
		//alert(dataString);
		$.ajax({
			type: "POST",
			url: "../manag/php/util.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				var _p = $.parseJSON(html);
				if(_p.status = "Success")
				{
					alert(_p.message);
					//$('.comment_sec').html(_p.data);
					//$('#reviewsForm')[0].reset();
				}

			}
		});
		*/
	}
});
});

