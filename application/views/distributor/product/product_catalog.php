				<div class="row" style="padding: 10px 10px 10px 10px;">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<table id="resultset" class="table table-bordered table-striped">
			                <thead>
			                    <tr>
			                        <th data-class="expand">Imagen</th>
			                        <th>Código de Producto</th>
									<th>Código IntegrApp</th>
			                        <th data-hide="phone">Producto</th>
			                        <th class="centered-cell" data-hide="phone,tablet">IVA</th>
			                        <th class="centered-cell visible-md-* visible-lg-*" data-hide="phone,tablet">Mayoristas</th>
			                        <th class="centered-cell" data-hide="phone,tablet">Acciones</th>
			                    </tr>
			                </thead>
			                <tbody>
								<?php 
								$catalogSize = count($Catalog);
								for ($i=0; $i < $catalogSize; $i++) { ?>
									<tr>
										<td>
											<?php if (count($Catalog[$i]->images)>0) {?>
										      	<a href="<?php echo base_url() . 'product/viewProduct/' . $Catalog[$i]->id; ?>"><img src="<?php echo base_url() . PRODUCT_IMAGES_PATH . $Catalog[$i]->images[0]; ?>" style="max-width: 100%;display: block;margin: 0 auto;max-height: 40px;"></a>
										    <?php } else { ?>
									      		<a href="<?php echo base_url() . 'product/viewProduct/' . $Catalog[$i]->id; ?>"><img src="<?php echo base_url() . 'Resources/img/NoFoto.jpg'; ?>" style="max-width: 100%;display: block;margin: 0 auto;max-height: 40px;"></a>
										    <?php } ?>
										</td>
										<td>
											<a href="<?php echo base_url() . 'product/viewProduct/' . $Catalog[$i]->id; ?>"><?php echo $Catalog[$i]->code; ?></a>
										</td>
										<td>
											<a href="<?php echo base_url() . 'product/viewProduct/' . $Catalog[$i]->id; ?>"><?php echo $Catalog[$i]->integrapp_code; ?></a>
										</td>
										<td>
											<a href="<?php echo base_url() . 'product/viewProduct/' . $Catalog[$i]->id; ?>">
												<strong><?php echo $Catalog[$i]->name; ?></strong>
											</a>
											<br>
											<b>Categoria: </b><?php echo $Catalog[$i]->categoryPath; ?>

										</td>
										<td>
											<?php echo $Catalog[$i]->tax; ?>
										</td>
										<td>
											<div class="dropdown" style="margin-bottom: 10px;">
												<button class="btn btn-info btn-xs dropdown-toggle" type="button" id="suppliersDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<?php if ((isset($Catalog[$i]->primarySupplier->price)) or($loadInfo->isDistributorFivesRule == true)) {?>
														<?php echo $Catalog[$i]->primarySupplier->fake_name; ?>
														<?php if (isset($Catalog[$i]->primarySupplier->price)){ 
																echo " $".number_format($Catalog[$i]->primarySupplier->price, PRICE_DECIMAL_AMOUNT, DECIMAL_SEPARATOR, THOUSANDS_SEPARATOR);
														}?>
													<?php } else { ?>
														No ascociado al mayorista
													<?php } ?>
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" aria-labelledby="suppliersDropDown">
													<li class="dropdown-header">Mayorista Principal</li>
													<?php if ((isset($Catalog[$i]->primarySupplier->price)) or($loadInfo->isDistributorFivesRule == true)) {?>
														<li><a href="<?php echo base_url() . 'Suppliers/viewSupplier/'. $Catalog[$i]->primarySupplier->id;?>">
														<?php if(isset($Catalog[$i]->primarySupplier->logo)){ ?>
						     								<img src="<?php echo base_url() . $Catalog[$i]->primarySupplier->logo; ?>" style="height: 20px">
						     							<?php } else { ?>
						     								<img src="<?php echo base_url() . IMAGES_PATH . 'noProfilePic.jpg'; ?>" style="height: 20px">
														<?php } ?>
															<?php echo $Catalog[$i]->primarySupplier->fake_name; ?>
															<?php if (isset($Catalog[$i]->primarySupplier->price)){ 
																echo "(lo vende a $".number_format($Catalog[$i]->primarySupplier->price, PRICE_DECIMAL_AMOUNT, DECIMAL_SEPARATOR, THOUSANDS_SEPARATOR).")";
															} else {
																echo "(no esta asociado)";	
															}?></a>
														</li>
													<?php } else { ?>
														<li><a href="">No disponible</a></li>
													<?php } ?>
													<li role="separator" class="divider"></li>
													<li class="dropdown-header">Mayoristas secundarios que lo redistribuyen</li>
													<?php foreach ($Catalog[$i]->secondarySuppliers as $secSupplier) { ?>
														<?php if ((isset($secSupplier->price)) or($loadInfo->isDistributorFivesRule == true)) {?>
															<li><a href="<?php echo base_url() . 'Suppliers/viewSupplier/'. $secSupplier->id;?>">
															<?php if(isset($secSupplier->logo)){ ?>
							     								<img src="<?php echo base_url() . $secSupplier->logo; ?>" style="height: 20px">
							     							<?php } else { ?>
							     								<img src="<?php echo base_url() . IMAGES_PATH . 'noProfilePic.jpg'; ?>" style="height: 20px">
															<?php } ?>
																<?php echo $secSupplier->fake_name; ?> 
																<?php if (isset($secSupplier->price)) { 
																	echo "(lo vende a $".number_format($secSupplier->price, PRICE_DECIMAL_AMOUNT, DECIMAL_SEPARATOR, THOUSANDS_SEPARATOR).")";
																} else {
																	echo "(no esta asociado)";	
																}?></a>

															</li>
														<?php } else {?>

														<?php } ?>
													<?php }?>
												</ul>
											</div>
										</td>
										<td style="text-align:center;">
											<?php if($Catalog[$i]->associationStatus == 'approved'){ ?>
												<?php if ($Catalog[$i]->isCatalogItem == false){ ?>
													<a href="<?php echo base_url() . 'Product/addProductToDistributorCatalog/'. $Catalog[$i]->id;?>">
														<button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Agregar a mi Catálogo</button>
													</a>
												<?php } else {?>
													<a href="<?php echo base_url() . 'Product/removeProductFromDistributorCatalog/'. $Catalog[$i]->id;?>">
														<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Remover de mi Catálogo</button>
													</a>
												<?php } ?>
											<?php } else {?>
												<?php echo NOT_ASSOCIATED_MESSAGE; ?>
											<?php }?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center">
							<?php if(isset($pageLinks)) foreach ($pageLinks as $link) {
								echo $link;
							}  ?>
		    			</div>
		    		</div>
				</div>
