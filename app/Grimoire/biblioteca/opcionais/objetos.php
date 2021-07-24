<?php
/**
 * Funções para operações com objetos
 * @package grimoire/bliblioteca/opcionais
*/

/**
 * Converte uma array para um objeto
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	array
 * @return	object
 *
 * @example
		$obj = criarObjeto(array('foo' => 'bar', 'property' => 'value', 'endereco' => array('pan' => 'pum'))); echo $obj->foo; // prints 'bar' //echo $obj->endereco["pan"];
		$obj = criarObjeto(array('foo' => 'bar'));
		echo $obj->foo; // prints 'bar' //echo $obj->endereco["pan"];
		exibir($obj);
 */
function criarObjeto ($atributos=array())
{
	return (object) $atributos;
}

/**
 * Retorna o nome da classe de um objeto
 * @package grimoire/bibliotecas/vetores.php
 * @version 05-07-2015
 *
 * @param	object
 * @return	string: the name of this class
 */
function toString ($object)
{
	return get_class($object);
}
