<?php
/**
 * Cria uma função ajax
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @param   string
 * @return  string
 *
 * @example
    echo script();
    $j = jquery();
    echo ajaxTOP("pagina.php", "id:1", "alert('sucesso');", "alert('fail');", "alert('always');")
 * @todo
    parametros: string / array
 */
function ajax($url="ajax.php", $parametros="id: 1", $done="alert('Sucesso!\n' + data);", $fail="alert('Falha na requisição: ' + textStatus);", $always="alert('Concluído');") {

  #data: $("#formNewsLetter").serialize(), dataType: 'json',
  return "
    var request = $.ajax({
        type: 'GET',
        url: '$url',
        dataType: 'html',
        data: {
          $parametros
        },
        beforeSend: function(xhr) {
            //alert('Iniciando processo...');
            xhr.overrideMimeType('text/plain; charset=x-user-defined');
            //xhr.overrideMimeType('text/plain; charset=us-ascii');
            $('body').append('<div id='ajaxLoader' style='background: url('http://mshtravels.com/images/ajax_loading.gif\') no-repeat fixed center center #000000; cursor: pointer; display: block; height: 100%; opacity: 0.7; left: 0; position: fixed; top: 0; width: 100%; z-index: 1100;' />');
        }
    });

    request.done(function(data) {
        $done
    });

    request.fail(function(jqXHR, textStatus) {
        $fail
    });

    request.always(function() {
        $('#ajaxLoader').remove();
        $always
    });
  ";
}

/**
 * Cria script do Google Analytics
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @param   string
 * @return  string
 */
function analytics($id="UA-47877077-1") {
  return "
    <script type='text/javascript'>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '$id']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();
    </script>
  ";
}

/**
 * Gera abertura e fechamento de scripts jQuery
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @return  string
 *
 * @example
    $j = documentReady();
    echo $j[0] ."alert(1);". $j[1];
 */
function documentReady() {
  $jquery = array();
  $jquery[] = "<script>";
  $jquery[0] .= "//<!-- to hide script contents from old browsers\n";
  $jquery[0] .= "$(document).ready(function(){";
  $jquery[] = "});";
  $jquery[1] .= "// end hiding contents from old browsers  -->";
  $jquery[1] .= "</script>";
  return $jquery;
}

/**
 * Gera evento jquery
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @param   string
 * @param   string: click, submit, mouseenter, mouseleave, blur, dblclick, change, keydown, keypress, keyup, mousedown, mousemove, mouseout, mouseover, mouseup
 * @param   string: on, delegate, live, bind
 * @return  array
 *
 * @example
 */
function evento($seletor="document", $evento="ready", $handler="") {

  // Abertura
  if (empty($handler)) {
    //$retorno[] = "$('$seletor').$evento(function(){";
    $retorno[] = "$('$seletor').$evento(function(event){";
  } else {
    //$retorno[] = "$('$seletor').$handler('$evento', function(){";
    $retorno[] = "$('$seletor').$handler('$evento', function(event){";
  }

  //Fechamento
  $retorno[] = "});";
  return $retorno;
}

/**
 * Cria um link para uma janela popup
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @param   string
 * @return  string
 */
function popup($pagina) {
  return "
  <a onclick=\"Popup=window.open(this.href,'Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=720,height=600,left=430,top=23'); return false;\" href=\"{$pagina}\">
    pop up
  </a>";
}

/**
 * Gera evento window.load
 * @package grimoire/bibliotecas/javascript.php
 * @version 05-07-2015
 *
 * @return  string
 */
function windowLoad() {
  $jquery = array();
  $jquery[] = "<script>";
  $jquery[0] .= "//<!-- to hide script contents from old browsers\n";
  $jquery[0] .= "$(window).load(function(){";
  $jquery[] = "});";
  $jquery[1] .= "// end hiding contents from old browsers  -->";
  $jquery[1] .= "</script>";
  return $jquery;
}
