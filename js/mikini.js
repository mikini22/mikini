$(document).ready(function (e) {


   $("#reg-form").submit(function (e) { 
    e.preventDefault(e);
        var password = $("#password").val();
        var confirmPassword = $("#confirm_pwd").val();
        if (password != confirmPassword)
            $("#confirm_error").html("Password does not match !").css("color","red");
        else
           return true;
       });
   
    $('.one').hover(something, returnToOriginalSize);

    function something() {
        $(this).css("transform", "scale(1.1, 1.1)");
    }
    function returnToOriginalSize() {
        $(this).css("transform", "");
    }
});
$(document).ready(function () {
    $(".addItemBtn").click(function (e) { 
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var pid = $form.find(".pid").val();
        var pname = $form.find(".pname").val();
        var pprice = $form.find(".pprice").val();
        var pimage = $form.find(".pimage").val();
        var pcode = $form.find(".pcode").val();
        $.ajax({
           url: 'action.php',
            type: 'post',
            data: {pid:pid, pname:pname , pprice:pprice, pimage:pimage, pcode:pcode},
            success:function(response) {
                $("#message").html(response);
                window.scrollTo(0,0);
                load_cart_items_number()
            }
        });
    });
    load_cart_items_number();
    function load_cart_items_number() {
        $.ajax({
            method : 'get',
            url: "action.php",
            data: {cartItem:"cart-item"},
            success: function (response) {
                $("#cart-item").html(response);
            }
        });
    }
    $(".itemQty").on('change', function () {
        var $el = $(this).closest('tr');
        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
            method: "post",
            url: "action.php",
            cache : false,
            data: {pid:pid,pprice:pprice,qty:qty},
            success: function (response) {
                console.log(response);
                
            }
        });
    });
    $(document).ready(function () {
        $("#placeOrder").submit(function (e) { 
        e.preventDefault();
        $.ajax({
            url: "action.php",
            method : 'post',
            data: $('form').serialize() + "&action=order",
            success: function (response) {
                $("#order").html(response);
            }
        });
    });
    });
    
});
