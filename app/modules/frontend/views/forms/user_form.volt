<div class="form-box"> 
    <div class="form-tab">
        <ul class="nav nav-pills nav-fill" role="tablist">
            {% if contains(url, 'signup') %} 
            <li class="nav-item">
                <a class="nav-link" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="false" aria-expanded="false">Sign In</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link active show" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true" aria-expanded="true">Register</a>
            </li>
            {% else %} 
            <li class="nav-item active">
                <a class="nav-link active show" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true" aria-expanded="true">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false" aria-expanded="false">Register</a>
            </li>
            {% endif %}
        </ul>

        <div class="tab-content" >
            <!-- Login -->
            {% if contains(url, 'signup') %} 
                <div class="tab-pane fade" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                {% else %}
                <div class="tab-pane fade active in show" id="signin" role="tabpanel" aria-labelledby="signin-tab">
            {% endif %}
                {{form('/users/login', 'method' : 'post', 'enctype': "multipart/form-data") }}
                    <!-- username -->
                    <div class="form-group">
                        {{ loginForm.label('login_email', ['for': 'login_email']) }}
                        {{ loginForm.render('login_email',[ 'class': 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ loginForm.label('login_password', ['for': 'login_password']) }}
                        {{ loginForm.render('login_password', [ 'class': 'form-control']) }}
                    </div>
                    <div class="form-footer" action="">
                        {{ loginForm.render('login_token', ['value': security.getToken()]) }}
                        {{ loginForm.render('Login', ['class' :'btn btn-primary']) }}
                        <span>LOG IN</span>
                        <i class="icon-long-arrow-right"></i>
                        <div class="custom-control custom-checkbox">
                            {{ loginForm.render('login_remember', ['class': 'custom-control-input', 'id':'signin-remember']) }}
                            {{ loginForm.label('login_remember', ['class': 'custom-control-label', 'for': 'signin-remember']) }}
                        </div><!-- End .custom-checkbox -->
                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                    </div>
                {{ end_form() }}
                <div class="form-choice">
                    <p class="text-center">or sign in with</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-login btn-g">
                                <i class="icon-google"></i>
                                        Login With Google
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-login btn-f">
                                <i class="icon-facebook-f"></i>
                                        Login With Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Register -->
            {% if contains(url, 'signup') %} 
                <div class="tab-pane fade active in show" id="register" role="tabpanel" aria-labelledby="register-tab">
                {% else %}
                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            {% endif %}

                {{form('/users/signup','method' : "post", 'enctype': "multipart/form-data") }}
                    <div class="form-group">
                        {{ singUpForm.label('register_name', ['for': 'register_name']) }}
                        {{ singUpForm.render('register_name',[ 'class': 'form-control']) }}
                    </div>
                    {{ singUpForm.messages('register_name') }}
                    <div class="form-group">
                        {{ singUpForm.label('register_email', ['for': 'register_email']) }}
                        {{ singUpForm.render('register_email',[ 'class': 'form-control']) }}
                    </div>
                    {{ singUpForm.messages('register_email') }}

                    <div class="form-group">
                        {{ singUpForm.label('register_password', ['for': 'register_password']) }}
                        {{ singUpForm.render('register_password',[ 'class': 'form-control']) }}
                    </div>
                    {{ singUpForm.messages('register_password') }}

                    <div class="form-group">
                        {{ singUpForm.label('register_confirmPassword', ['for': 'register_confirmPassword']) }}
                        {{ singUpForm.render('register_confirmPassword',[ 'class': 'form-control']) }}
                    </div>
                    {{ singUpForm.messages('register_confirmPassword') }}
                    <div class="form-footer">
                        {{ singUpForm.render('register_token', ['value': security.getToken()]) }}                    
                        {{ singUpForm.render('Sign Up', ['class' :'btn btn-primary']) }}
                        <span>SIGN UP</span>
                        <i class="icon-long-arrow-right"></i>
                        <div class="custom-control custom-checkbox">
                            {{ singUpForm.render('register_terms', ['class': 'custom-control-input', 'id':'register_terms']) }}
                            {{ singUpForm.label('register_terms', ['class': 'custom-control-label', 'for': 'register_terms']) }}
                        </div>
                        {{ singUpForm.messages('register_terms') }}

                    </div>
                    {{ end_form() }}
                    <div class="form-choice">
                    <p class="text-center">or sign in with</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-login btn-g">
                                <i class="icon-google"></i>
                                        Login With Google
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-login  btn-f">
                                <i class="icon-facebook-f"></i>
                                        Login With Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>