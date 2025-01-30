<div class="loader-container">
    <div class="loader">
      <div class="india-map"><img src="{{asset('assets/images/naksha.jpg')}}" alt="" height="40" width="40"> </div> 
      <div class="farmer"></div> 
      <div class="text">Loading...</div>
    </div>
  </div>
<style>
 /* Loader container */
.loader-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  overflow: hidden;
  opacity: 1;
  visibility: visible;
  animation: fadeOut 2s 1s forwards; /* Fade out after 1 second */
}

/* Loader styles */
.loader {
  text-align: center;
  animation: fadeIn 1.5s ease-in-out infinite;
}

/* India map animation (using a circle as placeholder) */
.india-map {
  width: 80px;
  height: 80px;
  border: 2px solid #138808;
  border-radius: 50%;
  margin: 20px auto;
  position: relative;
  animation: rotateMap 3s infinite linear;
}

/* Rotate India map */
@keyframes rotateMap {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/* Farmer animation (pulse effect) */
.farmer {
  width: 40px;
  height: 40px;
  background-color: #FF9933; /* Saffron color */
  border-radius: 50%;
  margin: 10px auto;
  position: relative;
  animation: pulseFarmer 1.5s ease-in-out infinite;
}

/* Pulse effect for farmer */
@keyframes pulseFarmer {
  0% {
    transform: scale(1);
    opacity: 0.6;
  }
  50% {
    transform: scale(1.2);
    opacity: 1;
  }
  100% {
    transform: scale(1);
    opacity: 0.6;
  }
}

/* Text under the animation */
.text {
  font-size: 18px;
  color: #138808; /* Green color */
  margin-top: 15px;
  font-weight: bold;
}

/* FadeOut effect for loader container */
@keyframes fadeOut {
  0% {
    opacity: 1;
    visibility: visible;
  }
  100% {
    opacity: 0;
    visibility: hidden;
  }
}


</style>  