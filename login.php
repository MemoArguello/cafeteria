<?php 
	require "include/header.php";
	require "config/config.php";

	if (isset($_SESSION['id_usuario'])) {
		header("location:" . ADMINURL . "");
		exit();
	}

	if (isset($_POST['submit'])) {
		if (empty($_POST['email']) || empty($_POST['codigo'])) {
			echo "<script>
				Swal.fire({
						icon: 'error',
						title: 'Campos Vacios',
						text: 'Por favor, rellene todos los campos',
						});
			</script>";
		}else{
			$email = $_POST['email'];
			$codigo = $_POST['codigo'];

			$login = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
			$login->bindParam(':email',$email, PDO::PARAM_STR);
			$login->execute();
			$fetch = $login->fetch(PDO::FETCH_ASSOC);

			if ($fetch) {
				if (password_verify($codigo, $fetch['codigo'])) {
					$_SESSION['usuario'] = $fetch['nombreUsuario'];
					$_SESSION['id_usuario'] = $fetch['id_usuario'];


					echo "<script>
						Swal.fire({
								icon: 'success',
								title: 'Inicio de Sesión Exitosa',
								text: 'Bienvenido al Admin Panel',
								}).then((){
									windows.location.href = '". ADMINURL ."';
								});
					</script>";
				}else{
					echo "<script>
					Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Email o contraseña incorrecta',
							});
				</script>";
				}
			}else{
				echo "<script>
				Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'El correo ingresado no Existe',
						});
			</script>";
			}
		}		

	}


?>
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
			<form action="login.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
				<h3 class="mb-4 billing-heading">Administrador</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-12">
	                <div class="form-group">
	                	<label for="Email">Email</label>
	                  <input type="text" class="form-control" placeholder="Email" name="email">
	                </div>
	              </div>
                 
	              <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Password">Contraseña</label>
	                    <input type="password" class="form-control" placeholder="Contraseña" name="codigo">
	                </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
							<div class="radio">
                                <button name="submit" class="btn btn-primary py-3 px-4">Ingresar</button>
						    </div>
					</div>
                </div>      
	          </form><!-- END -->
          </div> <!-- .col-md-8 -->
          </div>
        </div>
      </div>
    </section> <!-- .section -->
    <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
<?php require "include/footer.php" ?>