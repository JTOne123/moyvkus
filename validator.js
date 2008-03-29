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

//Add regist of validation group and form
function addForm(formId, validationGroup)
{
document.forms[formId].setAttribute("onsubmit", "return false");

validationGroupForms[formId] = validationGroup;
validadedForms[validadedForms.length] = formId;   

}

//Regist regex validator
function addValidatorRegEx(checkedInputId, errorDivId, regExStr, validationGroup)
{
   document.getElementById(checkedInputId).setAttribute("onblur", "checkInputRegEx('" + checkedInputId + "');");
   
   validatorRegExExpression[checkedInputId] = regExStr;
   
   registrateValidatorData(checkedInputId, errorDivId, validationGroup);
}

//Regist required field validator
function addValidatorRequiredField(checkedInputId, errorDivId, validationGroup)
{
   document.getElementById(checkedInputId).setAttribute("onblur", "checkInputRequiredField('" + checkedInputId + "');");
   
   registrateValidatorData(checkedInputId, errorDivId, validationGroup);
}

//Regist compare validator
function addValidatorCompare(checkedInputId1, checkedInputId2, errorDivId, validationGroup)
{
   document.getElementById(checkedInputId1).setAttribute("onblur", "checkInputCompare('" + checkedInputId1 + "', '" + checkedInputId2 + "');");
   document.getElementById(checkedInputId2).setAttribute("onblur", "checkInputCompare('" + checkedInputId1 + "', '" + checkedInputId2 + "');");
      
   registrateValidatorData(checkedInputId1, errorDivId, validationGroup);
   registrateValidatorData(checkedInputId2, errorDivId, validationGroup);
}

//Regist range validator
function addValidatorRange(checkedInputId, minValue, maxValue, errorDivId, validationGroup)
{
   document.getElementById(checkedInputId).setAttribute("onblur", "checkInputRange('" + checkedInputId + "', '" + minValue + "', '" + maxValue + "');");
      
   registrateValidatorData(checkedInputId, errorDivId, validationGroup);
}

//Add submit button for validation group and form
function addSubmitButton(sumbitId, validationGroup)
{
   document.getElementById(sumbitId).setAttribute("onclick", "isFormValid('" + validationGroup + "');");
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

    if(checkedElement1.value == checkedElement2.value && checkedElement1.value != "")
        {
            isValidInputs[checkedInputId1] = true;
            isValidInputs[checkedInputId2] = true;
            showErrorDiv(false, checkedInputId1);
        }
    else
        {
            isValidInputs[checkedInputId1] = false;
            isValidInputs[checkedInputId2] = false;
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

    for (i=0;i<validadedInputs.length;i++)
        {
        checkedInputId = validadedInputs[i];
            if(validationGroupInputs[checkedInputId] == validationGroup)
                {
                    generalCountInValidationGroup++;

                    if(isValidInputs[checkedInputId])
                        validCountInValidationGroup++;
                }
        }

     if(generalCountInValidationGroup == validCountInValidationGroup)
        {
        showErrorDiv(false, checkedInputId);           
        document.forms[getFormByValidationGroup(validationGroup)].submit();
        }
     else
        if(checkedInputId != "none")
                showErrorDiv(true, checkedInputId);
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