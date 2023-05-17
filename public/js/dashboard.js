$(document).ready(function () {
    $("#table").DataTable();
    $("#jobpost").DataTable({
        order: [[5, "desc"]],
    });

    if ($(window).width() < 768) {
        $("#side").prop("checked", true);
    } else {
        $("#side").prop("checked", false);
    }

    $("#userclick").click(function () {
        if ($("#nav").prop("checked") == true) {
            $("#nav").prop("checked", false);
            $("#drop").addClass("dropout");
            $(this).addClass("userbgactive");
        } else {
            $("#nav").prop("checked", true);
            $("#drop").removeClass("d-none");
            $("#drop").removeClass("dropout");
            $(this).removeClass("userbgactive");
        }
    });
    $("#userclick").hover(
        function () {
            if ($("#nav").prop("checked") == true) {
                $("#nav").prop("checked", false);
                $("#drop").addClass("dropout");
                $(this).addClass("userbgactive");
            } else {
            }
        },
        function () {}
    );

    $("#drop").hover(
        function () {},
        function () {
            $("#nav").prop("checked", true);
            $("#drop").removeClass("d-none");
            $("#drop").removeClass("dropout");
            $(this).removeClass("userbgactive");
        }
    );

    $(".main").hover(
        function () {},
        function () {
            $("#nav").prop("checked", true);
            $("#drop").removeClass("d-none");
            $("#drop").removeClass("dropout");
            $(this).removeClass("userbgactive");
        }
    );

    $("#btnlogout").click(function () {
        swal({
            title: "Confirm Action",
            text: "Are you sure you want to leave?",
            icon: "warning",
            buttons: ['No','Yes'],
            dangerMode: true,
        }).then((willLogout) => {
            if (willLogout) {
                $("#logout").click();
            }
        });
    });
    $("#hidesidebar").click(function () {
        if ($("#side").prop("checked") == true) {
            $(".sidebar").addClass("slideRight");
            $(".main").css("margin-left", "0px");
            $(".titlebar").css("margin-left", "0px");
            $("#side").prop("checked", false);
        } else {
            $(".sidebar").addClass("slideleft").removeClass("slideRight");
            $("#side").prop("checked", true);
            $(".main").css("margin-left", "-200px");
            $(".titlebar").css("margin-left", "-200px");
        }
    });

    $(".edit").click(function () {
        var item = $(this).data("item");
        $(".cardselected").removeClass("activateselected");
        $("#cardselected" + item["id"]).addClass("activateselected");
        $("#anid").val(item["id"]);
        $("#title").val(item["title"]);
        $("#content").text($(item["content"]).text());
        $("#btncancel").removeClass("d-none");
        $("#typeofaction").val("edit");
        $("#btnpost").html(' Repost <i class="fas fa-paper-plane"></i>');
        $("#cardupdate").attr("style", "border:1px solid red");
    });

    $(".datalistItems").click(function () {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var empno = $(this).data("empno");
        var email = $(this).data("email");
        $("#employee_search").val(name.replace(/\s/g, ""));
        $("#dataValue").val(id);
        $(".datalist").addClass("d-none");
        $("#empno").val(empno.replace(/\s/g, ""));
        $("#email").val(email.replace(/\s/g, ""));

        if ($("#empno").val() == "") {
            $("#saveusersbtn").addClass("disabledbtn");
        } else {
            $("#saveusersbtn").removeClass("disabledbtn");
        }
    });

    $("#employee_search").focus(function () {
        $(".datalist").removeClass("d-none");
        $(this).select();
    });
    $(".datalist").hover(
        function () {},
        function () {
            $(".datalist").addClass("d-none");
        }
    );
    $("#employee_search").hover(
        function () {
            $(".datalist").removeClass("d-none");
        },
        function () {}
    );

    $("#employee_search").keyup(function () {
        var val = $(this).val().toLowerCase();
        var list = $(".datalistItems");
        $("#empno").val("");
        $("#email").val("");
        if (val === "") {
            $("#dataitems").removeClass("d-none");
            $("#datalistnone").addClass("d-none");
        }

        var visibleItems = 0;
        list.each(function () {
            var text = $(this).text().toLowerCase();
            if (text.indexOf(val) !== -1) {
                $(this).show();
                visibleItems++;

                $("#dataitems").removeClass("d-none");
                $("#datalistnone").addClass("d-none");
            } else {
                $(this).hide();
            }
        });

        if (visibleItems === 0) {
            $("#dataitems").addClass("d-none");
            $("#datalistnone").removeClass("d-none");
        }

        if ($("#empno").val() == "") {
            $("#saveusersbtn").addClass("disabledbtn");
        } else {
            $("#saveusersbtn").removeClass("disabledbtn");
        }
    });

    $(".selectedroles").click(function () {
        var count = $(".selectedroles:checked").length;
        if ($(this).prop("checked") == true) {
            if ($("#empno").val() == "") {
                $("#saveusersbtn").addClass("disabledbtn");
            } else {
                $("#saveusersbtn").removeClass("disabledbtn");
            }
        } else {
            if (count == 0) {
                $("#saveusersbtn").addClass("disabledbtn");
            }
        }
    });
});



