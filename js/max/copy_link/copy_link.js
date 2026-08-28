/*
The purpose of this JS Function is to copy the link from the copy button and paste it onto the visitors clipboad
*/
function isCopying(string) 
{ 

    var textarea, result;
    try 
    {
        textarea = document.createElement('textarea');
        textarea.setAttribute('readonly', true);
        textarea.setAttribute('contenteditable', true);
        textarea.style.position = 'fixed'; 
        textarea.value = string;

        document.body.appendChild(textarea);

        textarea.select();

        var range = document.createRange();
        range.selectNodeContents(textarea);

        var selectedText = window.getSelection();
        selectedText.removeAllRanges();
        selectedText.addRange(range);

        textarea.setSelectionRange(0, textarea.value.length);
        result = document.execCommand('copy');
    } 
    catch (err)  
    {
        console.error(err);
        result = null;
    } 
    finally 
    {
        document.body.removeChild(textarea);
    }
    // manual copy fallback using prompt
    if (!result) 
    {
        result = prompt("Copy the link", string); 
        if (!result) 
        {
            return false;
        }
    }
    return true;
}

function showToastBox (message) 
{
    var myModal = new bootstrap.Modal(document.getElementById("CopyModal"), {});
    var Modal = document.getElementById("CopyModal");
    var modalBody = Modal.querySelector('.modal-body')
    modalBody.textContent = message;
    myModal.show();

}
function handleCopyIconClick() 
{
    var pageUrl= this.getAttribute('data-url');
    
    showToastBox(isCopying(pageUrl) ? "Link copied to clipboard." : "Unable to copy.");
    
    
} 
document.addEventListener('DOMContentLoaded', function(event) {
    var copyIcon = document.getElementsByClassName("Copy");
    for (var i = 0; i < copyIcon.length; i++) {
        copyIcon[i].addEventListener('click', handleCopyIconClick, false);
    }
});