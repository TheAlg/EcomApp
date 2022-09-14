const wizard = new Wizard();
const nextButton = '.next';
const prevButton = '.prev';
const deliveryForm = '#checkoutAddress';
var user = '';
var currentStep = 3;
var wizardStep;
var invalidInputs=[];


api.checkout={
    post: async (route, params =null)=>{
        const result = await $.ajax({
            type: "POST", 
            url: route, 
            data: params,
        });
        const data = await JSON.parse(result);
        return data;
    }
}    
html.checkout ={
    resetInvalidInputs:()=>{
        for (let i=0; i<invalidInputs.length;i++){
            $('#' + invalidInputs[i].field)
            .css('border-color', '')
            .prev().remove();
        }
        invalidInputs = [];
    },
    error:(response)=>{
        html.checkout.resetInvalidInputs();
        for (let i=0; i<response.length;i++){
            $('#'+response[i].field)
            .css('border-color', 'red')
            .before('<p style="color:red;">' + response[i].message + '</p>');
            //adding it to a invalidinput list so we can reset inputs
            invalidInputs.push(response[i]);
        }
    },
    filForm:async(data)=>{
        for (field of Object.getOwnPropertyNames(data)){
            if ($("#"+field) !== "undefined" || $("#"+field) !== "null" ){
                $("#"+field).val(data[field]).attr('disabled','disabled');
            }
        }
    },
    selectCard:(data)=>{
        //add payment type for credit card (paypal or vise ...)
        //in db and backend 
        //select payement
        //fil payment 
        console.log(data)
    }   
}

main.checkout = {
    
    check:async()=>{

        //define the user step
        user = await api.checkout.post(baseUrl + '/checkout/')

        if (!user.creditCard) {
            currentStep = 2;
        }
        if (!user.address){
            currentStep = 1;
        }
        if (!user.isConnected){
            window.location.replace("http://ecommerce.test/users/login");
        }
        //define the form final step
        if (typeof variable === 'undefined') {
            wizardStep = currentStep
        }

        if (currentStep >= 1)
            html.checkout.filForm(user.address)
        if (currentStep >= 2)
            html.checkout.selectCard(user.creditCard)

        //setting form to current step
        wizard.check(currentStep);

    },
    postForm:async()=>{
        let response = await api.checkout.post(
            baseUrl + wizard.getFormData().action, 
                    wizard.getFormData().data)
            console.log(wizard.getFormData().data)
        return response;
    },
    init: ()=>{
        main.checkout.check();
    }
}
buttons.checkout ={
    next : 
        $(document.body).on('click', nextButton, async () =>{
            // if form have been already validated
            if (currentStep < wizardStep  ){
                wizard.forward();
            }
            else {
                let response = await main.checkout.postForm();
                response === true ?
                    wizard.forward():
                    //show errors
                    html.checkout.error(response);
            }
        }),
    prev :
        $(document.body).on('click', prevButton, async () =>{
            if (currentStep > 0 ){
                wizard.backward();
            }
        }),

}

main.checkout.init();




















