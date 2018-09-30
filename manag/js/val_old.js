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
		ResDeliver:"required",
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
		ResDeliver:"Let us know where you can deliver",
		ResDeliverFrom:"Restaurant online orders open at",
		ResDeliverTo:"Closed at",
		ResMinDeliverAmount:"Minimum order amount to deliver",
		ResServiceTax:"How much service tax your are adding",
		ResDeliveryCharges:"Delivery charges if any",
		ResMenuRatesTax:"Rates on menu with tax/without tax"
	},
	errorClass: "help-inline",
	errorElement: "span",
	highlight:function(element, errorClass, validClass) {
		$(element).parents('.control-group').addClass('error');
	},
	unhighlight: function(element, errorClass, validClass) {
		$(element).parents('.control-group').removeClass('error');
		$(element).parents('.control-group').addClass('success');
	}

});
