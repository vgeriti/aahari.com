$(document).ready(function(){
	
	$("#ResDeliver").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
		theme: "facebook"
	});
	$( "#restaurantFrm" ).submit(function( event ) {
		//event.preventDefault();
	});

	if($("#restaurantFrm").valid())
	{
		var dataString="ResDispName="+$('#ResDispName').val()+"&ResOrdersEmail="+$('#ResOrdersEmail').val()+"&ResFeedEmail="+$('#ResFeedEmail').val()+"&ResArea="+$('#ResArea').val()+"&ResDoorNumber="+$('#ResDoorNumber').val()+"&ResLandmark="+$('#ResLandmark').val()+"&ResPincode="+$('#ResPincode').val()+"&ResContact1="+$('#ResContact1').val()+"&ResContact2="+$('#ResContact2').val()+"&ResContact3="+$('#ResContact3').val()+"&ResDeliver="+$('#ResDeliver').val()+"&ResEstDeliverTime="+$('#ResEstDeliverTime').val()+"&ResDeliverFrom="+$('#ResDeliverFrom').val()+"&ResDeliverTo="+$('#ResDeliverTo').val()+"&ResMinDeliverAmount="+$('#ResMinDeliverAmount').val()+"&ResServiceTax="+$('#ResServiceTax').val()+"&ResDeliveryCharges="+$('#ResDeliveryCharges').val();
		$.ajax({
			type: "POST",
			url: "restaurant_save.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				alert(html);
			}
		});
	}

	$("#restaurantFrm").validate({
		rules:{
			ResDispName:"required",
			ResOrdersEmail:{ 
				required:true,
				email:true
			},
			ResFeedEmail:{ 
				required:true,
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
			ResServiceTax:"required",
			ResDeliveryCharges:"required",
			ResMenuRatesTax:"required"
		},
		messages:{
			ResDispName:"Restaurant display name is required",
			ResOrdersEmail:{ 
				required:"Orders information will be delivered to this mail",
				email:"enter valid email address"
			},
			ResFeedEmail:{ 
				required:"Feedback/queries will be mailed to this address",
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
			ResServiceTax:"How much service tax your are adding",
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
});