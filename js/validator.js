/****************************************

   JavaScript client validators
   (c) Paul D. 2008
   jthotbox@gmail.com
   http://jthotblog.blogspot.com/

****************************************/

//Initialization of arrays with data
var validationGroupForms = new Array();
var validadedForms = new Array();

var validationGroupInputs = new Array();
var validadedInputs = new Array();
var isValidInputs = new Array();

var validatorErrorDiv = new Array();

var validatorRegExExpression = new Array();

var validatorSubmit = false;

//Add regist of validation group and form
function addForm(formId, validationGroup)
{
    validationGroupForms[formId] = validationGroup;
    validadedForms[validadedForms.length] = formId;
    
    receivedElement = document.getElementById(formId);
    receivedElement.onsubmit = function(){return false};
    
    validatorSubmit = false;
}
function addButton(formId, validationGroup)
{
    validationGroupForms[formId] = validationGroup;
    validadedForms[validadedForms.length] = formId;
    
    receivedElement = document.getElementById(formId);
    receivedElement.onsubmit = function(){return false};
    
    validatorSubmit = true;
}

//Regist regex validator
function addValidatorRegEx(checkedInputId, errorDivId, regExStr, validationGroup)
{
   validatorRegExExpression[checkedInputId] = regExStr;
   registrateValidatorData(checkedInputId, errorDivId, validationGroup);

   receivedElement = document.getElementById(checkedInputId);
   receivedElement.onblur = function(){checkInputRegEx(checkedInputId)};
        
}

//Regist required field validator
function addValidatorRequiredField(checkedInputId, errorDivId, validationGroup)
{  
   registrateValidatorData(checkedInputId, errorDivId, validationGroup);
   
   receivedElement = document.getElementById(checkedInputId);
   receivedElement.onblur = function(){checkInputRequiredField(checkedInputId)};
}

//Regist compare validator
function addValidatorCompare(checkedInputId1, checkedInputId2, errorDivId, validationGroup)
{
   registrateValidatorData(checkedInputId1, errorDivId, validationGroup);
   
   receivedElement = document.getElementById(checkedInputId1);
   receivedElement.onblur = function(){checkInputCompare(checkedInputId1, checkedInputId2)};
}

//Regist range validator
function addValidatorRange(checkedInputId, minValue, maxValue, errorDivId, validationGroup)
{      
   registrateValidatorData(checkedInputId, errorDivId, validationGroup);
   
   receivedElement = document.getElementById(checkedInputId);
   receivedElement.onblur = function(){checkInputRange(checkedInputId, minValue, maxValue)};
}

//Add submit button for validation group and form
function addSubmitButton(sumbitId, validationGroup)
{
    receivedElement = document.getElementById(sumbitId);
    receivedElement.onclick = function(){isFormValid(validationGroup)};
}

//Check regex validator
function checkInputRegEx(checkedInputId)
{

    if(isValidRegEx(checkedInputId, validatorRegExExpression[checkedInputId]))
        {
            isValidInputs[checkedInputId] = true;
            showErrorDiv(false, checkedInputId);
        }
    else
        {
            isValidInputs[checkedInputId] = false;
            showErrorDiv(true, checkedInputId);
        }
}

//Check required field
function checkInputRequiredField(checkedInputId)
{
    var checkedElement = document.getElementById(checkedInputId);

    if(checkedElement.value != "")
        {
            isValidInputs[checkedInputId] = true;
            showErrorDiv(false, checkedInputId);
        }
    else
        {
            isValidInputs[checkedInputId] = false;
            showErrorDiv(true, checkedInputId);
        }
}       

//Check compare validator
function checkInputCompare(checkedInputId1, checkedInputId2)
{
    var checkedElement1 = document.getElementById(checkedInputId1);
    var checkedElement2 = document.getElementById(checkedInputId2);

    if(checkedElement1.value == checkedElement2.value)
        {
            isValidInputs[checkedInputId1] = true;
            showErrorDiv(false, checkedInputId1);
        }
    else
        {
            isValidInputs[checkedInputId1] = false;
            showErrorDiv(true, checkedInputId1);
        }
}        

//Check range validator
function checkInputRange(checkedInputId, minValue, maxValue)
{
    var checkedElement = document.getElementById(checkedInputId);

    var min = parseInt(minValue);
    var max = parseInt(maxValue);
    var value = parseInt(checkedElement.value);
    
    if(!isNaN(min) && !isNaN(max) && !isNaN(value))
        if(min <= value && max >= value)
            {
                isValidInputs[checkedInputId] = true;
                showErrorDiv(false, checkedInputId);
            }
        else
            {
                isValidInputs[checkedInputId] = false;
                showErrorDiv(true, checkedInputId);
            }
    else
        {
            isValidInputs[checkedInputId] = false;
            showErrorDiv(true, checkedInputId);
        }
}    

//Save validation data in arrays
function registrateValidatorData(checkedInputId, errorDivId, validationGroup)
{
   validationGroupInputs[checkedInputId] = validationGroup;
   validadedInputs[validadedInputs.length] = checkedInputId;   
   isValidInputs[checkedInputId] = false;
   
   validatorErrorDiv[checkedInputId] = errorDivId;
}

//Chech valid of form
function isFormValid(validationGroup)
{
    var generalCountInValidationGroup = 0;
    var validCountInValidationGroup = 0;
    var checkedInputId = "none";    
    var notValidInputId = "none";

    autoBlur();
    
    for (i=0;i<validadedInputs.length;i++)
        {
        checkedInputId = validadedInputs[i];
            if(validationGroupInputs[checkedInputId] == validationGroup)
                {
                    generalCountInValidationGroup++;

                    if(isValidInputs[checkedInputId])
                        validCountInValidationGroup++;
                    else
                        notValidInputId = checkedInputId;
                }
        }

     if(generalCountInValidationGroup == validCountInValidationGroup)
        {
        showErrorDiv(false, checkedInputId);
        
        if(validatorSubmit==false)           
            document.forms[getFormByValidationGroup(validationGroup)].submit();
        else
            document.getElementById(getFormByValidationGroup(validationGroup)).click();
        
        }
     else
        if(notValidInputId != "none")
                showErrorDiv(true, notValidInputId);
}

//Get validation group of form
function getFormByValidationGroup(validationGroup)
{
    var returnValue = "none";
    
    for (i=0;i<validadedForms.length;i++)
        {
        var checkedInputId = validadedForms[i];
            if(validationGroupForms[checkedInputId] == validationGroup)
                returnValue = checkedInputId;
        }
        
    return returnValue;
}

//Check regex
function isValidRegEx(checkedInputId, regExStr)
{
    var returnValue = false;

    var re = new RegExp(regExStr);

    var checkedElement = document.getElementById(checkedInputId);

    if(checkedElement.value.match(re))
        returnValue = true;
    else
        returnValue = false;
        
    return returnValue;
}

//Show error div
function showErrorDiv(visible, checkedInputId)
{
            var errorDivId = validatorErrorDiv[checkedInputId];
            var errorDiv = document.getElementById(errorDivId);
            
            if(visible)
                errorDiv.style.display="block";
            else
                errorDiv.style.display="none";
}

//Auto blur of all valided inputs
function autoBlur()
{
    for(i=0;i<validadedInputs.length;i++)
        {
           var checkedElement = document.getElementById(validadedInputs[i]);
           checkedElement.onblur(); 
        }
}