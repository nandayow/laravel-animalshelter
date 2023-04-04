 
<!-- The video -->
<video autoplay muted loop id="myVideo">
  <source src="https://ak.picdn.net/shutterstock/videos/1044063706/preview/stock-footage-page-not-found-error-animation-funny-at-in-a-box.webm" type="video/mp4">
</video>

<!-- Optional: some overlay text to describe the video -->
<div class="content">
  <h1>Solleza's Anishelter</h1>
  <p>“Until one has loved an animal, a part of one's soul remains unawakened.”</p>
  <!-- Use a button to pause/play the video with JavaScript -->
 
</div>

<style >
    /* Style the video: 100% width and height to cover the entire window */
#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%;
  min-height: 10%;
}

/* Add some content at the bottom of the video/page */
.content {
  position: fixed;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}

/* Style the button used to pause/play the video */
#myBtn {
  width: 200px;
  font-size: 18px;
  padding: 10px;
  border: none;
  background: #000;
  color: #fff;
  cursor: pointer;
}

#myBtn:hover {
  background: #ddd;
  color: black;
}
</style>
 