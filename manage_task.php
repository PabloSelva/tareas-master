<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM lista_tareas where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-task">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Tarea</label>
						<input type="text" class="form-control form-control-sm" name="task" value="<?php echo isset($task) ? $task : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="">Asignar a</label>
						<select name="employee_id" id="employee_id" class="form-control form-control-sm" required="">
							<option value=""></option>
							<?php 
							$employees = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM lista_miembros order by concat(lastname,', ',firstname,' ',middlename) asc");
							while($row=$employees->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($employee_id) && $employee_id == $row['id'] ? 'selected' : '' ?>>
							<?php echo $row['name'] . ' - ' . $row['email']; ?>
						</option>

							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Fecha de Vencimiento</label>
						<input type="date" class="form-control form-control-sm" name="due_date" id="due_date" value="<?php echo isset($due_date) ? $due_date : date("Y-m-d"); ?>" required>
						<script>
							// Obtiene el elemento del campo de fecha
							var dueDateInput = document.getElementById('due_date');

							// Obtiene la fecha actual en formato YYYY-MM-DD
							var currentDate = new Date();

							// Ajusta la fecha actual al día siguiente
							currentDate.setDate(currentDate.getDate());
							var formattedCurrentDate = currentDate.toISOString().split('T')[0];

							// Establece la fecha mínima del campo de fecha al día siguiente
							dueDateInput.min = formattedCurrentDate;
						</script>
					</div>
				</div>
				<div class="col-md-7">
					<div class="form-group">
						<label for="">Descripción</label>
						<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
							<?php echo isset($description) ? $description : '' ?>
						</textarea>
					</div>
					<div class="form-group">
            		<label for="file">Adjuntar Archivo</label>
            		<input type="file" class="form-control-file" name="file" id="file">
        			</div>


					
				</div>
			</div>
		</div>
		
		
	</form>
</div>

<script>
	$(document).ready(function(){

	$('#employee_id').select2({
		placeholder:'Elija al miembro para asignar tarea',
		width:'100%'
	})

	$('.summernote').summernote({
        height: 200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help'] ],
			['insert', ['link', 'picture', 'video', 'file']]	
        ]
		
    })
     })
    
	 $('#manage-task').submit(function(e){
    e.preventDefault();
    start_load();

    // Datos para enviar al servidor
    var formData = new FormData($(this)[0]);

    $.ajax({
        url: 'ajax.php?action=save_task',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function(resp){
            if(resp == 1){
                alert_toast('Nueva Tarea asignada', "Proceso Exitóso");

                var datos = {
                    task: $('[name="task"]').val(),
                    description: $('[name="description"]').val(),
					employee_id: $('[name="employee_id"]').val()
                };

                $.ajax({
                    type: 'POST',
                    url: 'enviar_correo_tarea.php',
                    data: datos,
                    success: function(response) {
                        // Manejar la respuesta del servidor para el envío de correo
                    },
                    error: function() {
                        alert('Hubo un error al enviar el correo');
                    }
                });

                setTimeout(function(){
                    location.reload();
                }, 1500);
            }
        }
    });
});

</script>