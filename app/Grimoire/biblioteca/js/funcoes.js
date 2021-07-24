
/*
  Verifica se a data informada esta no passado
  Parametro dd/mm/yyyy
  Retorno   bool
*/
function jaPassou(data) {
  var hoje = format_date(new Date());
  return comparaDatas(data, hoje);
}

/*
  Verifica se a primeira data e menor ou igual a segunda
  Parametro dd/mm/yyyy, dd/mm/yyyy
  Retorno   bool
*/
function comparaDatas(data1, data2) {
  return limpaData(data1) <= limpaData(data2);
}

/*
  Reoordena campos de data para comparacao
  Parametro dd/mm/yyyy
  Retorno   yyyymmdd
 */
function limpaData(data) {
  var dataLimpa = data.split("/");
  return dataLimpa[2] + dataLimpa[1] + dataLimpa[0];
}
