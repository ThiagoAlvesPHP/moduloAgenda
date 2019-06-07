$(function (){
	$('#dt_hs_comunicado').datetimepicker({format:'d/m/Y H:i:s',formatDate:'Y-m-d H:i:s'});
    $('.money').mask('##0.00', {reverse: true});
    $('.money2').mask('##0.000000000', {reverse: true});
    $('.taxas').mask('##0.00000', {reverse: true});
    $('.cep').mask('00000-000', {reverse: true});
    $('.cpf').mask('000.000.000-00', {reverse: true});

    $('.money3').mask('#.##0,00', {reverse: true});
    $('.money4').mask('#.##0,000000000', {reverse: true});
    $('.money5').mask('#.##0,00000', {reverse: true});
    
    //EFEITO EM MENU
    $('#menu1').bind('mouseenter', function(){
        $('#submenu1').show();
    });
    $('#menu1').bind('mouseleave', function(){
        $('#submenu1').fadeOut();
    });
    $('#menu2').bind('mouseenter', function(){
        $('#submenu2').show();
    });
    $('#menu2').bind('mouseleave', function(){
        $('#submenu2').fadeOut();
    });
    $('#menu3').bind('mouseenter', function(){
        $('#submenu3').show();
    });
    $('#menu3').bind('mouseleave', function(){
        $('#submenu3').fadeOut();
    });
    $('#menu4').bind('mouseenter', function(){
        $('#submenu4').show();
    });
    $('#menu4').bind('mouseleave', function(){
        $('#submenu4').fadeOut();
    });

    //AJAX EM PROCESSO02 SEGURADORA
	$('.seg').on('click', function(){
		var id_empresa = $('.seg').val();
        var id_ramo = $('#id_ramo').val();

		$.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ id_empresa:id_empresa[0] },
            success:function(data){
            	html = '<label><span style="color: red;">*</span> Apólice Numero:</label>';
            	html += '<select class="form-control" name="num_apolice">';
            	for(line in data){
                    user = data[line];
                    if (user['id_ramo'] === id_ramo) {
                        html += '<option value="'+user['id']+'">'+user['num_apolice']+'</option>';
                    }
                }
                html += '</select>';
                $('#num_apolice').html(html);
                $('#cnpj').val(user['cnpj']);   
            }
        });
	});

    //AJAX EM PROCESSO03 TRANSPORTADORA
    $('.trasp').on('click', function(){
        var id_transportadora = $('.trasp').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ id_transportadora:id_transportadora[0] },
            success:function(data){
                $('#cnpjT').val(data['cnpj']);  
            }
        });
    });

    //AJAX EM PROCESSO04 CORRETORA
    $('.corretora').on('click', function(){
        var id_corretora = $('.corretora').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ id_corretora:id_corretora[0] },
            success:function(data){
                $('#cnpjC').val(data['cnpj']);  
            }
        });
    });

    //AJAX EM PROCESSO05 CIDADE
    $('#city1').bind('keyup', function(){
        var city1 = $('#city1').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ city1:city1 },
            success:function(data){

                var html = '';
                for(line in data){
                    user = data[line];
                    html += '<option value="'+user['id']+'">'+user['nome']+' - '+user['uf']+' - '+user['sigla']+'</option>';
                }
                $('#cidades1').html(html);
            }
        });
    });
    $('#city2').bind('keyup', function(){
        var city2 = $('#city2').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ city2:city2 },
            success:function(data){

                var html = '';
                for(line in data){
                    user = data[line];
                    html += '<option value="'+user['id']+'">'+user['nome']+' - '+user['uf']+' - '+user['sigla']+'</option>';
                }
                $('#cidades2').html(html);
            }
        });
    });
    $('#city3').bind('keyup', function(){
        var city3 = $('#city3').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ city3:city3 },
            success:function(data){

                var html = '';
                for(line in data){
                    user = data[line];
                    html += '<option value="'+user['id']+'">'+user['nome']+' - '+user['uf']+' - '+user['sigla']+'</option>';
                }
                $('#cidades3').html(html);
            }
        });
    });
    $('#city4').bind('keyup', function(){
        var city4 = $('#city4').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ city4:city4 },
            success:function(data){

                var html = '';
                for(line in data){
                    user = data[line];
                    html += '<option value="'+user['id']+'">'+user['nome']+' - '+user['uf']+' - '+user['sigla']+'</option>';
                }
                $('#cidades4').html(html);
            }
        });
    });

    //PAGINA PROCESSO09.PHP
    $('#active1').on('click', function(){
        $(".res1").removeAttr("readonly");
    });
    $('#active2').on('click', function(){
        $(".res2").removeAttr("readonly");
    });



    //CALCULOS PAGINA PROCESSO25.PHP
    $('#danos').on('keyup', function(){
        var danos = $('#danos').val();
        if (parseFloat(danos) > 0) {
            $('#res01').val(danos);
        }
    });
    $('#danos, #dispersao').on('keyup', function(){
        var a = $('#danos').val();
        var b = $('#dispersao').val();
        var total = parseFloat(a)+parseFloat(b);
        if (parseFloat(total) > 0) {
            $('#res01').val(total.toFixed(2));
        }
    });
    $('#danos, #dispersao, #fsr').on('keyup', function(){
        var a = $('#danos').val();
        var b = $('#dispersao').val();
        var c = $('#fsr').val();
        var total = parseFloat(a)+parseFloat(b)+parseFloat(c);
        if (parseFloat(total) > 0) {
            $('#res01').val(total.toFixed(2));
        }
    });
    
    //PROCESSO15.PHP
    $('#rastreamento').on('change', function(){
        var v = $('#rastreamento').val();
        if (v == 1) {
            $('.value').removeAttr("readonly", "readonly");
        } 
        if (v == 2) {
            $('.value').attr("readonly", "readonly");
        }
    });
    $('#rastreamento2').on('change', function(){
        var v = $('#rastreamento2').val();
        if (v == 1) {
            $('.value2').removeAttr("readonly", "readonly");
        } 
        if (v == 2) {
            $('.value2').attr("readonly", "readonly");
        }
    });
    $('#seachProcesso').mask('##/##');
    //BUSCA DE PROCESSOS
    $('#seachProcesso').on('keyup', function(){
        var seachProcesso = $('#seachProcesso').val();

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ seachProcesso:seachProcesso },
            success:function(data){
                var html = '<table id="resposta" class="table table-hover" style="font-size: 12px;">';
                html += '<thead style="background: #000; color: #fff;">';
                html += '<tr>';
                html += '<th>Ação</th>';
                html += '<th>Nº Processo</th>';
                html += '<th>Nº Sinistro</th>';
                for(line in data){
                    user = data[line];

                    html += '<tbody>';
                    html += '<tr>';
                    html += '<td><a href="processo.php?num_processo='+user['num_processo']+'" class="fa fa-edit" title="Editar Processo"></a></td>';

                    html += '<td>'+user['num_processo']+'</td>';
                    html += '<td>'+user['num_sinistro']+'</td>';
                    html += '</tr>';
                    html += '</tbody>';
                }
                html += '</table>';
                $('#resposta').html(html);
            }
        });
    });

    //CALCULOS processo30.nfe.php
    $('#qt, #valor_uni, #icms, #ipi, #valor_desc').on('keyup', function(){
        var qt = $('#qt').val();
        var a = $('#valor_uni').val().replace(/[.]+/g, '');
        var valor_uni = a.replace(/[,]+/g, '.');
        var icms = $('#icms').val();
        var ipi = $('#ipi').val();
        var b = $('#valor_desc').val().replace(/[.]+/g, '');
        var valor_desc = b.replace(/[,]+/g, '.');

        if (qt.length > 0) {
            $('#total').val(0);
            if (valor_uni.length > 0) {
                var prej = parseFloat(qt)*parseFloat(valor_uni);
                $('#total').val(prej);
                if (icms.length > 0) {
                    var v1 = parseFloat(prej)/100;
                    var v2 = parseFloat(v1)*parseFloat(icms);
                    var v3 = parseFloat(v2)+parseFloat(prej);
                    $('#total').val(v3);
                }
                if (ipi.length > 0) {
                    var v1 = parseFloat(prej)/100;
                    var v2 = parseFloat(v1)*parseFloat(ipi);
                    var v4 = parseFloat(v2)+parseFloat(v3);
                    $('#total').val(v4);
                }
                if (valor_desc.length > 0) {
                    var vF = parseFloat(v4)-parseFloat(valor_desc);
                    $('#total').val(vF);
                }
            }
        }
    });

    $('#qtUP, #valor_uniUP, #icmsUP, #ipiUP, #valor_descUP').on('keyup', function(){
        var qt = $('#qtUP').val();
        var a = $('#valor_uniUP').val().replace(/[.]+/g, '');
        var valor_uni = a.replace(/[,]+/g, '.');
        var icms = $('#icmsUP').val();
        var ipi = $('#ipiUP').val();
        var b = $('#valor_descUP').val().replace(/[.]+/g, '');
        var valor_desc = b.replace(/[,]+/g, '.');

        if (qt.length > 0) {
            $('#totalUP').val(0);
            if (valor_uni.length > 0) {
                var prej = parseFloat(qt)*parseFloat(valor_uni);
                $('#totalUP').val(prej);
                if (icms.length > 0) {
                    var v1 = parseFloat(prej)/100;
                    var v2 = parseFloat(v1)*parseFloat(icms);
                    var v3 = parseFloat(v2)+parseFloat(prej);
                    $('#totalUP').val(v3);
                }
                if (ipi.length > 0) {
                    var v1 = parseFloat(prej)/100;
                    var v2 = parseFloat(v1)*parseFloat(ipi);
                    var v4 = parseFloat(v2)+parseFloat(v3);
                    $('#totalUP').val(v4);
                }
                if (valor_desc.length > 0) {
                    var vF = parseFloat(v4)-parseFloat(valor_desc);
                    $('#totalUP').val(vF);
                }
            }
        }
    });


    $('#qtIn, #valueIn').on('keyup', function(){
        var a = $('#qtIn').val().replace(/[.]+/g, '');
        var qt = a.replace(/[,]+/g, '.');

        var b = $('#valueIn').val().replace(/[.]+/g, '');
        var value = b.replace(/[,]+/g, '.');

        if (qt.length > 0) {
            $('#totIn').val(qt);
            if (value.length > 0) {
                var total = parseFloat(qt) * parseFloat(value);
                $('#totIn').val(total.toFixed(2));
            }
        }
    });

    $('#qtInUp, #valueInUp').on('keyup', function(){
        var a = $('#qtInUp').val().replace(/[.]+/g, '');
        var qt = a.replace(/[,]+/g, '.');

        var b = $('#valueInUp').val().replace(/[.]+/g, '');
        var value = b.replace(/[,]+/g, '.');

        if (qt.length > 0) {
            $('#totInUp').val(qt);
            if (value.length > 0) {
                var total = parseFloat(qt) * parseFloat(value);
                $('#totInUp').val(total.toFixed(2));
            }
        }
    });


    $('#nt').on('mouseover', function(){
        $('#not').removeAttr("hidden");

        $.ajax({
            type: 'POST',
            url: 'notificacoes.php',
            success:function(data){
                $('#not').html(data);
            }
        });

    });
    $('#not').on('mouseleave', function(){
        $('#not').attr("hidden","hidden");
    });

    $('.txt').on('change', function(){
        var txt = $(this).val();
        var id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ txt:txt, id:id },
            success:function(data){
                $('#divCarregando').removeAttr("hidden");
                function txt() {
                  $('#divCarregando').attr("hidden", "hidden");
                }
                setTimeout(txt,1000);
            }
        });
        
    });
    
    $('.txtP21').on('change', function(){
        var txtP21 = $(this).val();
        var id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ txtP21:txtP21, id:id },
            success:function(data){
                $('#divCarregando').removeAttr("hidden");
                function txt() {
                  $('#divCarregando').attr("hidden", "hidden");
                }
                setTimeout(txt,1000);
            }
        });
        
    });

    $('.txtftSin').on('change', function(){
        var txtftSin = $(this).val();
        var id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ txtftSin:txtftSin, id:id },
            success:function(data){
                $('#divCarregando').removeAttr("hidden");
                function txt() {
                  $('#divCarregando').attr("hidden", "hidden");
                }
                setTimeout(txt,1000);
            }
        });
        
    });

    $('.txtftSal').on('change', function(){
        var txtftSal = $(this).val();
        var id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ txtftSal:txtftSal, id:id },
            success:function(data){
                $('#divCarregando').removeAttr("hidden");
                function txt() {
                  $('#divCarregando').attr("hidden", "hidden");
                }
                setTimeout(txt,1000);
            }
        });
    });

    $('.txtVist').on('change', function(){
        var txtVist = $(this).val();
        var id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ txtVist:txtVist, id:id },
            success:function(data){
                $('#divCarregando').removeAttr("hidden");
                function txt() {
                  $('#divCarregando').attr("hidden", "hidden");
                }
                setTimeout(txt,1000);
            }
        });
    });

    //BUSCA DE PESSOA JURUDICA
    $('#seachPJ').on('keyup', function(){
        var seachPJ = $('#seachPJ').val();

        $.ajax({
            contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
            type: 'POST',
            url: 'ajax.php',
            dataType:'json',
            data:{ seachPJ:seachPJ },
            success:function(data){
                var html = '<table id="resposta" class="table table-hover" style="font-size: 12px;">';
                html += '<thead style="background: #000; color: #fff;">';
                html += '<tr>';
                html += '<th>Ação</th>';
                html += '<th>Razão Social</th>';
                html += '<th>CNPJ</th>';
                html += '<th>Ativo</th>';
                html += '<th>Segurado</th>';
                html += '<th>Seguradora</th>';
                html += '<th>Transportadora</th>';
                html += '<th>Corretora</th>';
                html += '<th>Criando em</th>';
                html += '<th>Criando por</th>';
                html += '</tr>';
                html += '</thead>';
                for(line in data){
                    user = data[line];

                    html += '<tbody>';
                    html += '<tr>';
                    html += '<td><a href="pessoaPJForm.php?id='+user['id']+'" class="fa fa-edit" title="Editar Pessoa Juridica"></a></td>';
                    html += '<td>'+user['razao_social']+'</td>';
                    html += '<td>'+user['cnpj']+'</td>';

                    if (user['status'] == 1) {
                        html += '<td>Ativo</td>';
                    } else {
                        html += '<td>Inativo</td>';
                    }
                    if (user['segurado'] == 1) {
                        html += '<td>Sim</td>';
                    } else {
                        html += '<td>Não</td>';
                    }
                    if (user['seguradora'] == 1) {
                        html += '<td>Sim</td>';
                    } else {
                        html += '<td>Não</td>';
                    }
                    if (user['transportadora'] == 1) {
                        html += '<td>Sim</td>';
                    } else {
                        html += '<td>Não</td>';
                    }
                    if (user['corretora'] == 1) {
                        html += '<td>Sim</td>';
                    } else {
                        html += '<td>Não</td>';
                    }

                    html += '<td>'+user['dt_cadastro']+'</td>';
                    html += '<td>'+user['nome']+'</td>';
                    html += '</tr>';
                    html += '</tbody>';
                }
                html += '</table>';
                $('#seachPJResultado').html(html);
            }
        });
    });

});

function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}