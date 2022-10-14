{% if contains(url, 'users') %}
<header class="header header-6">
    <div class="header-middle">
        <div class="container">
            <div class="header-center">
                <a href="/" class="logo">
                    <img src="/assets/images/demos/demo-2/logo.png" alt="Molla Logo" width="105" height="25">
                </a>
            </div>
        </div>
    </div>
</header>
{% else %}
<header class="header header-10 header-intro-clearance">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                
                <a href="index.html" class="logo">
                    <img src="assets/images/demos/demo-13/logo.png" alt="Molla Logo" width="105" height="25">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                {% include 'templates/header_center.volt' %}
            </div> 
            <div class="header-right">
                <div class="header-dropdown-link">
                    {% include 'templates/tag_user.volt' %}
                    {% include 'templates/tag_whishlist.volt' %}
                    {% include 'templates/tag_cart.volt' %}
                </div>
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        {% include 'templates/header_bottom.volt' %}
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
{% endif %}

