$(document).ready(function(){
    $('#type').change(function(){
        var type = $('#type').val();
        //alert(type);
        if(type == 'Admin'){
            //alert(type);
            $('#access').hide();
        }else if(type == 'Sub Admin'){
            $('#access').show();
        }
    });

	$('#current_pwd').keyup(function(){
        var current_pwd = $('#current_pwd').val();
        $.ajax({
            type:'get',
            url:'/admin/check-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
               // alert(resp);
                if(resp=='false'){
                    $('#chkPwd').html("<font color='red'>Current Password is Incorrect</font>");
                }else if(resp=='true'){
                    $('#chkPwd').html("<font color='green'>Current Password is Correct</font>");
                }
            },error:function(){
                alert('Error');
            }
        })
    });

	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
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

    // Add category Validation
    $("#add_category").validate({
        rules:{
            category_name:{
                required:true
            },
            description:{
                required:true
            },
            url:{
                required:true
            }
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

	// Add Category Validation
    $("#add_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true
			},
			url:{
				required:true
			}
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

    // Edit Category Validation
    $("#edit_category").validate({
        rules:{
            category_name:{
                required:true
            },
            description:{
                required:true,
            },
            url:{
                required:true,
            }
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
    // Edit Category Validation
    $("#add_admins").validate({
        rules:{
            type:{
                required:true
            },
            username:{
                required:true
            },
            password:{
                required:true
            }
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
//add more product field

    $("#addMore").click(function(e){

        e.preventDefault();
        $("#fieldList").append("<br>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Under Category</label><div class='controls'><select name='category_id[]' id='category_id' style='width: 220px'><?php echo $categories_dropdown; ?></select></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Product Name</label><div class='controls'><input type='text' name='product_name[]' id='product_name'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Product Code</label><div class='controls'><input type='text' name='product_code[]' id='product_code'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Product Color</label><div class='controls'><input type='text' name='product_color[]' id='product_color'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Description</label><div class='controls'><textarea name='description[]' id='description'></textarea></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Material & Care</label><div class='controls'><textarea name='care[]' id='care'></textarea></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Product Price</label><div class='controls'><input type='text' name='product_price[]' id='product_price'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Product image</label><div class='controls'><input type='file' name='image[]' id='image'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Product video</label><div class='controls'><input type='file' name='video[]' id='video'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Feature Item</label><div class='controls'> <input type='checkbox' name='feature_item[]' id='feature_item' value='1'></div></div>");
        $("#fieldList").append("<div class='control-group'><label class='control-label'>Enable</label><div class='controls'><input type='checkbox' name='status[]' id='status' value='1'></div></div>");

    });
	// Add Product Validation
    $("#add_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
            product_price:{
				required:true,
				number:true
			},
            image:{
				required:true
            }
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

    // Edit Product Validation
    $("#edit_product").validate({
        rules:{
            category_id:{
                required:true
            },
            product_name:{
                required:true
            },
            product_code:{
                required:true
            },
            product_color:{
                required:true
            },
            product_price:{
                required:true,
                number:true
            }
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

	// Edit Category Validation
    $("#edit_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true
			},
			url:{
				required:true
			}
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
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
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
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
            confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
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
	$("#deletecategory").click(function(){
		if(confirm('Are you sure you want to delete this Category?')){
			return true;
		}
		return false;
	});
    $("#deleteproduct").click(function(){
        if(confirm('Are you sure you want to delete this Product?')){
            return true;
        }
        return false;
    });
    $("#delCoupon").click(function(){
        if(confirm('Are you sure you want to delete this Product?')){
            return true;
        }
        return false;
    });
    function delCoupon(){
        if(confirm('Are you sure you want to delete this Coupon?')){
            return true;
        }
        return false;
    }
    $("#delBanner").click(function(){
        if(confirm('Are you sure you want to delete this Banner?')){
            return true;
        }
        return false;
    });
    function delBanner(){
        if(confirm('Are you sure you want to delete this Banner?')){
            return true;
        }
        return false;
    }

    $("#deleteattribute").click(function(){
        if(confirm('Are you sure you want to delete this Product Attribute?')){
            return true;
        }
        return false;
    });
});

$(document).ready(function(){
    var maxField = 10; //input field increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //input Field wrapper
    var fieldHTML = '<div class="field_wrapper" style="margin-left: 180px;"><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px; margin-top: 5px;"/> <input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px; margin-top: 5px;"/> <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px; margin-top: 5px;"/> <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px; margin-top: 5px;"/> <a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a></div>'; //new input field html
    var x=1;//initial field counter is 1
    $(addButton).click(function(){
        if(x < maxField){// once add button is clicked
            x++; //increment field
            $(wrapper).append(fieldHTML); //add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){//once removed button is clicked
        e.preventDefault();
        $(this).parent('div').remove();//Remove field html
        x--;//decrement field counter

    });
});

