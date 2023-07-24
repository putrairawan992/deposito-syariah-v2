<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sipakat | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- SA, Excel to JSON, JQUERY -->
    <script src="plugins/sweetalert.min.js"></script>
    <script src="plugins/jquery-3.7.0.min.js"></script>
    <script src="plugins/xlsx.min.js"></script>
    <link href="/output.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="/img/Favicon Harta Insan Karimah.png">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="bg-green-700">
    <div></div>

    {{-- <form action="index3.html" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username / Email" id="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" id="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6LcLKrYlAAAAABr-VA-lOLHICWEdyw6IHlOk00qH"
                data-callback='doSomething' data-expired-callback="expireCaptcha"
                style="transform: scale(0.89); -webkit-transform: scale(0.89); transform-origin: 0 0; -webkit-transform-origin: 0 0;">
            </div>
            <hr>
            <div class="row d-flex justify-content-between">
                <div class="col-4">
                    <button type="button" class="btn-sm btn btn-success btn-block" id="submit"
                        onclick="login()">Sign
                        In</button>
                </div>
                <div class="col-5">
                    <div class="icheck-primary">
                        <a href="#" class="text-xs text-right" nowrap>
                            Lupa Password ?
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
            <a href="/register" class="btn-sm btn btn-block btn-outline-success">
                Daftar Baru
            </a>
        </div>
    </form> --}}

    <script>
        var serverURL = "/";
        var serverApi = serverURL + "api/";
        var token = null;
        var role = null;

        if (window.localStorage.getItem("jwttoken")) {
            token = window.localStorage.getItem("jwttoken");
            ajaxCall(serverApi + "userprofile");
        }

        $(document).ready(function() {
            $('#submit').prop('disabled', true)
        });

        function login() {
            dataNa = {
                email: $("#email").val(),
                password: $("#password").val(),
            };

            swal({
                icon: "info",
                title: "Tunggu...",
                text: "Mohon Menunggu, Data Anda sedang di Proses",
                button: false,
            });

            $.ajax({
                url: "/api/login",
                type: "POST",
                data: JSON.stringify(dataNa),
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data) {
                    var icon = "success";
                    var title = "Login Berhasil";
                    var text = "Login Berhasil di Proses";
                    if (data["status"] == "error") {
                        icon = "error";
                        title = "Belum Aktif";
                        text = data["message"];
                    } else if (data["status"] == "failed") {
                        icon = "error";
                        title = "Login Gagal";
                        text = data["message"];
                    }

                    if (data["status"] == "success") {
                        window.localStorage.setItem("jwttoken", data["token"]);
                        window.open("/dashboard", "_self");
                    }

                    swal({
                        icon: icon,
                        title: title,
                        text: text,
                        button: false,
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    swal({
                        icon: "error",
                        title: "Login Gagal",
                        text: "Status " + textStatus,
                        button: false,
                    });
                },
            });
        }

        function ajaxCall(url, dataNa = null, type = "GET") {
            $.ajax({
                url: url,
                type: type,
                data: dataNa,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                beforeSend: function(xhr, settings) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                },
                headers: {
                    Accept: "application/json",
                },
                success: function(data) {
                    var icon = "success";
                    var title = "Welcome Back";
                    var text = "Go to Dashboard Page";
                    var link = 'dashboard'

                    if (type == "GET") {
                        if (data["status"] == "error") {} else {
                            if (data.userProfile.role == 4 || data.userProfile.role == 5 || data.userProfile
                                .role == 6) {
                                link = 'donasi'
                            } else {
                                link = 'dashboard'
                            }
                            role = data.role
                            swal({
                                icon: icon,
                                title: title,
                                text: text,
                                button: false,
                            });
                            // window.open("/" + link, "_self");
                        }
                    } else {
                        if (data["status"] == "error") {
                            icon = "error";
                            title = "Belum Aktif";
                            text = data["message"];
                        } else if (data["status"] == "failed") {
                            icon = "error";
                            title = "Login Gagal";
                            text = data["message"];
                        }

                        if (data["status"] == "success") {
                            window.localStorage.setItem("jwttoken", data["token"]);
                            location.reload()
                        }

                        swal({
                            icon: icon,
                            title: title,
                            text: text,
                            button: false,
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    swal({
                        icon: "error",
                        title: "Koneksi Gagal",
                        text: "Status " + textStatus,
                        button: false,
                    });
                },
            });
        }

        function expireCaptcha() {
            $('#submit').prop('disabled', true)
        }

        function doSomething() {
            if (grecaptcha.getResponse() == "") {
                $('#submit').prop('disabled', true)
            } else {
                $('#submit').prop('disabled', false)
            }
        }
    </script>
</body>

</html>
