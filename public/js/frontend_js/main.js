/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){
    //change product sizes and cost
    $("#selSize").change(function(){
        //if te id value is changed
        //alert('test');
        //get the value val passed
       var idSize = $(this).val();
        //alert(idSize);
        if(idSize == ""){
            return false;
        }
        $.ajax({
            type: 'get',
            url: '/get-product-price',
            data:{idSize:idSize},
            success:function(resp){
               //alert(resp); return false;
                var arr = resp.split('#');
                var arr1 = arr[0].split('-');
                //alert(arr1); return false;
                var arr2 = arr[1].split('-');
                $("#getPrice").html("# "+arr2[0] + "<br><br><p><h2>"+arr1[0] + "<br>"+arr1[1]+ "<br>"+arr1[2]+ "<br>"+arr1[3]+ "<br>"+arr1[4]+"</h2></p>");
                //update the price for cart
                $("#price").val(arr2[0]);
                if(arr2[1]==0){
                    $("#cartButton").hide();
                    $("#availability").text("Out of Stock");
                }else{
                    $("#cartButton").show();
                    $("#availability").text("In Stock");
                }
                },error:function(){
               //alert("Error");
            }
        });
    });


    $("#sl2").click(function(){
       // var user_id = $(this).attr('rel');
        alert('user_id');
    })

   //change main Image with alternative image
    $(".changeImage").click(function(){
        var image = $(this).attr('src');
        $(".mainImage").attr("src",image);

    });
});

function searchProduct(){
    var searchTxt=$('#searchProduct').val();
    //alert(searchTxt);
    $.ajax({
        type: 'get',
        url: '/searchProduct',
        data:{searchTxt:searchTxt},
        success:function(resp){
            //alert(resp); return false;
            //window.location.href = "/instantSearch"
            $(".features_items").html(resp);
        },error:function(){
           // alert("Error");
        }
    });
}



// Instantiate EasyZoom instances
var $easyzoom = $('.easyzoom').easyZoom();

// Setup thumbnails example
var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

$('.thumbnails').on('click', 'a', function(e) {
    var $this = $(this);

    e.preventDefault();

    // Use EasyZoom's `swap` method
    api1.swap($this.data('standard'), $this.attr('href'));
});

// Setup toggles example
var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

$('.toggle').on('click', function() {
    var $this = $(this);

    if ($this.data("active") === true) {
        $this.text("Switch on").data("active", false);
        api2.teardown();
    } else {
        $this.text("Switch off").data("active", true);
        api2._init();
    }
});
$().ready(function() {
// validate signup form on keyup and submit
$("#registerForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 2,
            accept: "[a-zA-Z]+"
        },
        email: {
            required: true,
            email: true,
            //confirm in database if entered email exist before
            remote: {
                url: "/check-email",
                type: "get"
            }
        },
        password: {
            required: true,
            minlength: 5
        }
    },
    messages: {
        name:{
            required: "Please enter a valid name",
            minlength:"nane must be atleast 2 character long",
            accept: "Your name must contain Letters only"
        } ,
        email: {
            required: "Please enter your email address",
            email: "Please enter a valid email address",
            remote: "Email already exists!"
        },
        password: {
            required: "Please provide your password",
            minlength: "Your password must be at least 5 characters long"
        }


    }
});

    //password strength check
    $('#userPassword').passtrength({
        minChars: 4,
        passwordToggle: true,
        tooltip: true,
        eyeImg:"/images/frontend_images/eye.svg"
    });
//recoverpassword
    $("#userPasswordRecovery").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            }


        }
    });
    //reset user password
    $("#userPasswordReset").validate({
        rules:{
            resetPassword:{
                required: true,
                minlength:6,
                maxlength:20
            },
            confirmResetPassword:{
                required:true,
                minlength:6,
                maxlength:20,
                equalTo:"#resetPassword"
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
    //userLogin
    $("#userLoginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide your password"
            }


        }
    });
    //validate user update password
    $("#updatePassword").validate({
        rules:{
            current_password:{
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

    //check current password
    $("#current_password").keyup(function(){
        var current_password = $('#current_password').val();
        //alert(current_password);
        $.ajax({
            type: 'get',
            url: '/get-current-pwd',
            data:{current_password:current_password},
            success:function(resp){
                //alert(resp); //return false;
                if(resp=='false'){
                    $('#chkPwd').html("<font color='red'>Current Password is Incorrect</font>");
                }else if(resp=='true'){
                    $('#chkPwd').html("<font color='green'>Current Password is Correct</font>");
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    //instant search








    $("#billtoship").click(function(){
        if(this.checked){
            $("#shipping_name").val($("#Billing_name").val());
            $("#shipping_address").val($("#Billing_address").val());
            $("#shipping_city").val($("#Billing_city").val());
            $("#shipping_state").val($("#Billing_state").val());
            $("#shipping_country").val($("#Billing_country").val());
            $("#shipping_pincode").val($("#Billing_pincode").val());
            $("#shipping_mobile").val($("#Billing_mobile").val());
        }else{
            $("#shipping_name").val('');
            $("#shipping_address").val('');
            $("#shipping_city").val('');
            $("#shipping_state").val('');
            $("#shipping_country").val('');
            $("#shipping_pincode").val('');
            $("#shipping_mobile").val('');
        }
    });
});

function selectPaymentMethod(){
    if($('#paypal').is(':checked') ||$('#COD').is(':checked')){
        //alert('test');
    }else{
        alert('please select payment method');
        return false;
    }
}