$(function (){
    //AJAX EM PROCESSO02 SEGURADORA
	$(document).on('change', '.mes', function(){
		var mes = $('.mes').val();

		$.ajax({
            type: 'POST',
            url: 'ajax.php',
            data:{ mes:mes },
            success:function(data){
                $('#resultado').html(data);

                var d = new Date();
                var ano  = d.getFullYear();
                if (mes == 1) {
                    var name = 'Janeiro de '+ano;
                }
                if (mes == 2) {
                    var name = 'Fevereiro de '+ano;
                }
                if (mes == 3) {
                    var name = 'Março de '+ano;
                }
                if (mes == 4) {
                    var name = 'Abril de '+ano;
                }
                if (mes == 5) {
                    var name = 'Maio de '+ano;
                }
                if (mes == 6) {
                    var name = 'Junho de '+ano;
                }
                if (mes == 7) {
                    var name = 'Julho de '+ano;
                }
                if (mes == 8) {
                    var name = 'Agosto de '+ano;
                }
                if (mes == 9) {
                    var name = 'Setembro de '+ano;
                }
                if (mes == 10) {
                    var name = 'Outubro de '+ano;
                }
                if (mes == 11) {
                    var name = 'Novembro de '+ano;
                }
                if (mes == 12) {
                    var name = 'Dezembro de '+ano;
                }

                $('#sel').html(name);
            }
        });
	});

});