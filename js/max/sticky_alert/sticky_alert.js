document.addEventListener('DOMContentLoaded', function () {

    var form = document.getElementById('Form');
    var alertBar = document.getElementById('CTAStickyButtonAlert');
    var buttons = document.querySelectorAll('#StickyAlertButton');

    if (!form || !alertBar || !buttons.length) return;

    // Smooth scroll on button click
    buttons.forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            form.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Watch when the form enters/leaves the viewport
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                //console.log("in view")
                alertBar.classList.remove('Active');
            } else {
                //console.log("Not in view")
                alertBar.classList.add('Active');
            }
        });
    }, {
        threshold: 0.25 // adjust if needed (25% visible)
    });

    observer.observe(form);

});