$(document).ready(function(){
	
/*	$("#ResDeliver").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
		theme: "facebook"
	});*/
	$( "#restaurantFrm" ).submit(function( event ) {
		event.preventDefault();
	if($("#restaurantFrm").valid())
	{
//		alert("valid"+$("#restaurantFrm").valid());
		/*var dataString="ResDispName="+$('#ResDispName').val()+"&rest_stat="+$('#rest_stat').val()+"&ResOrdersEmail="+$('#ResOrdersEmail').val()+"&ResFeedEmail="+$('#ResFeedEmail').val()+"&ResArea="+$('#ResArea').val()+"&ResDoorNumber="+$('#ResDoorNumber').val()+"&ResLandmark="+$('#ResLandmark').val()+"&ResPincode="+$('#ResPincode').val()+"&ResContact1="+$('#ResContact1').val()+"&ResContact2="+$('#ResContact2').val()+"&ResContact3="+$('#ResContact3').val()+"&ResDeliver="+$('#ResDeliver').val()+"&ResEstDeliverTime="+$('#ResEstDeliverTime').val()+"&ResDeliverFrom="+$('#ResDeliverFrom').val()+"&ResDeliverTo="+$('#ResDeliverTo').val()+"&ResMinDeliverAmount="+$('#ResMinDeliverAmount').val()+"&ResServiceTax="+$('#ResServiceTax').val()+"&ResDeliveryCharges="+$('#ResDeliveryCharges').val()+"&ResMenuRatesTax="+$('#ResMenuRatesTax').val()+"&action=save";*/
		var form = document.restaurantFrm;
		var dataString=$(form).serialize();
		//alert(dataString);
		$.ajax({
			type: "POST",
			url: "php/util.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				//alert(html);
			}
		});
	}
});
	$("#restaurantFrm").validate({
		rules:{
			ResDispName:"required",
			ResOrdersEmail:{ 
				email:true
			},
			ResFeedEmail:{ 
				email:true
			},
			ResArea:"required",
			ResDoorNumber:"required",
			ResLandmark:"required",
			ResPincode:"required",
			ResContact1:"required",
			ResDeliverFrom:"required",
			ResDeliverTo:"required",
			ResMinDeliverAmount:"required",
			ResDeliveryCharges:"required",
			ResMenuRatesTax:"required"
		},
		messages:{
			ResDispName:"Restaurant display name is required",
			ResOrdersEmail:{ 
				email:"enter valid email address"
			},
			ResFeedEmail:{ 
				email:"enter valid email address"
			},
			ResArea:"Enter your restaurant area",
			ResDoorNumber:"Enter door number of your restaurant",
			ResLandmark:"Enter a landmark near your restaurant",
			ResPincode:"Enter pincode",
			ResContact1:"Enter mobile number to get orders information as sms",
			ResDeliverFrom:"",
			ResDeliverTo:"",
			ResMinDeliverAmount:"Minimum order amount to deliver",
			ResDeliveryCharges:"Delivery charges if any",
			ResMenuRatesTax:"Rates on menu with tax/without tax"
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			//alert($(element).parents('.control-group'));
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}

	});


$( "#dishFrm" ).submit(function( event ) {
		event.preventDefault();
		
	if($("#dishFrm").valid())
	{
		var form = document.dishFrm;
		var dataString=$(form).serialize();
		alert(dataString);
		$.ajax({
			type: "POST",
			url: "php/util.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				alert(html);
			}
		});
	}
});


	
$("#dishFrm").validate({
		rules:{
			dishName:"required",
			cuisineName:"required",
			dishType:"required",
			dishPrice:{ 
				required:true,
				number:true
			}
		},
		messages:{
			dishName:"Please enter dish name",
			cuisineName:"Select cuisine for this dish",
			dishType:"Select dish type",
			dishPrice:{ 
				required:"Please enter price of the dish",
				number:"Please enter valid price in INR"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			//alert($(element).parents('.control-group'));
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}

	});	

$("#catFrm").validate({
		rules:{
			catName:"required",		
		},
		messages:{
			catName:"Enter category name",
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			//alert($(element).parents('.control-group'));
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}

	});	
});

$( "#catFrm" ).submit(function( event ) {
		event.preventDefault();
		
	if($("#catFrm").valid())
	{
		var form = document.catFrm;
		var dataString=$(form).serialize();
		alert(dataString);
		$.ajax({
			type: "POST",
			url: "php/util.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				alert(html);
			}
		});
	}
});