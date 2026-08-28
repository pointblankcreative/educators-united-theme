//this function grabs the target id, which is the row id in the database, which then places the iframe in a target div and hides the thumbnail. We do this because loading all of the iFrames on this page will significantly slow down the page load.

//add event listeners to videos after page loads
window.onload = function() {
    var elements = document.getElementsByClassName("LoadVideo");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', LoadVideo, false);
    }
}

function LoadVideo(){

    //get the row id, this will help find the div we want to alter
    var Target = this.getAttribute("data-target-id");
    var VideoDivID = "VideoID" + Target;

    //get the video iFrame found in data-video
    var VideoDiv = document.getElementById(VideoDivID);
    var iFrameMarkup = VideoDiv.getAttribute("data-video");

    //get iFrame 
    var LastOpenedVideo = document.getElementsByClassName('FindLastOpenedVideo');

    //does class .FindLastOpenedVideo exist?
    if (LastOpenedVideo.length > 0)
    {
        //get the id for the last opened video
        var LastOpenedID = LastOpenedVideo[0].getAttribute('data-target-id');
         
        //bring in data attributes from last opened video
        var LastOpenedDivID = "VideoID" + LastOpenedID;
        var LastOpenedDiv = document.getElementById(LastOpenedDivID);

        var LastOpenedThumbnail = LastOpenedDiv.getAttribute('data-thumbnail');
        var LastOpenedVideoZoomAnimation = LastOpenedDiv.getAttribute('data-zoom-animation');
        var LastOpenedVideoWidth = LastOpenedDiv.getAttribute('data-width');
        var LastOpenedMiddleMarkup = LastOpenedDiv.getAttribute('data-middle-markup');

        //prepare replacement html for video that will be switched to thumbnail
        var ThumbnailHTML = '<div class="middle-section '+ LastOpenedVideoZoomAnimation +'" style="'+ LastOpenedVideoWidth +'"> <a title="Open Video" class="load-video-button" data-target-id="' + LastOpenedDivID + '"> <img class="img-fluid video-thumbnail" style="'+ LastOpenedVideoWidth +'" src="' + LastOpenedThumbnail + '"><div class="videoLink"><span style="user-select: none;">'+ LastOpenedMiddleMarkup +'</span> </div> </a> </div>';

        //remove these classes
        LastOpenedDiv.classList.remove('ratio');
        LastOpenedDiv.classList.remove('ratio-16x9');
        LastOpenedDiv.classList.remove('FindLastOpenedVideo');

        //empty and replace html
        LastOpenedDiv.innerHTML = "";
        LastOpenedDiv.innerHTML = ThumbnailHTML;

    }

    //empty the div, then replace it with the iFrame, then add classes to make iFrame responsive.
    VideoDiv.classList.add("ratio");
    VideoDiv.classList.add("ratio-16x9");
    VideoDiv.innerHTML = "";
    VideoDiv.innerHTML = iFrameMarkup;
    VideoDiv.classList.add("FindLastOpenedVideo");

}