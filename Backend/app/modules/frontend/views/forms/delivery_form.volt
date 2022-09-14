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
            {{ end_form() }}
            </div>

        </div>
    </div>
</div>