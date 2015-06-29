<section id="home">
	<h1>PRODUCTOS</h1>
	<div class="container-fluid" id="main-products">
		<div role="tabpanel">

		  
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="<?php if (!(isset($lastLoadedProductsGrid) or isset($productLoaded) or isset($productCancelled))) {echo "active";} ?>"><a href="#catalog" aria-controls="catalog" role="tab" data-toggle="tab">Catalogo</a></li>
		    <li role="presentation"><a href="#my-products" aria-controls="my-products" role="my-products" data-toggle="tab">Mis Productos</a></li>
		    <li role="presentation" class="<?php if (isset($lastLoadedProductsGrid) or isset($productLoaded) or isset($productCancelled)) { echo "active";} ?>"><a href="#load-products" aria-controls="load-products" role="load-products" data-toggle="tab">Cargar Productos</a></li>
		    <li role="presentation"><a href="#settings" aria-controls="settings" role="settings" data-toggle="tab">Ajustes</a></li>
		  </ul>

		  
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane fade <?php if (!(isset($lastLoadedProductsGrid) or isset($productLoaded) or isset($productCancelled))) {echo "active in";} ?>" id="catalog">
		    	<div class="row">


					<?php 
					$catalogSize = count($catalog);
					for ($i=0; $i < $catalogSize ; $i++) { ?>
						
						<div class="col-md-3 col-sm-4 col-xs-6 item-catalogo">
							<div class="producto-container"> 
								<div class="jquery-description"><h6><?php echo "Codigo Integrapp: ".$catalog[$i]->integrapp_code."</br>Codigo: ". $catalog[$i]->code . "</br>Nombre: ". $catalog[$i]->name. "</br>Descripcion: ". $catalog[$i]->short_desc   ?></h6></div>
							</div> 
						</div>


					<?php } ?>
		    	</div>
				
		    </div>
		    <div role="tabpanel" class="tab-pane fade" id="my-products">
			
		    </div>
		    <div role="tabpanel" class="tab-pane fade <?php if (isset($lastLoadedProductsGrid) or isset($productLoaded) or isset($productCancelled)) { echo "active in";} ?>" id="load-products">
		    	<div class="row" id="productSection">
				    <div class="panel panel-primary" id="">
								<div class="panel-heading">
									<div class="panel-title">
										<h4>Para comenzar seleccione una categoria:</h4>
									</div>
								</div>
								<div class="panel-body">

									<div class="col-md-3" id="products">
										<select name="" id="category1">
											<option value="">Seleccione una categoria...</option>
											<?php foreach ($category as $option) {
												echo "<option id='".$option->id."'>".$option->name."</option>";
											} ?>
										</select>
									</div>

									<div class="col-md-9">
							    		<h3>Tips:</h3>
								    	<ul>
								    		<li>Recuerde que el nombre de cada producto no puede ser el mismo de un producto ya cargado con anterioridad.</li>
								    		<li>Recuerde que el código de cada producto no puede ser el mismo de un producto ya cargado con anterioridad.</li>
								    		<li>Recuerde que puede duplicar un producto cargado y editar solo la informacion necesaria para autopopular la planilla de Carga de Productos y no volver a escribir todo a mano.</li>
								    		<li>Recuerde no molestar a la gente de IT por una mala experiencia de usuario.</li>
								    	</ul>	
									</div>
									
					    		</div>
					</div>
					<form class="region size1of2" action="<?php echo base_url(); ?>product/save_product" method="post" id="fromLoadProducts">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">
									<h4>Planilla Datos de Producto</h4>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-5" id="formOptions">
									<div class="form-group">
										<label for="" class="control-label">Categoria seleccionada</label>
										<input type="text" class="form-control" id="categoryTree" name="categoryTree" value="<?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('categoryTree',""); else echo set_value('categoryTree');?>" >
										<input type="text" name="categoryID" value="<?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('categoryID',""); else echo set_value('categoryID');?>" id="categoryID">
										<input type="text" name="productID" value="" id="productID">
										<input type="text" name="imagesPath" value="<?php echo base_url() . PRODUCT_IMAGES_PATH;?>" id="imagesPath">
										<input type="text" name="productEdition" value="" id="productEdition">
										<!-- The following fields are for testing javascript hide operations
										<input type="text" name="categoryID__" value="<?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('categoryID',""); else echo set_value('categoryID');?>" id="categoryID__">
										<input type="text" name="productID__" value="" id="productID__">
										<input type="text" name="imagesPath__" value="<?php echo base_url() . PRODUCT_IMAGES_PATH;?>" id="imagesPath__">
										<input type="text" name="productEdition__" value="" id="productEdition">
 										-->
										<script type="text/javascript">
											$("#categoryID").hide();
											$("#productID").hide();
											$("#imagesPath").hide();
											$("#productEdition").hide();

											$("#categoryTree").attr('disabled','disabled');
										</script>

									</div>
									<div class="form-group">
										<label for="" class="control-label">Nombre del producto*</label>
										<?php echo form_error('productName', '<span class="label label-danger">', '</span>'); ?>
										<input type="text" class="form-control" name="productName" id="productName" placeholder="Ingrese un nombre único..." value="<?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('productName',""); else echo set_value('productName');?>">
									</div>
									<div class="form-group">
										<label for="" class="control-label">Código*</label>
										<?php echo form_error('productCode', '<span class="label label-danger">', '</span>'); ?>
										<input type="text" class="form-control" name="productCode" id="productCode" placeholder="Ingrese el ID del código único del producto..." value="<?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('productCode',""); else echo set_value('productCode');?>">
									</div>
									<div class="form-group">
										<label for="" class="control-label">Condición IVA*</label>
										<?php echo form_error('productVAT', '<span class="label label-danger">', '</span>'); ?>
										<input type="text" class="form-control" name="productVAT" id="productVAT" placeholder="% de I.V.A." value="<?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('productVAT',""); else echo set_value('productVAT');?>">
									</div>
									<div class="form-group">
										<label for="" class="control-label">Descripción*</label>
										<?php echo form_error('productDesc', '<span class="label label-danger">', '</span>'); ?>
										<textarea class="form-control" name="productDesc" id="productDesc"><?php if (isset($productLoaded) or isset($productCancelled)) echo set_value('productDesc',""); else echo set_value('productDesc');?></textarea> 
										
									</div>
									<div class="input_fields_wrap">
										<h3>Especificaciones técnicas</h3>
									    <button class="add_field_button btn btn-primary btn-md">Agregar mas campos</button>
									    <div>
									    	<div class="form-group">
									    		<div class="form-group specifications">
												    <input type="text" name="attributeExample" placeholder="Ej.:Ancho" value="" disabled>
												    <input type="text" name="valueExample" placeholder="Ej.:30cm" value="" disabled><a href="#" class="remove_field"> X</a>
											    </div>
												<?php if (isset($attributes)) { for ($i=0; $i<count($attributes); $i++) {?> 
													<div class="form-group specifications">
														<input type="text" name="<?php echo 'attribute'. $i;?>" placeholder="Ej.:Ancho" value="<?php echo  $attributes[$i]->name;?>">
														<input type="text" name="<?php echo 'value'. $i;?>" placeholder="Ej.:30cm" value="<?php echo  $attributes[$i]->value;?>"><a href="#" class="remove_field"> X</a>
													</div>
												<?php }}; ?>
											</div>   
									    </div>
									</div>
									
									<div class="form-group">
										<h3>imagenes de producto</h3>
										<div id="freewalk-dropzone" class="dropzone"></div>
										<div class="dropzone-previews"></div>
										
										<?php if(isset($imagen)):?>
											<script type="text/javascript">
												function imagePush(image){
													$("#imagesArray").append("<input type='hidden' name='imagen[]' value='"+ image +"' />");
												}
												function imagePop(image){
													$( "input[value='" + image + "']" ).remove();
												}
												Dropzone.autoDiscover = false; // otherwise will be initialized twice
												var myDropzoneOptions = {
													paramName: "userfile",
													maxFilesize: 2,
													addRemoveLinks: true,
													clickable: true,
													url: "../product/upload_foto",
													success: function(file, response){
														var result =  $.parseJSON(response);
														if(result.success){
															file.file_name = result.success.file_name;
															imagePush(result.success.file_name);
														}
													},
													removedfile: function(file){
														console.log(file);
														imagePop(file.file_name);
														var _ref;
														return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
													}
												}; 
												var myDropzone = new Dropzone('#freewalk-dropzone', myDropzoneOptions);
												<?php foreach($imagen as $i): ?>
													var mockFile = { name: "Imagen", size: 12345, file_name: '<?php echo $i;?>' };
													myDropzone.options.addedfile.call(myDropzone, mockFile);
													myDropzone.options.thumbnail.call(myDropzone, mockFile, "<?php echo base_url() . PRODUCT_IMAGES_PATH . 'temp/thumbs/' . $i;?>");
												<?php endforeach; ?>
											</script>
										<?php else: ?>
											<script type="text/javascript">
												function imagePush(image){
													$("#imagesArray").append("<input type='hidden' name='imagen[]' value='"+ image +"' />");
												}

												function imagePop(image){
													$( "input[value='" + image + "']" ).remove();
												}

												Dropzone.options.freewalkDropzone = {
												  paramName: "userfile", 
												  maxFilesize: 2, 
												  url: "../product/upload_foto",
												  addRemoveLinks: true,
												  dictCancelUpload: "Cancelar",
												  dictRemoveFile: "Borrar", 
												  acceptedFiles: "image/jpeg",
												  dictInvalidFileType: "Solo se aceptan imagenes jpg",

												  accept: function(file, done) {
												    if (file.name == "justinbieber.jpg") {
												      done("Naha, you don't.");
												    }
												    else { done(); }
												  }, 
												  success: function(file, response){
												  	var result =  $.parseJSON(response);
												  	if(result.success){
												  		file.file_name = result.success.file_name;
												  		imagePush(result.success.file_name);
												  	}
												  },
												  removedfile: function(file){
												  	console.log(file);
												  	imagePop(file.file_name);
												  	var _ref;
												    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
												  }
												};
											</script>					
										<?php endif;?>

										<div id="imagesArray">
											<?php if($this->input->post("imagen")):?>
												<?php foreach($this->input->post("imagen") as $i): ?>
													<input id="prodImagesArray" type="hidden" name="imagen[]" value="<?php echo $i;?>">
												<?php endforeach; ?>
											<?php endif;?>
										</div>


									</div>
									<div class="form-group">
										<input type="submit" id="saveProduct" name="submitLoad" value="Guardar" class="btn btn-primary">
										<input type="submit" id="cancelLoad" name="submitLoad" value="Cancelar" class="btn btn-primary">
									</div>
									<script type="text/javascript">
										$("#cancelLoadCheck").hide();
										$('#cancelLoad').click(function(){
											$("#cancelLoadCheck").prop( "checked", true );
										});

									</script>
									<div class="alert alert-warning alert-dismissible insight" role="alert">
									
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Atencion!</strong> Has Cargado un producto nuevo. Puedes verlo en la planilla del costado o entrando en detalle en el area Mis Productos.
									</div>

								</div>
								<div  class="col-xs-12 col-sm-12 col-md-6 col-lg-7" id="divRecentlyAddedProducts">
									<table class="table table-bordered table-striped">
										<caption>Productos Cargados</caption>
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Condición I.V.A.</th>
												<th>Código Integrapp</th>
												<th>Código</th>
												<th>Acción</th>
											</tr>
										</thead>
										<tbody id="tableBody">
											<?php if (isset($lastLoadedProductsGrid)) { for ($i=0; $i<count($lastLoadedProductsGrid); $i++) {?> 
												<tr id="<?php echo 'tr_' . $lastLoadedProductsGrid[$i]->integrapp_code;?>">
													<td><?php echo $lastLoadedProductsGrid[$i]->name;?></td>
													<td><?php echo $lastLoadedProductsGrid[$i]->tax;?></td>
													<td><?php echo $lastLoadedProductsGrid[$i]->integrapp_code;?></td>
													<td><?php echo $lastLoadedProductsGrid[$i]->code;?></td>
													<td><button type='submit' name = "editRecentlyAdded" id="<?php echo $lastLoadedProductsGrid[$i]->integrapp_code;?>" form="divRecentlyAddedProducts">Editar</button></td>
												</tr>
											<?php }}; ?>
											
										</tbody>
									</table>
								</div>
								<div id= "recentlyAddedIntegrappCodes">
									<?php if (isset($lastLoadedProductsGrid)) { for ($i=0; $i<count($lastLoadedProductsGrid); $i++) {?> 
										<input type="text" name = "recentlyAddedIntegrappCode[]" id="recentlyAddedIntegrappCode[]" value="<?php echo $lastLoadedProductsGrid[$i]->integrapp_code;?>">
									<?php }}; ?>

									<script type="text/javascript">
										$("#recentlyAddedIntegrappCodes").hide();

									</script>
								</div>
							</div>
						</div>

					</form>			    
				</div>


			</div>
			<div role="tabpanel" class="tab-pane fade" id="settings">...</div>
	</div>

</section>