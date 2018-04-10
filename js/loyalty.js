// loyalty.js

"use strict";
/*jshint unused:false*/

// db data offsets
var dbLOGINS = 0;
var dbFIRSTNAME = 1;
var dbLASTNAME = 2;
var dbEMAIL = 3;
var dbPHONE = 4;
var dbPOINTS = 5;
var dbLASTLOGIN = 6;

/* load up first screen */
function loyalty_js_init() {
    $.get("html/loyalty_search.html", {}, function(data) {
        $("#page").html(data);   
        $("#phonenum").get(0).focus();
        $("#phonenum").on("keyup", function(e) {
            if(e.keyCode === 13) {
                var p=this.value;
                if( (p = validatePhone(p, this)) !== "") {
                    processPhone(p);
                } else {
                    alert("bad phone");
                }
            }
        });
    });
}

/* Lookup initial phone number */
function processPhone(phone) {
    $.post("loyalty_procs.php", {"phonenumber" : phone}, function(data) {
        if(data.trim() === "") {
            userNotFound(phone);
        } else {
            userFound(data.split("|"));
        }       
    });
}

/*  user was not found */
function userNotFound(phone) {
    // load up input screen
    $.get("html/loyalty_new.html", {}, function(data) {
        $("#page").html(data);   
        $("#getinfo #phone").val(phone);
        $("#firstname").get(0).focus();
    });
}


/* user already in database */
function userFound(info) {
    // load up found screen
    $.post("html/loyalty_found.html", {}, function(data) {
        $("#page").html(data); 
        $("#logo img").attr("src", "css/images/logged-button.png");
        $("#logo span").html("Welcome Back!");
        $("#userinfo #firstname").val(info[dbFIRSTNAME]);
        $("#userinfo #lastname").val(info[dbLASTNAME]);
        $("#userinfo #email").val(info[dbEMAIL]);
        $("#userinfo #phone").val(info[dbPHONE]);
        $("#userinfo #thepoints").html(info[dbPOINTS]);
        var dt = info[dbLASTLOGIN];
    });
}

/* Validate phone number */
function validatePhone(phone, ele) {
    var t = phone.replace(/\D/g,'');
    $(ele).val(t);

    if( t.length !== 10 ) {
        return "";
    }
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(t)) {
        return t;
    }
    else {
        return "";
    }
}

/* Check, then save, form elements*/
function checkFormAndSave() {
    var first = $("#firstname").val();
    var last =  $("#lastname").val();
    var email = $("#email").val();
    //var phone = $("#phone").val();
    if( first.length === 0 ||
        last.length === 0 ||
        email.length === 0 ) {
            alert("Please fill out all of the information.");
            return;
    }
    if(!isValidEmailAddress(email)) {
            alert("Please enter a valid Email address.");
            return;     
    }
    var filter = /[.,\/#!$%\^&\*;:{}=\-_`~()]/;
    if( filter.test(first) ) {
        alert("There are non-alphanumeric characters in the Firstname field.");
        return;
    } else if( filter.test(last) ) {
        alert("There are non-alphanumeric characters in the Lastname field.");
        return;
    }     

    $.post("loyalty_procs.php", $("form#newuserform").serialize(), function() {
       congratulate();
    });
}

/* Nice going! */
function congratulate() {
    var h = "<div style='text-align:center;'><h1>Congratulations!</h1><p>You have earned 50 points to start you off!</p>" +
        '<div class="centerdiv" style="margin-top: 20px;">' +
        '<input class="widebtn" type="button" value="Enter another phone number" onclick="loyalty_js_init()" />' + 
        '</div></div>';
    $("#page").html(h);    
}

/* */
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    return pattern.test(emailAddress);
}

