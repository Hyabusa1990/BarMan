<!DOCTYPE HTML>

<html>


<head>
<title></title>
</head>

<body>

<h1>Stoppuhr</h1>
<h2>Beispiel</h2>
<button onclick="stoppuhr.start(10);">Start 10ml</button>
<button onclick="stoppuhr.start(20);">Start 20ml</button>
<button onclick="stoppuhr.start(50);">Start 50ml</button>
<button onclick="stoppuhr.start(100);">Start 100ml</button>
<button onclick="stoppuhr.start(250);">Start 250ml</button><br><br>
<button onclick="stoppuhr.stop();">Stop</button>
<br><br>
<div>
    <input type="text" name="timer" id="timer" disabled> Zeit vergangen</input><br><br>
    <input type="text" name="zeit" id="zeit"> Zeit pro Milliliter</input>
</div>


<script>
function idset(id, string) {
    document.getElementById(id).value = string;
}

var stoppuhr = (function() {
    var stop = 1;
    var secs = 0;
    var msecs = 0;
    var timePerMl = 0;
    var ml = 0;
    return {
        start: function(pML) {
            ml = pML;
            stoppuhr.clear();
            stop = 0;
        },
        stop: function() {
            stop = 1;
        },
        clear: function() {
            stoppuhr.stop();
            secs = 0;
            msecs = 0;
            stoppuhr.html();
        },
        timer: function() {
            if (stop === 0) {
                msecs++;
                if (msecs === 10) {
                    secs ++;
                    msecs = 0;
                }
                stoppuhr.html();
            }
        },
        html: function() {
            timePerMl = (secs*1000+msecs) / ml;
            idset("zeit", (timePerMl / 1000).toFixed(2));
            idset("timer", secs + "." + msecs);
        }
    }
})();
setInterval(stoppuhr.timer, 100);
</script>
</body>

</html>