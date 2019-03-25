<form method="post" action="<?=BASE_URL?>/jogo/batalha" id="formBatalha">
	<div class="row justify-content-md-center">
		<div class="col-12 col-md-6">
			<div class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center active">
					Inimigos
					<span class="badge badge-warning badge-pill">Arma</span>
				</li>
				
				<?php
				foreach($tropaOrcsList as $orc)
				{
					$personagemObj = (new Models\Personagem)->getPersonagemById($orc['personagemId']);
					$armaObj = (new Models\Arma)->getArmaById($orc['armaId']);

					echo '<li class="list-group-item d-flex justify-content-between align-items-center">
							<div class="form-group form-check mb-0">
								<label class="form-check-label">'.$personagemObj->getNome().'</label>
							</div>
							<span class="badge badge-primary badge-pill">'.$armaObj->getNome().'</span>
						</li>';
				}
				?>

			</div>
		</div>
	</div>
	<div class="row justify-content-md-center mt-3">
	<div class="col-12 col-md-6">
	<input type="button" id="recuarTropa" class="btn btn-warning" value="Recuar">
	<input type="submit" id="marcharParaBatalha" class="btn btn-danger float-right" value="Marchar Para Batalha">
	</div>
	</div>
</form>

<script type="text/javascript">
	$('#recuarTropa').on('click', function()
	{
		window.location.href = '<?=BASE_URL?>/jogo/recuar';
	});
</script>