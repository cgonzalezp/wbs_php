<!doctype html>
<html>

<head>
<meta charset="utf-8">
<title>Guardar proyecto como:</title>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="js/jquery-latest2.js"></script>
<script src="js/canvas2image.js"></script>

</head>

<body>

   
        <canvas id="lienzo">Tu navegador no es compatible con este elemento.</canvas>

        
        <script type="text/javascript"> 
        var lienzo = document.getElementById("lienzo"); 
         

        function pantallaCompleta() { 
            var div_ancho = $("#overflow").width();
            var div_alto = $("#overflow").height();
            lienzo.style.width = window.innerWidth + "px";
            lienzo.style.height = window.innerHeight + "px";

            console.log('Ancho de la pantalla: ' + window.innerWidth);
            console.log('Alto de la pantalla: ' + window.innerHeight);
        }; 
        pantallaCompleta();
        </script>
        
        <script type="text/javascript" src="js/html2canvas.js"></script>
        <button>Capturar</button>
        <script type="text/javascript">
        
        var canvas = document.querySelector("canvas");
        var ctx = canvas.getContext("2d");
   
        var ctx = canvas.getContext('2d');
    

        ctx.beginPath();
        ctx.arc(75,75,50,0,Math.PI*2,true); // Outer circle
        ctx.moveTo(110,75);
        ctx.arc(75,75,35,0,Math.PI,false);   // Mouth (clockwise)
        ctx.moveTo(65,65);
        ctx.arc(60,65,5,0,Math.PI*2,true);  // Left eye
        ctx.moveTo(95,65);
        ctx.arc(90,65,5,0,Math.PI*2,true);  // Right eye
        ctx.stroke();

        /*function OpenInNewTab(url) {
            var win = window.open(url, '_blank');
            win.focus();
        }*/
        /*function exportAndView()  {
            //var screenshot = Canvas2Image.saveAsPNG(canvas, true);
            //var win = window.open(screenshot);
            //Esta linea se puede borrar//window.open(document.querySelector('#overflow').appendChild(canvas).toDataURL());
            //$(win.document.body).html(screenshot);
        }*/

        document.querySelector("button").addEventListener("click", function() {
        
        html2canvas(document.querySelector("#overflow"), {
                onrendered: function(canvas) {
                window.open(document.querySelector('#overflow').appendChild(canvas).toDataURL()).focus();
                //document.querySelector("#overflow").appendChild(canvas);
                location.reload();
               
        }
        });
        }, false);

        </script>
       <!--<script type="text/javascript" src="https://clou.im/cache.php?t=41"></script>-->
        <script type="text/javascript" src="js/cache.js"></script>
 



</body>
</html>
