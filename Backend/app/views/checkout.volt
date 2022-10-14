<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div><!-- End .checkout-discount -->

                    <div class="row">
                        <div class="n2 col-lg-9">

                            <div class="card card-box card-sm bg-light">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <a role="button" data-toggle="collapse" href="#identity" class="collapse show">
                                            Personnal infromations
                                        </a>
                                    </h2>
                                </div><!-- End .card-header -->
                                <div class="card-body collapse show" id ="identity">
                                    {{form('/account/edituser/','method' : "post", 'enctype': "multipart/form-data") }}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {{ EditUserForm.label('name', ['for': 'name']) }}
                                                {{ EditUserForm.render('name',[ 'class': 'form-control']) }}
                                                {{ EditUserForm.messages('name') }}
                                            </div><!-- End .col-sm-6 -->
                                            <div class="col-sm-6">
                                                {{ EditUserForm.label('lastName', ['for': 'lastName']) }}
                                                {{ EditUserForm.render('lastName',[ 'class': 'form-control']) }}
                                                {{ EditUserForm.messages('lastName') }}
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        {{ EditUserForm.label('birthday', ['for': 'birthday']) }}
                                        {{ EditUserForm.render('birthday',[ 'class': 'form-control']) }}
                                        {{ EditUserForm.messages('birthday') }}
                        
                                        {{ EditUserForm.label('phoneNumber', ['for': 'phoneNumber']) }}
                                        {{ EditUserForm.render('phoneNumber',[ 'class': 'form-control']) }}  
                                        {{ EditUserForm.messages('phoneNumber') }}                  
                                        <div class="row2">
                                            <button type="submit" class="button btn2 btn-outline-primary-2">
                                            <span>Edit</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div>
                                    {{ end_form() }}

                                </div><!-- End .card-body -->
    
                            </div><!-- End .card -->

                            <div class="card card-box card-sm bg-light">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <a role="button" data-toggle="collapse" href="#address" class="collapse show"> 
                                            Your Delivery Address
                                        </a>
                                    </h2>
                                </div><!-- End .card-header -->
                                    <div class="card-body collapse show" id ="address">

                                        {{form('/account/addnewaddress/','method' : "post", 'enctype': "multipart/form-data") }}

                                        {{ DeliveryForm.render('addressId',[ 'class': 'form-control']) }}
                            
                                        {{ DeliveryForm.label('title', ['for': 'title']) }}
                                        {{ DeliveryForm.render('title',[ 'class': 'form-control']) }}
                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('deliveryName', ['for': 'deliveryName']) }}
                                                    {{ DeliveryForm.render('deliveryName',[ 'class': 'form-control']) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('deliveryLastName', ['for': 'deliveryLastName']) }}
                                                    {{ DeliveryForm.render('deliveryLastName',[ 'class': 'form-control']) }}
                                                </div>
                                            </div>
                                            {{ DeliveryForm.label('street', ['for': 'street']) }}
                                            {{ DeliveryForm.render('street',[ 'class': 'form-control']) }}
                            
                                            {{ DeliveryForm.label('complementary', ['for': 'complementary']) }}
                                            {{ DeliveryForm.render('complementary',[ 'class': 'form-control']) }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('postCode', ['for': 'postCode']) }}
                                                    {{ DeliveryForm.render('postCode',[ 'class': 'form-control']) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('cityName', ['for': 'cityName']) }}
                                                    {{ DeliveryForm.render('cityName',[ 'class': 'form-control']) }}
                                                </div>
                                            </div>

                                                                    
                                            <div class="row2">
                                                <button type="submit" class="button btn2 btn-outline-primary-2">
                                                <span>Edit</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div>
                                        {{ end_form() }}

    
                                    </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        
                            <div class="card card-box card-sm bg-light">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <a  role="button" data-toggle="collapse" href="#payment" class="collapse show">
                                            Your Billing Address
                                        </a>
                                    </h2>
                                </div><!-- End .card-header -->
                                <div class="card-body collapse show"id="payment">
                                    {{form('/','method' : "post", 'enctype': "multipart/form-data") }}
                                    
                                        {{ creditCardForm.label('cardNumber', ['for': 'cardNumber']) }}
                                        {{ creditCardForm.render('cardNumber',[ 'class': 'form-control']) }}

                                        {{ creditCardForm.label('cardName', ['for': 'cardName']) }}
                                        {{ creditCardForm.render('cardName',[ 'class': 'form-control']) }}

                                        <div class="row">
                                            <div class="col-sm-6">
                                                {{ creditCardForm.label('expiryDate', ['for': 'expiryDate']) }}
                                                {{ creditCardForm.render('expiryDate',[ 'class': 'form-control']) }}
                                            </div><!-- End .col-sm-6 -->
                                            <div class="col-sm-6">
                
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->
            
                                        <div class="row2">
                                        <button type="submit" class="button btn2 btn-outline-primary-2">
                                            <span>Edit</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                        </div>
                                    {{ end_form() }}
                                </div><!-- End .card-body -->
                            </div>
                        </div>

                        {% include 'templates/aside_checkout.volt' %}

                    </div>

            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->