var loginvisible = false;

function loginslide() {
    if (loginvisible === false) {
        $('#slogin').animate({
            marginTop: "0px"
        });
        loginvisible = true;
        $('#blogin').css('background-color', '#FF4961');
    } else {
        $('#slogin').animate({
            marginTop: "-50px"
        }, 250);
        setTimeout(function() {
            $('#blogin').css('background-color', '#fff');
        }, 240);
        $("#add_err").animate({
            marginTop: "-19px"
        }, 250);
        setTimeout(function() {
            $("#add_err").html("");
        }, 100);
        $("#loginForm").trigger("reset");
        loginvisible = false;



    }


}

function JsSwitch() {
    $('#blogin').attr('href', 'javascript:');
    $('#slogin').css('display', 'block');
    $('#login').css('display', 'none');
}

function checkPasswordMatch() {
    var password = $("#txtPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
    if (password.length >= 5)
        $("#pwLength").attr("src", "img/check.png");
    else
        $("#pwLength").attr("src", "img/error.png");

    if (password == confirmPassword && password.length >= 5)
        $("#pwIndicator").attr("src", "img/check.png");
    else
        $("#pwIndicator").attr("src", "img/error.png");

}

function checkmail() {
    mail = $('#Regmail').val();
    var patt = new RegExp('[\\w-+]+(?:\\.[\\w-+]+)*@fh-salzburg\.ac\.at');
    if (patt.exec(mail) == null && mail != "") {

        $('#mailValid').attr("src", "img/error.png");
    } else {
        $('#mailValid').attr("src", "img/check.png");
    }
}


$(document).ready(function() {

    $("#submitLogin").click(function() {
        email = $("#email").val();
        password = $("#pwd").val();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: "mail=" + email + "&pwd=" + password,
            success: function(html) {
                if (html == 'true') {
                    window.location = "home.php";
                } else {

                    $("#add_err").animate({
                        marginTop: "0px"
                    }, 250);
                    setTimeout(function() {
                        $("#add_err").html("Wrong Email or Password");
                    }, 80);

                }
            }
        });
        return false;
    });
});

$(document).ready(function() {

    $("#submitRequest").click(function() {

        partner = $("#partner").val();
        reqAct = $("#reqAct").val();
        $.ajax({
            type: "POST",
            url: "request.php",
            data: "partner=" + partner + "&reqAct=" + reqAct,
            success: function(html) {
                if (html != 'false') {
                    if ($("#reqAct").val() == "send") {
                        $("#submitRequest").val(" Abort ");
                        //$("#add_err").html(html);											////////////////////////////
                        $("#reqAct").val("abort");
                    } else if ($("#reqAct").val() == "abort" || $("#reqAct").val() == "unfriend") {
                        $("#submitRequest").val(" Add as Buddy ");
                        //$("#add_err").html(html);											////////////////////////////
                        $("#reqAct").val("send");
                    } else if ($("#reqAct").val() == "abortList") {
                        $("#request_" + partner).remove();
                    } else if ($("#reqAct").val() == "accept") {
                        $("#submitRequest").val(" Accept ");
                        $("#submitRequest").attr("disabled", "disabled");
                    } else {

                    }
                } else {

                    $("#add_err").animate({
                        marginTop: "0px"
                    }, 250);
                    //$("#add_err").html("Es ist ein Fehler aufgetreten :(");
                    $("#add_err").html(html);

                }
            }

        });
        return false;
    });
});

function checkvisability(element) {
    var s = element.offset().top;
    highlighter = "." + element.attr('id');

    var scrollY = $(window).scrollTop();
    if (scrollY > s - 160 && scrollY < s + element.height() - 40) {
        removeAllHighlights($(highlighter));
        $(highlighter).addClass("highlighted");
    }

}

function removeAllHighlights(element) {
    $(".s1").removeClass("highlighted");
    $(".s2").removeClass("highlighted");
    $(".s3").removeClass("highlighted");
    $(".register").removeClass("highlighted");
    element.addClass("highlighted");

}