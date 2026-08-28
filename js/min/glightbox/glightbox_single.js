function SingleGlightboxImage(){var t=GLightbox(),e=document.querySelectorAll(".lightbox-trigger");e&&e.forEach(function(e){e.addEventListener("click",function(e){e.preventDefault();e=this.getAttribute("href");t.setElements([{href:e}]),t.open()})})}window.onload=SingleGlightboxImage;
//# sourceMappingURL=glightbox_single.js.map
