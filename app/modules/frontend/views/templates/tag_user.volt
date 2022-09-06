<!--TAG-->
<div class="account account-dropdown">
    {% if user is not defined %}
    <a href="#signin-modal" data-toggle="modal" title="My account" role="button" aria-haspopup="true" aria-expanded="false" data-display="static">
    {% else %}
    <a href="/account" title="My account">
    {% endif %}

    <div class="icon">
        <i class="icon-user"></i>
    </div>
    <p href="/users/login/">Account</p>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        {% if user is defined %}
            <div class="account-actions">
                <a href="/account" class="btn btn-outline-primary">
                    Account 
                </a>
            </div>
            <div class="mb-3"></div>
            <hr>
            <ul class="account-actions-list">
                <li>
                    <a class="action-link" href =""> 
                        <span> Account Settings </span> 
                    </a>
                </li>
                <li>
                    <a class="action-link" href =""> 
                        <span> Return a product </span> 
                    </a>
                </li>
                <li>
                    <a class="action-link" href =""> 
                        <span> Deliveries  </span>
                    </a>
                </li>
                <li>
                    <a class="action-link" href =""> 
                        <span> Help & Contact </span>
                    </a>
                </li>    
            </ul>
            <hr>
            <div class="account-actions"> You're not {{ user.name }} ? 
                <a href ="/users/logout/" class="create-acount"> 
                    <span class="blue" > &nbsp;&nbsp;disconnect </span>
                </a>
            </div>
        {% else %}
            <div class="account-actions">
                <a href="/users/login/" class="btn btn-primary btn-round white">
                    <span>Login</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div>
            <div class="account-actions">
                <a href ="/users/signup/" class="create-acount"> 
                    <span> Or create new account </span>
                </a>
            </div>
            <hr>
            <ul class="account-actions-list">
                <li>
                    <a class="action-link" href =""> 
                        <span> Account Settings </span> 
                    </a>
                </li>
                <li>
                    <a class="action-link" href =""> 
                        <span> Deliveries  </span>
                    </a>
                </li>
                <li>
                    <a class="action-link" href =""> 
                        <span> Help & Contact </span>
                    </a>
                </li>    
            </ul>
        {% endif %}
        
           


    </div>
</div>

<!--BANNER-->
{% if user is not defined %}
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
{% endif %}