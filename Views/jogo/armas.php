<form method="post" action="<?=BASE_URL?>/jogo/armas" id="formArma">
	<div class="row justify-content-md-center">
		<div class="col-12 col-md-6">
			<div class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center active">
				Armas
				</li>

				<?php
				foreach($personagemList as $key => $personagemObj)
				{
					echo '<li class="list-group-item d-flex justify-content-between align-items-center">
								<div class="form-group form-check mb-0">
									<label class="form-check-label">'.$personagemObj->getNome().'</label>
								</div>
								<div class="float-rigth">
									<select class="custom-select custom-select-sm selectArmas" name="armas['.$key.']">
										<option value="">Selecione uma Arma</option>';

					foreach($armasList as $armaObj)
					{
						echo '<option value="'.$armaObj->getID().'">'.$armaObj->getNome().'</option>';
					}

					echo '</select>
								</div>
							</li>';
				}
				?>

			</div>
		</div>
	</div>
	<div class="row justify-content-md-center mt-3">
		<div class="col-12 col-md-6">
			<input type="button" id="atribuiArmas" class="btn btn-primary float-right" value="Entrega Armas">
		</div>
	</div>
</form>

<script type="text/javascript">
	$('.selectArmas').on('change', function()
	{
		var armasSelecionadas = [];
		var principal = $(this);

		$('.selectArmas').find('option:selected').each(function()
		{
			if ($(this).val() !== '')
			{
				if (armasSelecionadas.indexOf($(this).val()) >= 0)
				{
					alert('Arma já selecionada, por favor escolha outra.');
					principal.val('');
				}
				else
					armasSelecionadas.push($(this).val());
			}
		});
	});

	$('#atribuiArmas').on('click', function()
	{
		var count = 0;
		
		$('.selectArmas').find('option:selected').each(function()
		{
			if ($(this).val() === '')
			{
				alert('Atribua armas à todos os personagens.');
				return false;
			}
			else
				count++;

			if(count == 5)
				$('#formArma').submit();
		});
	});
</script>