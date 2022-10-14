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
                <div class="mb-6"></div>
                    <div class="row">


                        <div class="n2 col-lg-9">
                            <section class="wizard">
                                <aside class="wizard-nav"> 
                                    <div class="wizard-step" data-type="form">
                                        <span class="dot"></span>
                                        <span>signup</span>
                                    </div>
                                    <div class="wizard-step " data-type="form">
                                        <span class="dot"></span>
                                        <span>Delivery address</span>
                                    </div>
                                    <div class="wizard-step" data-type="form">
                                        <span class="dot"></span>
                                        <span>Payement</span>
                                    </div>
                                    <div class="wizard-step" data-type="form">
                                        <span class="dot"></span>
                                        <span>Validation</span>
                                    </div>
                                </aside>
                                <aside class="wizard-content wizard-container">
                          
                                    <div class="wizard-step">

                                    </div>
                                    <div class="wizard-step ">

                                        {{form('/account/addnewaddress/','method' : "post", 'enctype': "multipart/form-data") }}

                                        {{ DeliveryForm.render('addressId',[ 'class': 'form-control']) }}
                            
                                        {{ DeliveryForm.label('addressName', ['for': 'addressName']) }}
                                        {{ DeliveryForm.render('addressName',[ 'class': 'form-control']) }}
                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('name', ['for': 'name']) }}
                                                    {{ DeliveryForm.render('name',[ 'class': 'form-control']) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('lastName', ['for': 'lastName']) }}
                                                    {{ DeliveryForm.render('lastName',[ 'class': 'form-control']) }}
                                                </div>
                                            </div>
                                            {{ DeliveryForm.label('street', ['for': 'street']) }}
                                            {{ DeliveryForm.render('street',[ 'class': 'form-control']) }}
                            
                                            {{ DeliveryForm.label('addressComplement', ['for': 'addressComplement']) }}
                                            {{ DeliveryForm.render('addressComplement',[ 'class': 'form-control']) }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('postCode', ['for': 'postCode']) }}
                                                    {{ DeliveryForm.render('postCode',[ 'class': 'form-control']) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ DeliveryForm.label('city', ['for': 'city']) }}
                                                    {{ DeliveryForm.render('city',[ 'class': 'form-control']) }}
                                                </div>
                                            </div>
        
                                                                    
                                    
                                        {{ end_form() }}

                                    </div>
                                    <div class="wizard-step">


                                        <div class="accordion-summary" id="accordion-5">
                                            <div class="card">
                                                <div class="card-header" id="heading5-1">
                                                    <h2 class="card-title" >
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse5-1" aria-expanded="false" aria-controls="collapse5-1">
                                                            PayPal <!--<small class="float-right paypal-link">What is PayPal?</small>-->
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse5-1" class="collapse" aria-labelledby="heading5-1" data-parent="#accordion-5">
                                                    <div class="checkout-card-body">
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
                                                    {{ end_form() }}
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->
                            
                                            <div class="card">
                                                <div class="card-header" id="heading5-2">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse5-2" aria-expanded="false" aria-controls="collapse5-2">
                                                            Credit Card
                                                            <img src="assets/images/payments-summary.png" alt="payments cards">
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse5-2" class="collapse" aria-labelledby="heading5-2" data-parent="#accordion-5">
                                                    <div class="checkout-card-body"> 


                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->
                                        </div><!-- End .accordion -->


        
                                        

                                    </div>
                                    <div class="wizard-step">
                                    </div>
                      
                                </aside>
                            </section>
                        </div>






                       
                            {% include 'templates/aside_checkout.volt' %}
                    </div>

            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->