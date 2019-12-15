<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS & JS -->
    <!--    async và defer để đặt js ở head khi tải sẽ taỉ không đồng bộ hoặc trì hoãn giúp html k bị tải sau -->
    <!-- <script src="{{ asset('js/app.js') }}" type="text/javascript" async></script> -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php //Hiển thị thông báo thành công
        ?>
        @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="#" method="POST" role="form">
                    <legend class="text-center">Login</legend>

                    <div class="alert alert-danger error errorLogin" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p style="color:red; display:none;" class="error errorLogin"></p>
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" placeholder="username" name="username" value="{{old('username')}}">
                        <p style="color:red; display: none" class="error errorUsername"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        <p style="color:red; display: none" class="error errorPassword"></p>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember"> Remember
                    </div>
                    
                    <div class="row justify-content-between">
                        <div class="col-md-3">
                            <button id="dang-nhap" type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                        <div class="col-md-8">
                            <p>Don't have an account?
                                <a href="{{Route('register')}}">Register</a>
                            </p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(function() {
        $('#dang-nhap').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                'url': 'login',
                'data': {
                    'username': $('#username').val(),
                    'password': $('#password').val()
                },
                'type': 'POST',
                success: function(data) {
                    console.log(data);
                    if (data.error == true) {
                        $('.error').hide();
                        if (data.message.username != undefined) {
                            $('.errorUsername').show().text(data.message.username[0]);
                        }
                        if (data.message.password != undefined) {
                            $('.errorPassword').show().text(data.message.password[0]);
                        }
                        if (data.message.errorlogin != undefined) {
                            $('.errorLogin').show().text(data.message.errorlogin[0]);
                        }
                    } 
                    else {
                        window.location.href = (data.url);
                       
                    }
                }
            });
        })
    });
</script>

</html>