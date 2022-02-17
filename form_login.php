<?php

function global_form_login()
{ ?>

	<script>
    jQuery(document).ready(function ($) {
        "use strict";

        if (typeof Cookies.get('cpf') !== 'undefined') {
            $("#login input").hide();
            $("#loader").show();
            window.location.replace("https://www.universidadeonlinesbem.com.br/2021-modulo10/");
        }

        $('#login input[type=submit]').click(function () {

            var emails = $('#login input[type=text]').val();
            var pwds = $('#login input[type=password]').val();

            $.ajax({
                data: {
                    login: emails,
                    senha: pwds,
                },
                type: "POST",
                url: "https://icase.sbem.itarget.com.br/api/login/",

                //-------------------- DATA -----------------------------
                success: function (data) {
                    if (data.data.logado == false) {
                        console.log("NO DATA!")
                        $("#login input").show();
                        $('.response').html('<span style="color: red; margin-bottom: 20px; display: block">Usuário ou senha incorretos!<span>');
                    } else {
                        $('.response').html('');

                        $.ajax({
                            type: "GET",
                            url: "https://icase.sbem.itarget.com.br/api/endereco/?token=01f5215c95babc4f6e1063c8e1e61eef192d4906&corresp=S&pessoa_id=" + data.data.id,

                            //------------------DATA 2 ------------------------------
                            success: function (data2) {
                                
                                $.ajax({
                                    type: "GET",
                                    url: "https://icase.sbem.itarget.com.br/api/pessoa/?token=01f5215c95babc4f6e1063c8e1e61eef192d4906&id=" + data.data.id,

                                    //------------------ DATA 3 ------------------------------
                                    success: function (data3) {

										$.ajax({
											type: "GET",
											url: "https://4k5zxy0dui.execute-api.us-east-1.amazonaws.com/webmodera/check-sbem/<?php echo get_option('evento_global') ?>/" + data3.data[0].cpf,

											//------------------DATA 2 ------------------------------
											success: function (data4) {
												if(data4.length == 0) {
													//------------- API CADASTRO ------------------------------

													var evento = '"evento": <?php echo get_option('evento_global') ?>,';
													var email = '"email":"' + data3.data[0].email + '",';
													var nome = '"nome":"' + data.data.nome + '",';
													var uf = '"uf":"' + data2.data[0].uf + '",';
													var cidade = '"cidade":"' + data2.data[0].municipio + '",';
													var telefone = '"telefone":"",';
													var cpf = '"cpf":"' + data3.data[0].cpf + '",';
													var crm = '"crm":"' + data3.data[0].crm + '",';
													var crm_uf = '"crm_uf":"",';
													var especialidade = '"especialidade":"Endocrinologia e Metabologia",';
													var codigo = '"codigo":"",';
													var produto = '"produto":"",';
													var valor = '"valor":"",';
													var pagante = '"pagante":"0",';
													var termo = '"termo":"1",';
													var sabendo = '"sabendo":"",';
													var profissao = '"profissao":"Medicina",';
													var cargo = '"cargo":"",';
													var status = '"status":"0"';

													var dataString='{' + evento + email + nome + uf + cidade + telefone + cpf + crm + crm_uf + especialidade + codigo + produto + valor + pagante + termo + sabendo + profissao + cargo + status + '}';

													console.log(dataString);

													$.post({
														url:"https://4k5zxy0dui.execute-api.us-east-1.amazonaws.com/webmodera/webhook",
														data: dataString,
														dataType: 'json',
														crossDomain: true,
														cache: false,
														beforeSend: function(){ console.log("enviando")},
														error: function(XMLHttpRequest, textStatus, errorThrown) {
															console.log(XMLHttpRequest);
															console.log(textStatus);
															console.log(errorThrown);
														},
														success: function() {
															console.log("enviou")
														}
													});
												}
											}
										});
                                        

                                        //----------------------------------------------------
                                        
                                        Cookies.set('cpf', data3.data[0].cpf, { expires: 0.17 });
                                        Cookies.set('nome', data.data.nome, { expires: 0.17 });
                                        Cookies.set('email', data3.data[0].email, { expires: 0.17 });
                                        Cookies.set('cidade', data2.data[0].municipio, { expires: 0.17 });
                                        Cookies.set('uf', data2.data[0].uf, { expires: 0.17 });
                                        Cookies.set('crm', data3.data[0].crm, { expires: 0.17 });
                                        $.ajax({
                                            data: {
                                                cpf: data3.data[0].cpf,
                                                email: data3.data[0].email,
                                                uf: data2.data[0].uf,
                                                cidade: data2.data[0].municipio,
                                                crm: data3.data[0].crm,
                                                nome: data.data.nome
                                            },
                                            type: "POST",
                                            url: "https://www.universidadeonlinesbem.com.br/webservice/inserir.php"

                                        });

                                        window.location.replace("<?php echo get_option('login_global') ?>");
                                    }
                                });
                            }
                        });
                    }

                }

            });

            return false;

        });

    });
    jQuery(document).ajaxStart(function () {
        jQuery("#loader").show();
        jQuery("#login input").hide();
    });
    jQuery(document).ajaxStop(function () {
        jQuery("#loader").hide();
    });
</script>
<fieldset id="login">
    <span class="response"></span>
    <img src="https://www.universidadeonlinesbem.com.br/wp-content/uploads/2020/04/loader.gif"
        style="margin: 0 auto; display: block; display: none;" id="loader" />
    <input type="text" placeholder="Login SBEM" />
    <input type="password" placeholder="Senha SBEM" />
    <input type="submit" value="entrar" id="Entrar" />
</fieldset>

<?php }

add_shortcode('form_login', 'global_form_login');