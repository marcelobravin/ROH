<?php
  //echo h1("Ola Mundo!");

  function seletor($regra, $seletor="*"){
    return "
    <style>
      $seletor {
        $regra
      }
    </style>";
  }

  //echo seletor(opacity(0.6));
  function opacity($numero) {
    return "
    -khtml-opacity: $numero; /* Konqueror extension (Safari 1.1) */
      -moz-opacity: $numero; /* Mozilla extension */
           opacity: $numero; /* Android 2.1+, Chrome 4+, Firefox 2+, IE 9+, iOS 3.2+, Opera 9+, Safari 3.1+ */
        -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=". $numero * 100 .")'; /* IE 8 */
            filter: alpha(opacity=50); /* IE 5-7 */
    ";
            //filter: progid:DXImageTransform.Microsoft.Alpha(opacity=". $numero * 100 .");
  }
  
  //echo seletor(gradient("#000000", "#FFFFFF"));
  function gradient($from, $to) {
    return "
    background-color: $from; /* Old browsers */
    background-image: -webkit-gradient(linear, left top, left bottom, from($from), to($to)); /* Chrome, Safari 4+ */
    background-image: -webkit-linear-gradient(top, $from, $to); /* Chrome 10-25, iOS 5+, Safari 5.1+ */
    background-image:    -moz-linear-gradient(top, $from, $to); /* Firefox 3.6-15 */
    background-image:     -ms-linear-gradient(top, $from, $to); /* IE10+ */
    background-image:      -o-linear-gradient(top, $from, $to); /* Opera 11.10-12.00 */
    background-image:         linear-gradient(to bottom, $from, $to); /* Chrome 26, Firefox 16+, IE 10+, Opera 12.10+ */
    
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='$from', endColorstr='$to', GradientType=0); /* IE6-8 */
    ";
    
    /*
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
//background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzFlNTc5OSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iIzI5ODlkOCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iIzIwN2NjYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3ZGI5ZTgiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
//background: -moz-linear-gradient(top, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%); /* FF3.6+ */
//background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(51%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
//background: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
//background: -o-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* Opera 11.10+ */
//background: -ms-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* IE10+ */
//background: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* W3C */

  }
  
  //echo seletor(borderRadius("5px"));
  function borderRadius($radius) {
    return "
    border: 1px solid red;
    -webkit-border-radius: $radius; /* Android ≤ 1.6, iOS 1-3.2, Safari 3-4 */
     -khtml-border-radius: $radius;
       -moz-border-radius: $radius;
            border-radius: $radius; /* Android 2.1+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 5+ */

    /* useful if you don't want a bg color from leaking outside the border: */
    background-clip: padding-box; /* Android 2.2+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 4+ */
    ";
    
  }
  
  
  //echo seletor(textShadow());
  function textShadow($x=0, $y=0, $blur="5px", $cor="#000000") {
    return "
    text-shadow: $x $y $blur $cor; /* Chrome, Firefox 3.5+, IE 10+, Opera 9+, Safari 1+ */
    ";
   /*
  filter:
            progid:DXImageTransform.Microsoft.Glow(Color=#eeeeee,Strength=2)
            progid:DXImageTransform.Microsoft.blur(pixelradius=5, enabled='true')
        ;
        
zoom:1;
filter: progid:DXImageTransform.Microsoft.Glow(Color=#000000,Strength=1);
-ms-filter: "progid:DXImageTransform.Microsoft.dropshadow(OffX=-1, OffY=-1, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=0, OffY=-1, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=1, OffY=-1, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=1, OffY=0, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=1, OffY=1, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=0, OffY=1, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=-1, OffY=1, Color=#000000)
progid:DXImageTransform.Microsoft.dropshadow(OffX=-1, OffY=0, Color=#000000)";
 */
  }
  
  
  //echo seletor(boxShadow("1px", "1px", "5px", "BLACK"));
  //echo seletor(boxShadow("1px", "1px", "5px", "#000000", true));
  function boxShadow($x=0, $y=0, $blur="5px", $cor="#000000", $inset=false) {
    $inset ? $interna="inset" : $interna="";
    return "
    -webkit-box-shadow: $interna $x $y $blur $cor; /* Android 2.3+, iOS 4.0.2-4.2, Safari 3-4 */
       -moz-box-shadow: $interna $x $y $blur $cor;
            box-shadow: $interna $x $y $blur $cor; /* Chrome 6+, Firefox 4+, IE 9+, iOS 5+, Opera */
    -ms-filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='$cor'); /* NÂO FUNFA*/
        filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='$cor');
    ";
    
  }
  
  //echo seletor(transform(90), "h1");
  function transform($rotacao=0, $scale=1, $skew=1, $translate=0) {
  $rotacao = $rotacao . "deg";
  $skew = $skew . "deg";
  $translate = $translate . "px";
    return "
    -webkit-transform: rotate($rotacao) scale($scale) skew($skew) translate($translate); /* Chrome, Safari 3.1+  */
       -moz-transform: rotate($rotacao) scale($scale) skew($skew) translate($translate); /* Firefox 3.5-15  */
        -ms-transform: rotate($rotacao) scale($scale) skew($skew) translate($translate); /* IE 9  */
         -o-transform: rotate($rotacao) scale($scale) skew($skew) translate($translate); /* Opera 10.50-12.00  */
            transform: rotate($rotacao) scale($scale) skew($skew) translate($translate); /* Firefox 16+, IE 10+, Opera 12.10+ */
    ";
  }
  
  
  //echo seletor(skew(90), "h1");
  function skew($skew=1) {
  $skew = $skew . "deg";
    return "
    -webkit-transform: skew($skew); /* Chrome, Safari 3.1+  */
       -moz-transform: skew($skew); /* Firefox 3.5-15  */
        -ms-transform: skew($skew); /* IE 9  */
         -o-transform: skew($skew); /* Opera 10.50-12.00  */
            transform: skew($skew); /* Firefox 16+, IE 10+, Opera 12.10+ */
    ";
  }
  
  //echo seletor(scale(2), "h1");
  function scale($scale=1) {
    return "
    -webkit-transform: scale($scale); /* Chrome, Safari 3.1+  */
       -moz-transform: scale($scale); /* Firefox 3.5-15  */
        -ms-transform: scale($scale); /* IE 9  */
         -o-transform: scale($scale); /* Opera 10.50-12.00  */
            transform: scale($scale); /* Firefox 16+, IE 10+, Opera 12.10+ */
    ";
  }
  
  //echo seletor(rotate(90), "h1");
  function rotate($rotacao=0) {
    $rotacao = $rotacao . "deg";
    return "
    -webkit-transform: rotate($rotacao); /* Chrome, Safari 3.1+  */
       -moz-transform: rotate($rotacao); /* Firefox 3.5-15  */
        -ms-transform: rotate($rotacao); /* IE 9  */
         -o-transform: rotate($rotacao); /* Opera 10.50-12.00  */
            transform: rotate($rotacao); /* Firefox 16+, IE 10+, Opera 12.10+ */
    ";
  }
  
  //echo seletor(rotateX(90), "h1");
  function rotateX($rotacao=0) {
    $rotacao = $rotacao . "deg";
    return "
    -webkit-transform: rotateX($rotacao); /* Chrome, Safari 3.1+  */
       -moz-transform: rotateX($rotacao); /* Firefox 3.5-15  */
        -ms-transform: rotateX($rotacao); /* IE 9  */
         -o-transform: rotateX($rotacao); /* Opera 10.50-12.00  */
            transform: rotateX($rotacao); /* Firefox 16+, IE 10+, Opera 12.10+ */
    ";
  }
  
  //echo seletor(rotateY(90), "h1");
  function rotateY($rotacao=0) {
    $rotacao = $rotacao . "deg";
    return "
    -webkit-transform: rotateY($rotacao); /* Chrome, Safari 3.1+  */
       -moz-transform: rotateY($rotacao); /* Firefox 3.5-15  */
        -ms-transform: rotateY($rotacao); /* IE 9  */
         -o-transform: rotateY($rotacao); /* Opera 10.50-12.00  */
            transform: rotateY($rotacao); /* Firefox 16+, IE 10+, Opera 12.10+ */
    ";
  }
  
  //echo seletor(transition(3, "border"), "h1");
  //echo seletor("color:red", "h1:hover");
  function transition($tempo=1, $propriedade="all", $transitionTiming="ease") {
    $tempo = $tempo . "s";
    return "
    -webkit-transition: $propriedade $tempo $transitionTiming; /* Chrome 1-25, Safari 3.2+ */
       -moz-transition: $propriedade $tempo $transitionTiming; /* Firefox 4-15 */
         -o-transition: $propriedade $tempo $transitionTiming; /* Opera 10.50–12.00 */
            transition: $propriedade $tempo $transitionTiming; /* Chrome 26, Firefox 16+, IE 10+, Opera 12.10+ */
    ";
    // Transition Timing
    //ease-in-out
    //ease-out
    //ease-in
    //ease
    // linear 
  }
  
  //echo seletor(animation("minhaAnimacao"), "h1");
  function animation($animacao, $tempo=1, $repeticao="infinite", $transitionTiming="ease") {
    $tempo = $tempo . "s";
    return "
    -webkit-animation: $animacao $tempo $repeticao $transitionTiming; /* Chrome, Safari 5+ */
       -moz-animation: $animacao $tempo $repeticao $transitionTiming; /* Firefox 5-15 */
         -o-animation: $animacao $tempo $repeticao $transitionTiming; /* Opera 12.00 */
            animation: $animacao $tempo $repeticao $transitionTiming; /* Chrome, Firefox 16+, IE 10+, Opera 12.10+ */
    ";
    // Transition Timing
    //ease-in-out
    //ease-out
    //ease-in
    //ease
    // linear
  }
  
  /*
  //$animacao = array(0=>"color: red", 50=>"color: lime", 100=>"color: blue");
  $animacao = array("font-size: 10px", "font-size: 20px");
  echo "<style>
    h1 { -moz-animation: minhaAnimacao 1s infinite; }";
  echo keyframes("minhaAnimacao", $animacao);
  echo "</style>";
  */
  function keyframes($animacao, $frames=array()) {
    $resposta="";
    
    if (sizeof($frames) == 2) {
      $resposta .= "from {". reset($frames) ." }\n ";
      $resposta .= "to {". end($frames) ." }\n ";
    } else {
      foreach ($frames as $indice=>$valor) {
        $resposta .= $indice ."% {". $valor ."; }\n ";
      }
    }
    
    return "
      @-webkit-keyframes $animacao { $resposta }
         @-moz-keyframes $animacao { $resposta }
           @-o-keyframes $animacao { $resposta }
              @keyframes $animacao { $resposta }
    ";
  }
  
  
  //echo seletor(perspective(), "h1");
  function perspective() {
    return "
      -webkit-perspective: 300px;  /* Chrome 12+, Safari 4+ */
         -moz-perspective: 300px;  /* Firefox 10+ */
          -ms-perspective: 300px;  /* IE 10 */
              perspective: 300px;
    ";
  }

  //echo seletor(preserve3d(), "h1");
  function preserve3d() {
    return "
     -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
         -ms-transform-style: preserve-3d;
             transform-style: preserve-3d;
    ";
  }
  
  
  
  
  
    function fontFace($fonte) {
        return "
            @font-face {
                font-family: '{$fonte} Regular';
                src: url('{$fonte}.eot');
                src: local('{$fonte} Regular'), 
                    local('{$fonte}'), 
                    url('{$fonte}.ttf') format('truetype'),
                    url('{$fonte}.svg#font') format('svg'); 
            }
            
            
            body {
                font-family: '{$fonte} Regular', Helvetica, Arial, sans-serif;
            }
        ";
    }
  


/*
@font-face {
  font-family: 'WebFont';
  src: url('myfont.woff') format('woff'), // Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+
       url('myfont.ttf') format('truetype'); // Chrome 4+, Firefox 3.5, Opera 10+, Safari 3—5
       
       
  src:url('font/fontawesome-webfont.eot?v=3.2.1');
  src:url('font/fontawesome-webfont.eot?#iefix&v=3.2.1') format('embedded-opentype'),
      url('font/fontawesome-webfont.woff?v=3.2.1') format('woff'),
      url('font/fontawesome-webfont.ttf?v=3.2.1') format('truetype'),
      url('font/fontawesome-webfont.svg#fontawesomeregular?v=3.2.1') format('svg');
       
}



.box_rgba {
  background-color: transparent;
  background-color: rgba(180, 180, 144, 0.6);  // Chrome, Firefox 3+, IE 9+, Opera 10.10+, Safari 3+ 
}

.box_3dtransforms {
  
}

* {
  -webkit-box-sizing: border-box; // Android ≤ 2.3, iOS ≤ 4
     -moz-box-sizing: border-box; // Firefox 1+
          box-sizing: border-box; // Chrome, IE 8+, Opera, Safari 5.1
}

.box_columns {
  -webkit-column-count: 2;  -webkit-column-gap: 15px; // Chrome, Safari 3 
     -moz-column-count: 2;     -moz-column-gap: 15px; // Firefox 3.5+ 
          column-count: 2;          column-gap: 15px; // Opera 11+ 
}

.box_bgsize {
  -webkit-background-size: 100% 100%; // Safari 3-4
          background-size: 100% 100%; // Chrome, Firefox 4+, IE 9+, Opera, Safari 5+
}

.box_tabsize {
  -moz-tab-size: 2; // Firefox 4+
    -o-tab-size: 2; // Opera 10.60+
       tab-size: 2;
}
*/