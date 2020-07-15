toDate = new Date("Feb 27, 2020").getTime();
x = setInterval(function () {
  var frameSvg = document.getElementById("frameSvg").contentDocument;
  var countdownText = frameSvg.getElementById("countdownText");
  var now = new Date().getTime();
  var distance = toDate - now;
  var seconds = Math.floor((distance / 1000) % 60);
  var minutes = Math.floor((distance / 1000 / 60) % 60);
  var hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
  var days = Math.floor(distance / (1000 * 60 * 60 * 24) % 30);
  var months = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
  var finalTime = months + " : " + days + " : " + hours + " : " + minutes + " : " + seconds;
  countdownText.textContent = finalTime.toString();
}, 1000);