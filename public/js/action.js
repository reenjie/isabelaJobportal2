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
}
