<?php
/**
 * Funções para lojas virtuais !
 * @package grimoire/bliblioteca/opcionais
*/

/**
 * Retorna o preço do frete
 *
 * @param   string
 * @param   double
 * @param   int
 * @return  array
 *
 * @uses    configuracoes.php->CEP_ORIGEM
 * @uses    http://www.e-assishost.com.br/frete.php
 */
// function busca_frete($cd, $peso_total, $tipo_entrega=0, $valordeclarado) {
function busca_frete($cd, $peso_total, $tipo_entrega=0) {
  $co = CEP_ORIGEM; // cep origem
  $auth = "eb85c81828685d38095962de4fb459fd";
  $resultado = @file_get_contents("http://www.e-assishost.com.br/frete.php?tipo_entrega=$tipo_entrega&auth=$auth&co=$co&cd=$cd&peso_total=$peso_total");
  parse_str($resultado, $retorno);
  $resultadofrete = $retorno['valorfrete'];

  return $resultadofrete;
}

/**
 * Retorna o prazo de entrega
 *
 * @param   string
 * @param   double
 * @param   int
 * @return  string
 *
 * @uses    configuracoes.php->CEP_ORIGEM()
 * @uses    http://www.e-assishost.com.br/prazo.php
 */
function busca_prazo($cd, $peso_total, $tipo_entrega) {
  $co = CEP_ORIGEM; // cep origem
  $auth="84d4f1ba60d4dbb0f69a7d56f39fea5a";
  $resultado = @file_get_contents("http://www.e-assishost.com.br/prazo.php?tipo_entrega=$tipo_entrega&auth=$auth&co=$co&cd=$cd&peso_total=$peso_total");
  parse_str($resultado, $retorno);
  $resultadoprazo = $retorno['prazoentrega'];

  return $resultadoprazo;
}

function calcula_frete($servico,$cep_origem,$cep_destino,$peso,$mao_propria,$valor_declarado,$aviso_recebimento, $comprimento, $altura, $largura, $diametro){

  $mao_propria = (strtolower($mao_propria) == 's') ? 's' : 'n';
  $aviso_recebimento = (strtolower($aviso_recebimento) == 's') ? 's' : 'n';

  $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem='. $cep_origem .'&sCepDestino='. $cep_destino .'&nVlPeso='. $peso .'&nCdFormato=1&nVlComprimento='. $comprimento .'&nVlAltura='. $altura .'&nVlLargura='. $largura .'&sCdMaoPropria='. $mao_propria .'&nVlValorDeclarado='. $valor_declarado .'&sCdAvisoRecebimento='. $aviso_recebimento .'&nCdServico='. $servico .'&nVlDiametro='. $diametro .'&StrRetorno=xml';;

  $conteudo = file_get_contents($url);
  $frete_calcula = simplexml_load_string($conteudo);

  /*
  CASO QUEIRA VER TUDO QUE VEM DO SITE DOS CORREIOS, DESCOMENTE A LINHA ABAIXO.
  echo print_r($frete_calcula);
  */
  $frete = $frete_calcula->cServico;

  # SUCESSO==========================================
  if($frete->Erro == '0'){

      switch($frete->Codigo){
          case 41106: $servico = 'PAC'; break;
          case 40045: $servico = 'SEDEX a Cobrar'; break;
          case 40215: $servico = 'SEDEX 10'; break;
          case 40290: $servico = 'SEDEX Hoje'; break;
          default: $servico = 'SEDEX';
      }
/*
      $retorno = array(
        'servico'         => $servico,
        'valor'           => $frete->Valor,
        'prazoDeEntrega'  => $frete->PrazoEntrega
      );
*/
      $retorno = $servico.'//';
      $retorno .= $frete->Valor.'//';
      $retorno .= $frete->PrazoEntrega.'_||_';

  # FALHAS============================================
  } elseif ($frete->Erro == '7') {
    $retorno = 'Serviço temporariamente indisponível, tente novamente mais tarde.';
  } elseif ($frete->Erro == '8') {
    $retorno = 'Serviço indisponível para o trecho informado.';
  } else {
    switch ( abs((int)$frete->Erro) ) {
      case 1: $retorno = "Código de serviço inválido"; break;
      case 2: $retorno = "CEP de origem inválido"; break;
      case 3: $retorno = "CEP de destino inválido"; break;
      case 4: $retorno = "Peso excedido"; break;
      case 5: $retorno = "O Valor Declarado não deve exceder R$ 10.000,00"; break;
      case 6: $retorno = "Serviço indisponível para o trecho informado"; break;
      case 7: $retorno = "O Valor Declarado é obrigatório para este serviço"; break;
      case 8: $retorno = "Este serviço não aceita Mão Própria"; break;
      case 9: $retorno = "Este serviço não aceita Aviso de Recebimento"; break;
      case 10: $retorno = "Precificação indisponível para o trecho informado"; break;
      case 11: $retorno = "Para definição do preço deverão ser informados, também, o comprimento, a largura e altura do objeto em centímetros (cm)."; break;
      case 12: $retorno = "Comprimento inválido."; break;
      case 13: $retorno = "Largura inválida."; break;
      case 14: $retorno = "Altura inválida."; break;
      case 15: $retorno = "O comprimento não pode ser maior que 105 cm."; break;
      case 16: $retorno = "A largura não pode ser maior que 105 cm."; break;
      case 17: $retorno = "A altura não pode ser maior que 105 cm."; break;
      case 18: $retorno = "A altura não pode ser inferior a 2 cm."; break;
      case 20: $retorno = "A largura não pode ser inferior a 11 cm."; break;
      case 22: $retorno = "O comprimento não pode ser inferior a 16 cm."; break;
      case 23: $retorno = "A soma resultante do comprimento + largura + altura não deve superar a 200 cm."; break;
      case 24: $retorno = "Comprimento inválido."; break;
      case 25: $retorno = "Diâmetro inválido"; break;
      case 26: $retorno = "Informe o comprimento."; break;
      case 27: $retorno = "Informe o diâmetro."; break;
      case 28: $retorno = "O comprimento não pode ser maior que 105 cm."; break;
      case 29: $retorno = "O diâmetro não pode ser maior que 91 cm."; break;
      case 30: $retorno = "O comprimento não pode ser inferior a 18 cm."; break;
      case 31: $retorno = "O diâmetro não pode ser inferior a 5 cm."; break;
      case 32: $retorno = "A soma resultante do comprimento + o dobro do diâmetro não deve superar a 200 cm."; break;
      case 33: $retorno = "Sistema temporariamente fora do ar. Favor tentar mais tarde."; break;
      case 34: $retorno = "Código Administrativo ou Senha inválidos."; break;
      case 35: $retorno = "Senha incorreta."; break;
      case 36: $retorno = "Cliente não possui contrato vigente com os Correios."; break;
      default: $retorno = "Erro no cálculo do frete, código de erro: ". $frete->Erro;
    }
  }

  return $retorno;
}
