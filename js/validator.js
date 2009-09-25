/****************************************
 JavaScript client validators
 (c) Paul D. 2008
 jthotbox@gmail.com
 http://jthotblog.blogspot.com/
 ****************************************/
var objValidatorHelper = new validatorHelper;

//Regist form, what will be sumbmited when all vallidation group will be valid
function addForm(formId, validationGroup){
    objValidatorHelper.validationGroupForms[formId] = validationGroup;
    objValidatorHelper.validadedForms[objValidatorHelper.validadedForms.length] = formId;
    
    document.getElementById(formId).onsubmit = function(){
        return false
    };
    
    objValidatorHelper.validatorSubmit = false;
}

//Regist button, what will be clicked when all vallidation group will be valid
function addButton(formId, validationGroup){
    objValidatorHelper.validationGroupForms[formId] = validationGroup;
    objValidatorHelper.validadedForms[objValidatorHelper.validadedForms.length] = formId;
    
    document.getElementById(formId).onsubmit = function(){
        return false
    };
    
    objValidatorHelper.validatorSubmit = true;
}

//Regist regex validator
function addValidatorRegEx(checkedInputId, errorDivId, regExStr, validationGroup){
    objValidatorHelper.validatorRegExExpression[checkedInputId] = regExStr;
    objValidatorHelper.registrateValidatorData(checkedInputId, errorDivId, validationGroup);
    
    document.getElementById(checkedInputId).onblur = function(){
        objValidatorHelper.checkInputRegEx(checkedInputId)
    };
    
}

//Regist required field validator
function addValidatorRequiredField(checkedInputId, errorDivId, validationGroup){
    objValidatorHelper.registrateValidatorData(checkedInputId, errorDivId, validationGroup);
    
    document.getElementById(checkedInputId).onblur = function(){
        objValidatorHelper.checkInputRequiredField(checkedInputId)
    };
}

//Regist compare validator
function addValidatorCompare(checkedInputId1, checkedInputId2, errorDivId, validationGroup){
    objValidatorHelper.registrateValidatorData(checkedInputId1, errorDivId, validationGroup);
    
    document.getElementById(checkedInputId1).onblur = function(){
        objValidatorHelper.checkInputCompare(checkedInputId1, checkedInputId2)
    };
}

//Regist range validator
function addValidatorRange(checkedInputId, minValue, maxValue, errorDivId, validationGroup){
    objValidatorHelper.registrateValidatorData(checkedInputId, errorDivId, validationGroup);
    
    document.getElementById(checkedInputId).onblur = function(){
        objValidatorHelper.checkInputRange(checkedInputId, minValue, maxValue)
    };
}

//Add submit button for validation group and form
function addSubmitButton(sumbitId, validationGroup){
    document.getElementById(sumbitId).onclick = function(){
        objValidatorHelper.isFormValid(validationGroup)
    };
}

function addSubmitEnter(txtId, validationGroup){
    document.getElementById(txtId).onkeypress = function(e){
        if(e.keyCode == 13)
            objValidatorHelper.isFormValid(validationGroup)
    };
}

function validatorHelper(){

    //Initialization of public arrays with data
    this.validationGroupForms = new Array();
    this.validadedForms = new Array();
    this.validationGroupInputs = new Array();
    this.validadedInputs = new Array();
    this.isValidInputs = new Array();
    this.validatorErrorDiv = new Array();
    this.validatorRegExExpression = new Array();
    this.validatorSubmit = new Array();
    
    //public methods
    this.checkInputRegEx = checkInputRegEx;
    this.checkInputRequiredField = checkInputRequiredField;
    this.checkInputCompare = checkInputCompare;
    this.checkInputRange = checkInputRange;
    this.registrateValidatorData = registrateValidatorData;
    this.isFormValid = isFormValid;
    this.getFormByValidationGroup = getFormByValidationGroup;
    this.isValidRegEx = isValidRegEx;
    this.changeParagraph = changeParagraph;
    this.showErrorDiv = showErrorDiv;
    this.autoBlur = autoBlur;
    
}

//Check regex validator
function checkInputRegEx(checkedInputId){

    if (this.isValidRegEx(checkedInputId, this.validatorRegExExpression[checkedInputId])) {
        this.isValidInputs[checkedInputId] = true;
        this.showErrorDiv(false, checkedInputId);
    }
    else {
        this.isValidInputs[checkedInputId] = false;
        this.showErrorDiv(true, checkedInputId);
    }
}

//Check required field
function checkInputRequiredField(checkedInputId){
    var checkedElement = document.getElementById(checkedInputId);
    
    if (checkedElement.value != "") {
        this.isValidInputs[checkedInputId] = true;
        this.showErrorDiv(false, checkedInputId);
    }
    else {
        this.isValidInputs[checkedInputId] = false;
        this.showErrorDiv(true, checkedInputId);
    }
}

//Check compare validator
function checkInputCompare(checkedInputId1, checkedInputId2){
    var checkedElement1 = document.getElementById(checkedInputId1);
    var checkedElement2 = document.getElementById(checkedInputId2);
    
    if (checkedElement1.value == checkedElement2.value) {
        this.isValidInputs[checkedInputId1] = true;
        this.showErrorDiv(false, checkedInputId1);
    }
    else {
        this.isValidInputs[checkedInputId1] = false;
        this.showErrorDiv(true, checkedInputId1);
    }
}

//Check range validator
function checkInputRange(checkedInputId, minValue, maxValue){
    var checkedElement = document.getElementById(checkedInputId);
    
    var min = parseInt(minValue);
    var max = parseInt(maxValue);
    var value = parseInt(checkedElement.value);
    
    if (!isNaN(min) && !isNaN(max) && !isNaN(value)) 
        if (min <= value && max >= value) {
            this.isValidInputs[checkedInputId] = true;
            this.showErrorDiv(false, checkedInputId);
        }
        else {
            this.isValidInputs[checkedInputId] = false;
            this.showErrorDiv(true, checkedInputId);
        }
    else {
        this.isValidInputs[checkedInputId] = false;
        this.showErrorDiv(true, checkedInputId);
    }
}

//Save validation data in arrays
function registrateValidatorData(checkedInputId, errorDivId, validationGroup){
    this.validationGroupInputs[checkedInputId] = validationGroup;
    this.validadedInputs[this.validadedInputs.length] = checkedInputId;
    this.isValidInputs[checkedInputId] = false;
    
    this.validatorErrorDiv[checkedInputId] = errorDivId;
}

//Chech valid of form
function isFormValid(validationGroup){
    var generalCountInValidationGroup = 0;
    var validCountInValidationGroup = 0;
    var checkedInputId = 'none';
    var notValidInputId = 'none';
    
    this.autoBlur(validationGroup);
    
    for (i = 0; i < this.validadedInputs.length; i++) {
        checkedInputId = this.validadedInputs[i];
        if (this.validationGroupInputs[checkedInputId] == validationGroup) {
            generalCountInValidationGroup++;
            
            if (this.isValidInputs[checkedInputId]) 
                validCountInValidationGroup++;
            else 
                notValidInputId = checkedInputId;
        }
    }
    
    if (generalCountInValidationGroup == validCountInValidationGroup) {
        this.showErrorDiv(false, checkedInputId);
        
        if (this.validatorSubmit == false) 
            document.forms[this.getFormByValidationGroup(validationGroup)].submit();
        else 
            document.getElementById(this.getFormByValidationGroup(validationGroup)).click();
        
    }
    else 
        if (notValidInputId != "none") 
            this.showErrorDiv(true, notValidInputId);
}

//Get validation group of form
function getFormByValidationGroup(validationGroup){
    var returnValue = 'none';
    
    for (i = 0; i < this.validadedForms.length; i++) {
        var checkedInputId = this.validadedForms[i];
        if (this.validationGroupForms[checkedInputId] == validationGroup) 
            returnValue = checkedInputId;
    }
    
    return returnValue;
}

//Check regex
function isValidRegEx(checkedInputId, regExStr){
    var returnValue = false;
    
    var re = new RegExp(regExStr);
    
    var checkedElement = document.getElementById(checkedInputId);
    var st = this.changeParagraph(checkedElement.value);
    if (st.match(re)) 
        returnValue = true;
    else 
        returnValue = false;
    
    return returnValue;
}

//Change paragraph
function changeParagraph(text){
    text = text.replace(/(\r\n|\r|\n|\t)/g, ' ');
    
    return text;
}

//Show error div
function showErrorDiv(visible, checkedInputId){
    var errorDivId = this.validatorErrorDiv[checkedInputId];
    var errorDiv = document.getElementById(errorDivId);
    
    if (visible) 
        errorDiv.style.display = "block";
    else 
        errorDiv.style.display = "none";
}

//Auto blur of all valided inputs
function autoBlur(validationGroup){
    for (i = 0; i < this.validadedInputs.length; i++) {
        if (this.validationGroupInputs[this.validadedInputs[i]] == validationGroup) {
            var checkedElement = document.getElementById(this.validadedInputs[i]);
            checkedElement.onblur();
        }
    }
}
