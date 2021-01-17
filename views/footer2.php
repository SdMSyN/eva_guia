        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-popup">
                    <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                    <h3 class="white">Iniciar Sesión</h3>
                    <p style="color: #FF0000; " class="error"></p>
                    <form class="popup-form" id="formLogin" method="POST">
                        <input type="text" class="form-control form-white" placeholder="Usuario" id="inputUser" name="inputUser">
                        <input type="password" class="form-control form-white" placeholder="Contraseña" id="inputPass" name="inputPass">
                        <button type="submit" class="btn btn-submit">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>


        <footer class="footer">
            <p class="textFoot">&copy; Noviembre, 2016, Desarrollado por <b>
                <a href="http://solucionesynegocios.com.mx/" target="_blank">Software de México: Soluciones y Negocios S.A.S. de C.V.</a></b></p>
        </footer>
        <!-- Holder for mobile navigation -->
	<div class="mobile-nav">
		<ul>
		</ul>
		<a href="#" class="close-link"><i class="arrow_up"></i></a>
	</div>
        
        <script type="text/javascript">
        $('#loading').hide();
        $(document).ready(function(){
            $('#formLogin').validate({
                rules: {
                    inputUser: {required: true},
                    inputPass: {required: true}
                },
                messages: {
                    inputUser: "Usuario obligatorio",
                    inputPass: "Contraseña obligatoria"
                },
                tooltip_options: {
                    inputUser: {trigger: "focus", placement: 'right'},
                    inputPerfil: {trigger: "focus", placement: 'right'}
                },
                beforeSend: function(){
                    $('.msg').html('loading...');
                },
                submitHandler: function (form) {
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/login_user.php",
                        data: $('form#formLogin').serialize(),
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                if(msg.perfil == 1) location.href="index_admin.php";
                                else if(msg.perfil == 2) location.href="index_capturista.php";
                                else if(msg.perfil == 3) location.href="estudiante_programa.php";
                                else location.href="#";
                            }else{
                                $('.error').html(msg.msgErr);
                            }
                        },
                        error: function () {
                            alert("Error al iniciar sesión de usuario");
                        }		
                    });
                }
            });
            
        });
    </script>
    
    </body>
</html>