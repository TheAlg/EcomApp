const saveButton = 'save-user-update';
const editButton= 'edit-user-update';
const cancelButton = 'cancel-user-update';
const buttonsContainer = 'edit-buttons';
const sections = '.card-box';
const form = 'account-edit-form';
const billings = 'tab-creditCards';
const deliveries = 'tab-deliveries';
var selectedSection,userEmail;

html.account = {
    cancelButton: `<button type="button" id ="cancel-user-update" class="btn2 btn-outline-primary-2">
                    <span>Cancel</span></button>`,
    editButton : `<button type="button" id ="edit-user-update" class="btn2 btn-outline-primary-2">
                <span>Edit</span><i class="icon-long-arrow-right"></button>`,
    saveButton : `<button type="submit" id ="save-user-update" class="btn2 btn-primary">
                <span>Save</span></i></button>`,
    emailInput : `<label for="newEmail" id="email-label">New Email</label>
                <input type="text" id="newEmail" name="newEmail" class="form-control" style="background-color: rgb(255, 255, 255);">`,
    deleteButton :`<button type="button" class=" deleteButton btn btn-outline-primary-2">
                    <span> Delete </span><i class="fa fa-trash"></i></button>`,
    toggleSaveButton:`<button type="submit" name="saveButton" class="btn btn-outline-primary-2">
                    <span> Save </span> <i class="icon-long-arrow-right"></i></button>`,
    default : `<div class="credit__default"> <span>  Default </span> </div>`
}
api.account = {
    post : async (route, params =null)=>{
        const result = await $.ajax({
            type: "POST", 
            url: baseUrl +route, 
            data: params,    
            error: function() {
                alert("problem communicating with server");
            } 
        });
    } 
}   
main.account = {
    addEmailInput:()=>{
        $('#'+form +' input[id=currentEmail]').after(html.account.emailInput);
    },
    removeEmailInput:()=>{
        $('#'+form +' input[id=newEmail]').remove();
        $('#email-label').remove();

    },
    activateForm : () =>{
        $('#'+buttonsContainer).append(html.account.saveButton)
        $('#'+buttonsContainer).append(html.account.cancelButton)
        $('#'+editButton).remove();
        let inputs = $('form#' + form +' :input')
        for (let i= 0; i<inputs.length; i++){
            if ($(inputs[i]).attr('type') !== "button" 
            && $(inputs[i]).attr('type')!== "submit") {
                inputs[i].disabled = false;
                inputs[i].style.backgroundColor = "#fff"
                //inputs[i].style.border = "1px solid #39f"
            }
        }
    },
    deactivateForm : () =>{
        $('#'+buttonsContainer).append(html.account.editButton)
        $('#'+saveButton).remove();
        $('#'+cancelButton).remove();
        let inputs = $('form#' + form +' :input')
        for (let i= 0; i<inputs.length; i++){

            if ($(inputs[i]).attr('type') !== "button" 
            && $(inputs[i]).attr('type') !== "submit") {
                inputs[i].disabled = true;
                inputs[i].style.backgroundColor = "#f9f9f9"
                inputs[i].style.border = "1px solid #ebebeb"
            }}
        },
    resetSection:()=>{
        selectedSection = null;
        $('#selected').css({"border" : '0.1rem solid #ebebeb'})
        //this
        $("#selected").removeAttr('id')
        //buttons
        $('#'+editButton).removeAttr('id')
        $('#'+saveButton).removeAttr('id')
        $('#'+cancelButton).removeAttr('id')
        //form
        $('#'+form).removeAttr('id')
        //button container
        $('#'+buttonsContainer).removeAttr('id');
    },
    defineSection: (param)=>{
        selectedSection = param;
        $(param).attr('id', 'selected')
        $(param).css({"border" : 'solid #39f'});
        $(param).find('form:first').attr('id', form)
        $(param).find('.row2:first').attr('id', buttonsContainer)
        let buttons = $("#"+buttonsContainer).find('button')
        //managing buttons
        for (let i=0; i<buttons.length;i++){
            if (buttons[i].textContent.trim() === "Edit")
                buttons[i].id= editButton;
            else{
                buttons[0].id = saveButton
                buttons[1].id = cancelButton
            }
        }
    },
    removeDeleteButton:(param)=>{
        if ( $(param).attr('href') === '#tab-deliveries') 
            $('#'+deliveries+ ' form').find('button[name="deleteButton"]').remove();
        else
            $('#'+billings + ' form').find('button[name="deleteButton"]').remove();
    },
    addDeleteButton:(param)=>{
        if (!$('#'+deliveries+ ' form').find('button[name="deleteButton"]').length )
            $('#'+deliveries+ ' form').find('.row2').append(html.account.deleteButton);

        if ( !$('#'+billings+ ' form').find('button[name="deleteButton"]').length ){
            $('#'+billings + ' form').find('.row2').append(html.account.deleteButton);
        }
    },
    removeSaveButton(){
        if ($('#'+billings+ ' form').find('button[name="saveButton"]').length){
            //remove save button for credit card edit action
            $('#'+billings + ' form').find('button[name="saveButton"]').remove();
        }
    },
    addSaveButton(){
        if (!$('#'+billings+ ' form').find('button[name="saveButton"]').length){
            $('#'+billings + ' form .row2').prepend(html.account.toggleSaveButton);
        }
    },

    editAction(param){
        if ($(param).attr('href') === '#tab-deliveries') {
            $('#'+deliveries +' form').attr('action', '/account/editaddress/')
        }
    },
    newAction(param){
        if ( $(param).attr('href') === '#'+deliveries) 
            $('#'+deliveries + ' form').attr('action', '/account/addnewaddress/')
        if ($(param).attr('href') === '#'+billings)
            $('#'+billings + ' form:first').attr('action', '/account/addcreditcard/')
    },
    deleteAction(param){
        if ($(param).closest('.modal').attr('id') === deliveries)
            $('#'+deliveries + ' form').attr('action', '/account/deleteaddress/');
        if ($(param).closest('.modal').attr('id') === billings){
            $('#'+billings + ' form').attr('action', '/account/deletecreditcard/');
        }
    },
    async filForm(current){
        if ( $(current).attr('href') === "#"+deliveries) {

            $('#title').attr('value',$(current).siblings('.addressTitle').text());


            let names = $(current).siblings('.addressName').text().split(' ');
                $('#deliveryName').attr('value',names[0])
                $('#deliveryLastName').attr('value',names[1])
            let address = $(current).siblings('.addressCity').text().split(' ')
                $('#cityName').attr('value',address[0]);
                $('#postCode').attr('value',address[1]);


            $('#street').attr('value',$(current).siblings('.addressStreet').text());
            $('#complementary').attr('value',$(current).siblings('.addressComp').text());
            $('#addressId').attr("value", $(current).siblings('input').val());
        }
        else if ( $(current).attr('href') === "#"+billings) {
             
            cardnumber = $(current).parent().siblings('.card--front').children('.card__number').text();
            $('#cardNumber').attr('value',cardnumber);

            expirydate = $(current).parent().siblings('.card--front').children('.card__expiry-date').text();
            $('#expiryDate').attr('value',expirydate);

            owner = $(current).parent().siblings('.card--front').children('.card__owner').text().trim();
            $('#cardName').attr("value", owner);

        }
    },
    emptyForm(param){
        if ( $(param).attr('href') === "#"+deliveries) {
            $('#title').attr('value','');
            $('#deliveryName').attr('value','')
            $('#deliveryLastName').attr('value','')
            $('#cityName').attr('value','');
            $('#postCode').attr('value','');
            $('#street').attr('value','');
            $('#complementary').attr('value','');
        }
        if ( $(param).attr('href') === '#'+billings){
            $('#cardNumber').attr('value','');
            $('#expiryDate').attr('value','')
            $('#cardName').attr('value','')
        }
    },
    resetSelection:(current)=>{
        items = $(current).closest('.credit__panel').siblings();
        for (let i=0; i<items.length;i++)
            if ($(items[i]).find('.credit__default').length !== 0 ){
                $(items[i]).find('.credit__default').remove(); //on retire le mot "default"
                $(items[i]).find('.card--2').removeClass('card--selected') //on change le css
            }
        },
    selectCreditCard:(current)=>{
        //on selectionne la carte
        $(current).closest('.credit__panel').find('.card--2').addClass('card--selected')
        $(current).closest('.credit__panel').prepend(html.account.default)
    }

}


buttons.account = {
    //sections parts click to show/click to hide
    edit:
        $(document.body).on('click', '#'+editButton, function() {
            main.account.activateForm();
            if ($(selectedSection).find('a').text().trim() === 'Your email'){
                main.account.addEmailInput();
                userEmail = document.getElementById('currentEmail').value;
                document.getElementById('currentEmail').value='';
            }
        }),
    cancel:
        $(document.body).on('click', '#'+cancelButton, function() {
            main.account.deactivateForm();
            if ($(selectedSection).find('a').text().trim() === 'Your email'){
                main.account.removeEmailInput();
                document.getElementById('currentEmail').value=userEmail;
            }
        }),
    save:
        $(document.body).on('submit', '#'+saveButton, function() {
            main.account.deactivateForm();
        }),
    section: 
        $(document.body).on('click', sections, function() {
            if (selectedSection !== this){
                main.account.resetSection();
                main.account.defineSection(this);
            }
        }),
        //toggle parts / click to toggle form
    editToggled :
        $(document.body).on('click', '.toggle-link', function() {
            main.account.addDeleteButton();
            main.account.removeSaveButton();
            //change form action to edit
            main.account.editAction(this);
            //fills the form in question
            main.account.filForm(this);
        }),
    addToggled:
        $(document.body).on('click', '.toggle-button', function() {
            main.account.removeDeleteButton(this);
            main.account.addSaveButton();
            //change form action to new
            main.account.newAction(this);
            //empty the form in question
            main.account.emptyForm(this);
    }),
    deleteToggled:   
        $(".deleteButton").on('click', function(){
            //edit form action to delete 
            main.account.deleteAction(this);  
            $(this).closest('form').submit();
    }),
    selectCreditCard:
        $('.card--front').on('click', function(){
            id = $(this).find('input:first').val()
            console.log( id);
            api.account.post('/account/carddefault', {card_id:id});
            main.account.resetSelection(this);
            main.account.selectCreditCard(this);
        }),
    selectAddress:
    $('.radioInput').on('click', function(){
        id = $(this).parent().siblings('input').val()
        api.account.post('/account/addressdefault/', {address_id:id});
    })
}
    






