<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-payments-link" data-toggle="tab" href="#tab-payments" role="tab" aria-controls="tab-payments" aria-selected="false">Payment details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Delivery adresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users/logout/">Sign Out</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Hello <span class="font-weight-normal text-dark"> <?= $user->name ?></span> (not <span class="font-weight-normal text-dark"><?= $user->name ?></span>? <a href="/users/logout/">Log out</a>) 
                                <br>
                                From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <p>No order has been made yet.</p>
                                <a href="/products" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-payments" role="tabpanel" aria-labelledby="tab-payments-link">
                                <?php if (isset($creaditCards)) { ?>
                                    <p>The following addresses will be used on the checkout page by default.</p>

                                    <div class="row3">
                                        <?php foreach ($creaditCards as $card) { ?>
                                        <div class="credit__panel">
                                            <?php if ($card->default == 'T') { ?>
                                                <div class="credit__default"> <span>  Default </span> </div>
                                                <div role="button" class="role card--2 card--front card--selected ">
                                            <?php } else { ?>
                                                <div role="button" class="role card--2 card--front ">
                                            <?php } ?>
                                            <input type="hidden" value="<?= $card->id ?>">


                                            <div class="card__number"><?= $card->number ?></div>
                                            <div class="card__expiry-date"><?= $this->v->dateFormat($card->year, $card->month) ?></div>
                                            <div class="card__owner">
                                            <?= $card->name ?>
                                            <img class="" src="/assets/images/visa.png"></img>
                                            </div>
                                        </div>
                                        <div class="action">
                                            <a class="toggle-link" href="#tab-creditCards" data-toggle="modal">Edit <i class="icon-edit"></i></a></p>
                                        </div>
                                    </div>

                                        <?php } ?>
                                </div>

                                <?php } else { ?>
                                    <p>You have currently no registred credit card address.</p>
                                <?php } ?>
                                    <div class="row2">
                                        <button type="button" class="toggle-button btn btn-outline-primary-2" href="#tab-creditCards" data-toggle="modal">
                                            <span> Add </span>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <?php if (isset($addresses)) { ?>
                                    <p>The following addresses will be used on the checkout page by default.</p>
                                    <div class="row">
                                        <?php foreach ($addresses as $address) { ?>
                                            <div class="col-lg-6">
                                                <div class="card card-dashboard">
                                                    <div class="card-body">
                                                        <?php if (isset($address->addressName)) { ?>
                                                        <input type="hidden" value="<?= $address->id ?>">
                                                        <h3 class="card-title addressTitle"><?= ucwords($address->addressName) ?></h3><!-- End .card-title -->
                                                        <?php } else { ?>
                                                        <h3 class="card-title">Delivery Address</h3><!-- End .card-title -->
                                                        <?php } ?>
                                                            <div class ="addressName"><?= ucwords($address->name) ?> <?= ucwords($address->lastName) ?></div>
                                                            <div class="addressStreet"><?= $address->street ?></div>
                                                            <div class="addressCity"><?= ucwords($address->city) ?> <?= $address->postCode ?></div>
                                                            <?php if (isset($address->addressComplement)) { ?>
                                                            <div class="addressComp"><?= ucwords($address->addressComplement) ?></div><br>
                                                            <?php } ?>
                                                       
                                                            <a class="toggle-link" href="#tab-deliveries" data-toggle="modal">Edit <i class="icon-edit"></i></a></p>
                                                            <div class="radio-input">
                                                                <?php if ($address->default == 'T') { ?>
                                                                    <input class="radioInput" name="default" type="radio" checked>
                                                                <?php } else { ?>
                                                                    <input class="radioInput" name="default" type="radio">
                                                                <?php } ?>
                                                                <label class='radioLabel' for="default">default</label>
                                                            </div>

                                                    </div><!-- End .card-body -->
                                                </div><!-- End .card-dashboard -->
                                            </div><!-- End .col-lg-6 -->

                                            <?php } ?>
                                    </div><!-- End .row -->
                                <?php } else { ?>
                                    <p> You have currently no registred delivery address.</p>
                                <?php } ?>
                                <div class="row2">
                                    <button type="button" class="toggle-button btn btn-outline-primary-2" href="#tab-deliveries" data-toggle="modal">
                                        <span> Add </span>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <div class="accordion accordion-rounded" id="accordion-5" >

                                    <div class="card card-box card-sm bg-light">
                                        <div class="card-header" id="heading5-1">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#collapse5-1" aria-expanded="false" aria-controls="collapse5-1" class="collapsed">
                                                    Personnal infromations
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse5-1" class="collapse" aria-labelledby="heading5-1" data-parent="#accordion-5">
                                            <div class="card-body">
                                                <?= \Phalcon\Tag::form(['/account/edituser/', 'method' => 'post', 'enctype' => 'multipart/form-data']) ?>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <?= $EditUserForm->label('name', ['for' => 'name']) ?>
                                                            <?= $EditUserForm->render('name', ['class' => 'form-control']) ?>
                                                            <?= $EditUserForm->messages('name') ?>
                                                        </div><!-- End .col-sm-6 -->
                                                        <div class="col-sm-6">
                                                            <?= $EditUserForm->label('lastName', ['for' => 'lastName']) ?>
                                                            <?= $EditUserForm->render('lastName', ['class' => 'form-control']) ?>
                                                            <?= $EditUserForm->messages('lastName') ?>
                                                        </div><!-- End .col-sm-6 -->
                                                    </div><!-- End .row -->

                                                    <?= $EditUserForm->label('birthday', ['for' => 'birthday']) ?>
                                                    <?= $EditUserForm->render('birthday', ['class' => 'form-control']) ?>
                                                    <?= $EditUserForm->messages('birthday') ?>
                                  
                                                    <?= $EditUserForm->label('phoneNumber', ['for' => 'phoneNumber']) ?>
                                                    <?= $EditUserForm->render('phoneNumber', ['class' => 'form-control']) ?>  
                                                    <?= $EditUserForm->messages('phoneNumber') ?>                  
                                                    <div class="row2">
                                                      <button type="submit" class="button btn2 btn-outline-primary-2">
                                                        <span>Edit</span>
                                                        <i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </div>
                                                <?= \Phalcon\Tag::endForm() ?>

                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->
    
                                    <div class="card card-box card-sm bg-light">
                                        <div class="card-header" id="heading5-2">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse5-2" aria-expanded="false" aria-controls="collapse5-2">
                                                    Your email
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse5-2" class="collapse" aria-labelledby="heading5-2" data-parent="#accordion-5">
                                            <div class="card-body">
                                                <?= \Phalcon\Tag::form(['/account/editemail/', 'method' => 'post', 'enctype' => 'multipart/form-data']) ?>

                                                    <?= $ChangeEmailForm->label('currentEmail', ['for' => 'currentEmail']) ?>
                                                    <?= $ChangeEmailForm->render('currentEmail', ['class' => 'form-control']) ?>
                                                    
                                                    <div class="row2">
                                                        <button type="button" class="button btn btn-outline-primary-2">
                                                            <span> Edit </span>
                                                            <i class="icon-long-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                <?= \Phalcon\Tag::endForm() ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-box card-sm bg-light">
                                        <div class="card-header" id="heading5-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse5-3" aria-expanded="false" aria-controls="collapse5-2">
                                                    Your password
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse5-3" class="collapse" aria-labelledby="heading5-3" data-parent="#accordion-5">
                                            <div class="card-body">
                                                <?= \Phalcon\Tag::form(['/account/changepassword/', 'method' => 'post', 'enctype' => 'multipart/form-data']) ?>
                                                    <?= $ChangePasswordForm->label('currentPassword', ['for' => 'currentPassword']) ?>
                                                    <?= $ChangePasswordForm->render('currentPassword', ['class' => 'form-control']) ?>
                    
                                                    <?= $ChangePasswordForm->label('newPassword', ['for' => 'newPassword']) ?>
                                                    <?= $ChangePasswordForm->render('newPassword', ['class' => 'form-control']) ?>

                                                    <?= $ChangePasswordForm->label('confirmPassword', ['for' => 'confirmPassword']) ?>
                                                    <?= $ChangePasswordForm->render('confirmPassword', ['class' => 'form-control']) ?>
                    
                                                    <div class="row2">
                                                        <button type="button" class="btn button btn-outline-primary-2">
                                                            <span>Edit</span>
                                                            <i class="icon-long-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                <?= \Phalcon\Tag::endForm() ?>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                </div>
                            </div><!-- .End .tab-pane -->



                        
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<div class="modal fade" id="tab-creditCards" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
                <div class="form-box"> 
    <div class="form-tab">
        <div class="tab-content" >
            <!-- Login -->
            <ul class="nav nav-pills nav-fill" role="tablist">
                <li class="nav-item">
                    <div class="nav-link">Billing Address</div>
                </li>
            </ul>
            <div class="mb-3"></div>
            <?= \Phalcon\Tag::form(['/', 'method' => 'post', 'enctype' => 'multipart/form-data']) ?>
            
                <?= $creditCardForm->render('cardId') ?>

                <?= $creditCardForm->label('cardNumber', ['for' => 'cardNumber']) ?>
                <?= $creditCardForm->render('cardNumber', ['class' => 'form-control']) ?>

                <?= $creditCardForm->label('expiryDate', ['for' => 'expiryDate']) ?>
                <?= $creditCardForm->render('expiryDate', ['class' => 'form-control']) ?>

                <?= $creditCardForm->label('cardName', ['for' => 'cardName']) ?>
                <?= $creditCardForm->render('cardName', ['class' => 'form-control']) ?>
                
                <div class="row2">
                    <button type="submit" name="saveButton" class="btn btn-outline-primary-2">
                        <span> Save </span>
                        <i class="icon-long-arrow-right"></i>
                    </button>
                    <button type="button" name="cancelButton" class="btn btn-outline-primary-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> Cancel </span>
                    </button>
                    <button type="button" class="deleteButton btn btn-outline-primary-2" name="deleteButton">
                        <span> Delete </span>
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            <?= \Phalcon\Tag::endForm() ?>
            </div>

        </div>
    </div>
</div>
            </div>
        </div>
    </div>  
</div>

<div class="modal fade" id="tab-deliveries" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
                <div class="form-box"> 
    <div class="form-tab">
        <div class="tab-content" >
            <!-- Login -->
            <ul class="nav nav-pills nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link">Devliery Addresses</a>
                </li>
            </ul>
            <div class="mb-3"></div>
            <?= \Phalcon\Tag::form(['/account/addnewaddress/', 'method' => 'post', 'enctype' => 'multipart/form-data']) ?>


            <?= $DeliveryForm->render('addressId', ['class' => 'form-control']) ?>

            <?= $DeliveryForm->label('title', ['for' => 'title']) ?>
            <?= $DeliveryForm->render('title', ['class' => 'form-control']) ?>

                <div class="row">
                    <div class="col-sm-6">
                        <?= $DeliveryForm->label('deliveryName', ['for' => 'deliveryName']) ?>
                        <?= $DeliveryForm->render('deliveryName', ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $DeliveryForm->label('deliveryLastName', ['for' => 'deliveryLastName']) ?>
                        <?= $DeliveryForm->render('deliveryLastName', ['class' => 'form-control']) ?>
                    </div>
                </div>
                <?= $DeliveryForm->label('street', ['for' => 'street']) ?>
                <?= $DeliveryForm->render('street', ['class' => 'form-control']) ?>

                <?= $DeliveryForm->label('complementary', ['for' => 'complementary']) ?>
                <?= $DeliveryForm->render('complementary', ['class' => 'form-control']) ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $DeliveryForm->label('postCode', ['for' => 'postCode']) ?>
                        <?= $DeliveryForm->render('postCode', ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $DeliveryForm->label('cityName', ['for' => 'cityName']) ?>
                        <?= $DeliveryForm->render('cityName', ['class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="row2">
                    <button type="submit" class="btn btn-outline-primary-2">
                        <span> Save </span>
                        <i class="icon-long-arrow-right"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> Cancel </span>
                    </button>
                    <button type="submit" class="deleteButton btn btn-outline-primary-2" name="deleteButton">
                        <span> Delete </span>
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            <?= \Phalcon\Tag::endForm() ?>
            </div>

        </div>
    </div>
</div>
            </div>
        </div>
    </div>  
</div>

