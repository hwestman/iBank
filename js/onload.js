/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validateUserName() {
    var element = $("input[name=username]");
    var errorMessage = "";
    element.removeClass("validated");

    if (!/[a-zA-Z]/.test(element.val()[0])) {
        errorMessage += "First character has to be letter, ";

    }

    errorMessage += validateEmptySpace(element.val());

    if (errorMessage.length > 0) {
        element.next().html(errorMessage);
    } else {
        element.next().html("");
        element.addClass("validated");
    }
    overallValidation();
}
/*
 * Validates a specific password
 * 
 */
function validatePassword(element) {
    
    var errorMessage = "";
    //Makes sure it revalidates for each attempt
    element.removeClass("validated");

    //makes sure the length of pw is more than 5
    if (element.val().length < 5) {
        errorMessage += " Gotta be more than 5 characters, ";
    }
    //makes sure langth of password is not more than 8
    if (element.val().length > 8) {
        errorMessage += " Gotta be less than 8 characters, ";
    }
    //Makes sure there is no special characters
    if (/^[a-zA-Z0-9- ]*$/.test(element.val()) == false) {
        errorMessage += " Cant contain specialcharacters, ";
    }
    //Validates that there is no whitespace used and that its not empty
    errorMessage += validateEmptySpace(element.val());

    //checks to see if there has been any errors, if not, adds class validated to the element for 
    //overall validation 
    if (errorMessage.length > 0) {
        element.next().html(errorMessage);
    } else {
        element.next().html("");
        element.addClass("validated");
    }
    //resets errormessage for later use
    errorMessage = "";
    //validates all fields to see if submit can be allowed
    overallValidation();
}
//validates a string to see if it is empty or contains whitespace
function validateEmptySpace(input) {
    var errorMessage = "";
    if (/\s/g.test(input)) {
        errorMessage += "Input cant contain whitespace";
    }
    if (input.length == 0) {
        errorMessage += "Input cant be empty";
    }
    return errorMessage;
}
/*
 * runs the actual submit of the form
 */
$("#credentialForm").submit(function() {
    alert("WOOOHOOH YOU MADE IT:D");
    return false;
});
/*
 * emptys all fields
 */
$("input[name=reset]").click(function() {

    $(".reqVal").each(function() {
        $(this).val("");
    });


});
function overallValidation() {
    var valid = true;
    $(".reqVal").each(function() {
        if (!$(this).hasClass("validated")) {
            valid = false;
        }
    });

    if (valid) {
        $("input[name=submit]").removeAttr("disabled");
    } else {
        $("input[name=submit]").attr("disabled", "disabled");

    }
}

function getSuburbs(postcode){
    var suburbs;
    $.ajax({
       dataType: 'html',
       type:'POST',
       data:{postcode:postcode,json:true,action:'getSuburbs'},
       url: '/iBank/ajaxRequest.php',
       success: function(response){
           
           suburbs = jQuery.parseJSON(response);
           fillSuburbs($(suburbs));
       },
       error: function(ex){
        
            console.log(ex);
       },
       complete: function(){
       }
    });
    return suburbs;
}
function fillSuburbs(suburbs){
   if(suburbs.length>0){
        var sel = $("#suburb");
        sel.html("");
        suburbs.each(function( index ) {
            var pc = $(this);
            ret='<option value="'+pc[0]['id']+'">'+pc[0]['suburb']+'</option>';
            
            sel.append(ret);
        });
   }else{
       $("#suburb").html("");
       $("#postcode").val("");
   }
     
}
function initialize(){
   var postcode = $("#postcode");
   postcode.focusout(function() {
        
        if($(this).val().length == 4){
            getSuburbs($(this).val());
        }else{
            postcode.val("");
            $("#suburb").html("");
        }
        
       
   });
   $("#newPassword").keyup(function() {
        validatePassword($(this));
    });
    $("#confirmPassword").focusout(function() {
        if($("#newPassword").val() == $(this).val()){
            $(this).next().html("");
            
        }else{
            $(this).next().html("Passwords gotta be the same man..");
        }
    });
   
}

$(document).ready(function() {
    
    initialize();
    
    
    

    
});