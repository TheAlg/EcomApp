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
            {{form('/','method' : "post", 'enctype': "multipart/form-data") }}
            
                {{ creditCardForm.render('cardId') }}

                {{ creditCardForm.label('cardNumber', ['for': 'cardNumber']) }}
                {{ creditCardForm.render('cardNumber',[ 'class': 'form-control']) }}

                {{ creditCardForm.label('expiryDate', ['for': 'expiryDate']) }}
                {{ creditCardForm.render('expiryDate',[ 'class': 'form-control']) }}

                {{ creditCardForm.label('cardName', ['for': 'cardName']) }}
                {{ creditCardForm.render('cardName',[ 'class': 'form-control']) }}
                
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
            {{ end_form() }}
            </div>

        </div>
    </div>
</div>