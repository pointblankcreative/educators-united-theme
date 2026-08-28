document.addEventListener("DOMContentLoaded", function() {
    CheckStatus();
});

function SetHeight(){
    var WindowWidth = window.innerWidth;

    var ContainerBlock = document.getElementsByClassName('ContainerBlock');
    //console.log(WindowWidth)
    if(ContainerBlock.length > 0){
        
        if(WindowWidth > 767){
            
            var PageWidget = document.getElementById("Form").offsetHeight;

            //-80 for padding + 100 for negative margin
            PageWidget = PageWidget - 100;

            ContainerBlock[0].style.minHeight = PageWidget + "px";

        }
        else{
            ContainerBlock[0].style.minHeight = 100 + "%";
        }
    }

}

function delay() {
    setTimeout(function() {
        CheckStatus();
    }, 200);
}

var Form = document.getElementById("Form");
new ResizeObserver(() => delay()).observe(Form);

function CheckStatus(){

    if(document.readyState != "interactive"){
        SetHeight();
    } else {
        delay();
    }

} 