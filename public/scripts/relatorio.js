$(document).ready(function(){

	$("#mes").change(function(){
		const queryParams = substituirParametro ('mes', $(this).val())
		encaminhar(queryParams)
	})

	$("#ano").change(function(){
		const queryParams = substituirParametro ('ano', $(this).val())
		encaminhar(queryParams)
	})

	$("#hospital").change(function(){
		const queryParams = substituirParametro ('hospital', $(this).val())
		encaminhar(queryParams)
	})

})
