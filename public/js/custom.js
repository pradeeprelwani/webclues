function baseUrl() {
    return $('meta[name="base_url"]').attr('content');
}

$("#login-form").validate({
    errorClass: "text-danger",
    errorElement: "span",
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
        }
    },
    messages: {
        email: {
            required: "Please enter email",
            email: "Please enter valid email"
        },
        password: {
            required: "Please enter password",
        }
    }
});
$("#car-submit").validate({
    errorClass: "text-danger",
    errorElement: "span",
    rules: {
        name: {required: true},
        icon: {required: true},
        color_id: {required: true},
        date: {required: true},
        month: {required: true},
        year: {required: true},
        fuel_type: {required: true},

    },
    messages: {
        name: {required: "Please enter name"},
        color_id: {required: "Please select color"},
        icon: {required: "Please select icon "},
        date: {required: "Please select date "},
        month: {required: "Please select month "},
        year: {required: "Please select year "},
        fuel_type: {required: "Please select fuel type"},
    },
    submitHandler: function (form) {
        var formdata = new FormData();
        var icon = $('input[name=icon]')[0].files;
        for (var i = 0; i < icon.length; i++) {
            formdata.append("icon", icon[i], icon[i]['name']);
        }
        var files = $('#picture')[0].files;
        for (var i = 0; i < files.length; i++) {
            formdata.append("picture[]", files[i], files[i]['name']);
        }

        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("name", $('input[name="name"]').val());
        formdata.append("color_id", $('#color_id').val());
        formdata.append("date", $('#date').val());
        formdata.append("month", $('#month').val());
        formdata.append("year", $('#year').val());
        formdata.append("detail", $('#detail').val());
        formdata.append("fuel_type", $('#fuel_type').val());

        $.ajax({
            enctype: 'multipart/form-data',
            'method': 'POST',
            url: baseUrl() + 'car/create',
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                $(".container").prepend('<div class="alert alert-success">' + response.message + '</div>');
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, 5000);
            },
            error: function (response) {
                if (response.status === 422) {
                    $("span.msg-alert").remove();
                    $.each(response.responseJSON.errors, (index, value) => {
                        $("#" + index).after('<span class="msg-alert text-danger">' + value[0] + '</span>')
                    });
                } else {
                    $(".page-title-header").prepend('<span class="msg-alert text-danger">' + response.statusText + '</span>')
                }
            }
        });
    }
});


$("#car-update").validate({
    errorClass: "text-danger",
    errorElement: "span",
    rules: {
        name: {required: true},
        color_id: {required: true},
        date: {required: true},
        month: {required: true},
        year: {required: true},
        fuel_type: {required: true}
    },
    messages: {
        name: {required: "Please enter name"},
        color_id: {required: "Please select color "},
        date: {required: "Please select date "},
        month: {required: "Please select month "},
        year: {required: "Please select year "},
        fuel_type: {required: "Please select fuel type"}
    },
    submitHandler: function (form) {

        var formdata = new FormData();
        var icon = $('input[name=icon]')[0].files;
        for (var i = 0; i < icon.length; i++) {
            formdata.append("icon", icon[i], icon[i]['name']);
        }
        var files = $('#picture')[0].files;
        for (var i = 0; i < files.length; i++) {
            formdata.append("picture[]", files[i], files[i]['name']);
        }

        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("name", $('input[name="name"]').val());
        formdata.append("color_id", $('#color_id').val());
        formdata.append("date", $('#date').val());
        formdata.append("month", $('#month').val());
        formdata.append("year", $('#year').val());
        formdata.append("detail", $('#detail').val());
        formdata.append("fuel_type", $('#fuel_type').val());
        formdata.append("status", $('#status').val());



        $.ajax({
            enctype: 'multipart/form-data',
            'method': 'POST',
            url: $("#car-update").attr('action'),
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {

                $(".page-title-header").prepend('<div class="alert alert-success">' + response.message + '</div>');
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, 5000);
            },
            error: function (response) {
                if (response.status === 422) {
                    $("span.msg-alert").remove();
                    $.each(response.responseJSON.errors, (index, value) => {
                        $("#" + index).after('<span class="msg-alert text-danger">' + value[0] + '</span>')
                    });
                } else {
                    $(".page-title-header").prepend('<span class="msg-alert text-danger">' + response.statusText + '</span>')
                }

            }

        });
    }
});
