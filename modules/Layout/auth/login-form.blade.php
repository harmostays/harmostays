<form class="bravo-form-login" id="bravo-login-form" method="POST" action="{{ route('login') }}">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById('bravo-login-form').submit();
        }
    </script>
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="email" autocomplete="off" placeholder="{{__('Email address')}}">
        <i class="input-icon icofont-mail"></i>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group" style="position: relative;">
        <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="{{__('Password')}}">
        <span toggle="#password" class="fa fa-fw fa-eye toggle-password" style="cursor: pointer; position: absolute; top: 50%; right: 15px; transform: translateY(-50%);"></span>
        <span class="invalid-feedback error error-password"></span>
    </div>
    
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="remember-me" class="mb0">
                <input type="checkbox" name="remember" id="remember-me" value="1"> {{__('Remember me')}} <span class="checkmark fcheckbox"></span>
            </label>
            <a href="{{ route("password.request") }}">{{__('Forgot Password?')}}</a>
        </div>
    </div>

    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button 
            class="btn btn-primary form-submit g-recaptcha" 
            data-sitekey="{{ config('services.recaptcha.key') }}" 
            data-callback="onSubmit" 
            data-action="login" 
            type="submit">
            {{ __('Login') }}
            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    @if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable'))
        <div class="advanced">
            <p class="text-center f14 c-grey">{{__('or continue with')}}</p>
            <div class="row">
                @if(setting_item('facebook_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('/social-login/facebook')}}"class="btn btn_login_fb_link" data-channel="facebook">
                            <i class="input-icon fa fa-facebook"></i>
                            {{__('Facebook')}}
                        </a>
                    </div>
                @endif
                @if(setting_item('google_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('social-login/google')}}" class="btn btn_login_gg_link" data-channel="google">
                            <i class="input-icon fa fa-google"></i>
                            {{__('Google')}}
                        </a>
                    </div>
                @endif
                @if(setting_item('twitter_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('social-login/twitter')}}" class="btn btn_login_tw_link" data-channel="twitter">
                            <i class="input-icon fa fa-twitter"></i>
                            {{__('Twitter')}}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif
    @if(is_enable_registration())
        <div class="c-grey font-medium f14 text-center"> {{__('Do not have an account?')}} <a href="" data-target="#register" data-toggle="modal">{{__('Sign Up')}}</a></div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.toggle-password').addEventListener('click', function (e) {
                const passwordField = document.querySelector('#password');
                const icon = e.target;
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</form>
