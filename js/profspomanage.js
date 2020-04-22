$(document).ready(function () {
    // init
    send_request_profspo_m();
});

// filter
$("#profspomanage-filter-apply").click(function () {
    send_request_profspo_m();
});

// clear filter
$("#profspomanage-filter-clear").click(function () {
    $(".profspomanage-filter").val("");
    send_request_profspo_m();
});

// register
$("#profspomanage-user-register").click(function () {
    var email = $("#user-email").val(),
        fio = $("#user-fio").val(),
        user_type = $("#user-type").val(),
        pass = $("#user-pass").val();
    register_user_profspo_m(email, fio, user_type, pass);
});


function send_request_profspo_m(page = 0) {
    var filter = $(".profspomanage-filter")
        .map(function () {
            return this.id + "=" + $(this).val();
        })
        .get()
        .join('&');

    $.ajax({
        url: M.cfg.wwwroot + "/blocks/profspomanage/ajax.php?action=getlist&page=" + page + "&" + encodeURI(filter)
    }).done(function (data) {
        // set data
        $("#profspomanage-user-list").html(data.html);
        $("#profspomanage-user-list").scrollTop(0);

        // pagination
        $(".profspomanage-page").click(function () {
            send_request_profspo_m($(this).data('page'));
        });

        //set user block listener
        $(".profspomanage-user-block").click(function () {
            $(this).hide();
            block_user_profspo_m($(this).data("id"));
        });

        //set user unblock listener
        $(".profspomanage-user-unblock").click(function () {
            $(this).hide();
            unblock_user_profspo_m($(this).data("id"));
        });
    });
}

function block_user_profspo_m(id) {
    $.ajax({
        url: M.cfg.wwwroot + "/blocks/profspomanage/ajax.php?action=block_user&user_id=" + id
    }).done(function (data) {
        send_request_profspo_m();
    });
}

function unblock_user_profspo_m(id) {
    $.ajax({
        url: M.cfg.wwwroot + "/blocks/profspomanage/ajax.php?action=unblock_user&user_id=" + id
    }).done(function (data) {
        send_request_profspo_m();
    });
}

function register_user_profspo_m(email, fio, type, pass) {
    $.ajax({
        url: M.cfg.wwwroot + "/blocks/profspomanage/ajax.php?action=register_user"
            + "&email=" + email
            + "&fio=" + fio
            + "&user_type=" + type
            + "&pass=" + pass
    }).done(function (data) {
        alert(data.text);
        clear_registerform_profspo_m();
        send_request_profspo_m();
    });
}

function clear_registerform_profspo_m() {
    $("#user-email").val("");
    $("#user-fio").val("");
    $("#user-type").val(1);
    $("#user-pass").val("");
}
