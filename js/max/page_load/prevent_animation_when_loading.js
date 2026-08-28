//this js will remove the preload css class that prevents animations. without it, items with css animations will animate in.
window.addEventListener('load', () => {

    document.body.classList.remove("preload");

}); 