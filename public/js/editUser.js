var isDisabled=true;
$(function() {

    $("#edit-profile").on("click",function(){
        if(isDisabled){
            $(".usrName").prop("disabled",false);
            $(".usrMail").prop("disabled",false);
            $(".usrFile").prop("disabled",false);
            $("#changeProfile").prop("disabled",false);
            $("#edit-profile").removeClass("btn-danger");
            $("#edit-profile").addClass("btn-success");            
            isDisabled=false;
        }else{
            $(".usrName").prop("disabled",true);
            $(".usrMail").prop("disabled",true);
            $(".usrFile").prop("disabled",true);
            $("#changeProfile").prop("disabled",true);
            $("#edit-profile").removeClass("btn-success");
            $("#edit-profile").addClass("btn-danger");    
            isDisabled=true;
        }
    });

});

