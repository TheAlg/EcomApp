<!--TAG-->
<div class="account">
    <a href="#signin-modal" data-toggle="modal" title="My account">
    <div class="icon">
        <i class="icon-user"></i>
    </div>
    <p href="/user/login">Account</p>
    </a>
</div>

<!--BANNER-->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
                {% include 'forms/user_form.volt' %}
            </div>
        </div>
    </div>  
</div>