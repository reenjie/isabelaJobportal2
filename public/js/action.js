class Action {
    static csrfToken = $('meta[name="csrf-token"]').attr("content");

    static Publish_Status(id, publish, callback) {
        $.ajax({
            url: "publish/jobposts",
            type: "POST",
            data: { id: id, publish: publish, _token: Action.csrfToken },
            success: function (response) {
                if (typeof callback === "function") {
                    callback(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });
    }

    static LockUSer(id, lock, callback) {
        $.ajax({
            url: "lock/users",
            type: "POST",
            data: { id: id, lock: lock, _token: Action.csrfToken },
            success: function (response) {
                if (typeof callback === "function") {
                    callback(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });
    }


    static MarkApplicant_Status(id,actionType,data,callback){
        $.ajax({
            url: "update/applicantStatus",
            type: "POST",
            data: { id: id, actionType: actionType,data:data, _token: Action.csrfToken },
            success: function (response) {
                if (typeof callback === "function") {
                    callback(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });

    }

    static Resend_Invitation(data,callback){

        
        $.ajax({
            url: "resend/invitation",
            type: "POST",
            data: { data:data,resend:1,_token: Action.csrfToken },
            success: function (response) {
                if (typeof callback === "function") {
                    callback(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });

    }

    
    static Resend_Acknowledgement(data,callback){

        
        $.ajax({
            url: "resend/acknowledgement",
            type: "POST",
            data: { data:data,resend:1,_token: Action.csrfToken },
            success: function (response) {
                if (typeof callback === "function") {
                    callback(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });

    }


    static Set_as_Hired(data,callback){
        $.ajax({
            url: "set/Hired",
            type: "POST",
            data: { data:data,_token: Action.csrfToken },
            success: function (response) {
                if (typeof callback === "function") {
                    callback(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {},
        });
    }
}
