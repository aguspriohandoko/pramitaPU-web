<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            }
            , custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"]
                , urls: ['/assets/css/fonts.min.css']
            }
            , active: function() {
                sessionStorage.fonts = true;
            }
        });

    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.css">
</head>
<body class="login">
    <div class="wrapper wrapper-login wrapper-login-full p-0">
        <div class="login-aside d-flex flex-column align-items-center justify-content-center text-center" style="width: 100%;background: url('/assets/img/gedung-laboratorium-pramita.jpg') no-repeat;background-size: cover;">
            {{-- <h1 class="title fw-bold text-white mb-3">Join Our Comunity</h1> --}}
            {{-- <img src="/assets/img/logo.png" style="width:50%" /> --}}
            {{-- <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p> --}}
        </div>
        <div class="login-aside d-flex align-items-center justify-content-center bg-white" style="padding:0;">
            <div class="container container-login container-transparent animated fadeIn" style="padding-top: 0px;">
                <img src="/assets/img/pramita-banner.png" style="width: 100%;margin-bottom: 30px;"/>
                <h3 class="text-center" style="margin-bottom: 10px;">Masuk Admin</h3>
                {{-- <hr style="margin-top: 0;"/> --}}
                <form id="login-form" method="post" action="/authenticate">
                    @csrf
                    <div>
                        <div class="input-group mt-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="txt-username"><i class="fa fa-user"></i></span>
                          </div>
                          <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="txt-username" value="{{ old('username') }}" required/>
                            
                        </div>
                        @error('username')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <div class="input-group mt-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="txt-password"><i class="fa fa-lock"></i></span>
                          </div>
                          <input name="password" type="password" value="{{ old('password') }}" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="txt-password" required/>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    
                    <div class="form-action-d-flex mt-3">
                        {{-- <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme">
                            <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                        </div> --}}
                        <button id="btn-submit" type="submit" class="btn btn-danger col-md-5 float-right mt-3 mt-sm-0 fw-bold">
                            Masuk
                        </button>
                    </div>

                    <div class="orm-action-d-flex mt-3">
                        <div id="msg-form"></div>
                    </div>
                    {{-- <hr style="margin-top: 50px;"/>
                    <address class="text-center">
                        <strong>Pramita Lab</strong>
                    </address> --}}
                    {{-- <div class="login-account">
                        <span class="msg">Don't have an account yet ?</span>
                        <a href="#" id="show-signup" class="link">Sign Up</a>
                    </div> --}}
                </form>
            </div>

            {{-- <div class="container container-signup container-transparent animated fadeIn">
                <h3 class="text-center">Sign Up</h3>
                <div class="login-form">
                    <div class="form-group">
                        <label for="fullname" class="placeholder"><b>Fullname</b></label>
                        <input id="fullname" name="fullname" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="placeholder"><b>Email</b></label>
                        <input id="email" name="email" type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordsignin" class="placeholder"><b>Password</b></label>
                        <div class="position-relative">
                            <input id="passwordsignin" name="passwordsignin" type="password" class="form-control" required>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword" class="placeholder"><b>Confirm Password</b></label>
                        <div class="position-relative">
                            <input id="confirmpassword" name="confirmpassword" type="password" class="form-control" required>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row form-sub m-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="agree" id="agree">
                            <label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
                        </div>
                    </div>
                    <div class="row form-action">
                        <div class="col-md-6">
                            <a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-secondary w-100 fw-bold">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/atlantis.min.js"></script>
    <script src="/assets/js/plugin/ajaxform/dist/jquery.form.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#login-form').ajaxForm({
                beforeSend: function() {
                    $('#btn-submit')
                      .attr('disabled','true')
                      .text('Loading...');
                },
                success: function(res) {
                    if(res.success){
                        var uri='/home'
                        // if(res.data.role_id === '58e6f1e2-d875-4d73-b8d4-67e997214194'){
                        //     uri='ambilbahan'
                        // }
                        window.location.href=uri
                    }
                    
                },
                error:function(err){

                    $('#btn-submit')
                    .removeAttr('disabled')
                    .text('Masuk');
                    $('#msg-form').html('<div class="alert alert-danger">'+err.responseJSON.message+'</div>')
                }
        });
        });
    </script>
</body>
</html>
