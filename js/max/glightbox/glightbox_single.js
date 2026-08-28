function SingleGlightboxImage() {
  var lightbox = GLightbox();
  var allLightboxTriggers = document.querySelectorAll(".lightbox-trigger");

  if (allLightboxTriggers) {
    allLightboxTriggers.forEach(function (trigger) {
      trigger.addEventListener("click", function (e) {
        e.preventDefault();
        var targetHref = this.getAttribute("href");
        lightbox.setElements([
          {
            href: targetHref
          }
        ]);
        lightbox.open();
      });
    });
  }
};
window.onload = SingleGlightboxImage;