var validationGroupForms = new Array();
var validadedForms = new Array();

var validationGroupInputs = new Array();
var validadedInputs = new Array();
var isValidInputs = new Array();

var validatorErrorDiv = new Array();

function addForm(formId, validationGroup)
{
document.forms[formId].setAttribute("onsubmit", "return false");

validationGroupForms[formId] = validationGroup;
validadedForms[validadedForms.length] = formId;   

}

function addValidatorRegEx(checkedInputId, errorDivId, regExStr, validationGroup)
{
   document.getElementById(checkedInputId).setAttribute("onblur", "checkInputRegEx('" + checkedInputId + "', '" + regExStr + "');");
   
   validationGroupInputs[checkedInputId] = validationGroup;
   validadedInputs[validadedInputs.length] = checkedInputId;   
   isValidInputs[checkedInputId] = false;
   
   validatorErrorDiv[checkedInputId] = errorDivId;
}

function addValidatorRequiredField(checkedInputId, errorDivId, validationGroup)
{
   document.getElementById(checkedInputId).setAttribute("onblur", "checkInputRequiredField('" + checkedInputId + "');");
   
   validationGroupInputs[checkedInputId] = validationGroup;
   validadedInputs[validadedInputs.length] = checkedInputId;   
   isValidInputs[checkedInputId] = false;
   
   validatorErrorDiv[checkedInputId] = errorDivId;
}

function addValidatorCompare(checkedInputId1, checkedInputId2, errorDivId, validationGroup)
{
   document.getElementById(checkedInputId1).setAttribute("onblur", "checkInputCompare('" + checkedInputId1 + "', '" + checkedInputId2 + "');");
   document.getElementById(checkedInputId2).setAttribute("onblur", "checkInputCompare('" + checkedInputId1 + "', '" + checkedInputId2 + "');");
      
   validationGroupInputs[checkedInputId1] = validationGroup;
   validadedInputs[validadedInputs.length] = checkedInputId1;   
   isValidInputs[checkedInputId1] = false;
   
   validatorErrorDiv[checkedInputId1] = errorDivId;
   
   validationGroupInputs[checkedInputId2] = validationGroup;
   validadedInputs[validadedInputs.length] = checkedInputId2;   
   isValidInputs[checkedInputId2] = false;
   
   validatorErrorDiv[checkedInputId2] = errorDivId;
}

function addSubmitButton(sumbitId, validationGroup)
{
   document.getElementById(sumbitId).setAttribute("onclick", "isFormValid('" + validationGroup + "');");
}

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

function checkInputRegEx(checkedInputId, regExStr)
{

    if(isValidRegEx(checkedInputId, regExStr))
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

function checkInputCompare(checkedInputId1, checkedInputId2)
{
    var checkedElement1 = document.getElementById(checkedInputId1);
    var checkedElement2 = document.getElementById(checkedInputId2);

    if(checkedElement1.value == checkedElement2.value)
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

function showErrorDiv(visible, checkedInputId)
{
            var errorDivId = validatorErrorDiv[checkedInputId];
            var errorDiv = document.getElementById(errorDivId);
            
            if(visible)
                errorDiv.style.display="block";
            else
                errorDiv.style.display="none";
}