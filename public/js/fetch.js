class Fetch {
    static csrfToken = $('meta[name="csrf-token"]').attr("content");

    static ShowALert(message) {
        Toastify({
            text: message,
            duration: 10000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#68B984",
                color: "white",
                borderRadius: "2px",
                paddingX: "40px",
                marginTop: "45px",
                fontWeight: "bold",
                fontSize: "13px",
            },
            onClick: function () {},
        }).showToast();
    }

    static getJobPost(search) {
        $.ajax({
            url: "fetch/Jobposts",
            type: "POST",
            data: { fetch: 1, _token: Fetch.csrfToken, search: search },
            success: function (response) {
                $("#jobpostdata").html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    }

    static getAllUsers(search) {
        $.ajax({
            url: "fetch/Users",
            type: "POST",
            data: { fetch: 1, _token: Fetch.csrfToken, search: search },
            success: function (response) {
                $("#usersdata").html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    }

    static getAllapplications(search,filter,jobpost){
        $('#applications_data').html('<div style="text-align:center;padding:150px"><div class="spinner-border justify-content-center" style="width: 3rem; height: 3rem;" role="status"></div><br> <span style="font-size:14px;font-weight:bold">LOADING</span></div>');
        $.ajax({
            url: "fetch/Applications",
            type: "POST",
            data: { fetch: 1, _token: Fetch.csrfToken, search: search ,filter:filter,jobpost:jobpost },
            success: function (response) {
                $("#applications_data").html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });

    }
}
