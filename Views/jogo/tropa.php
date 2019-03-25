<form method="post" action="<?=BASE_URL?>/jogo/tropa" id="formTropa">
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <div class="list-group">

                <?php if(isset($errMsg) && !empty($errMsg)): ?>
                <div class="alert alert-danger">
                    <h5 class="text-center mb-0"><?=$errMsg?></h5>
                </div>
                <?php endif; ?>

                <li class="list-group-item d-flex justify-content-between align-items-center active">
                    Personagem
                </li>

                <?php
                foreach($personagemList as $key => $personagemObj)
                {
                    $classeObj = (new Models\PersonagemClasse)->getClasseById($personagemObj->getClasseID());

                    if(isset($_POST['tropa'][$key]))
                        $checked = 'checked';
                    else
                        $checked = '';

                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-group form-check mb-0">
                                <input type="checkbox" class="form-check-input personagem" name="tropa['.$key.']" value="'.$personagemObj->getID().'" '.$checked.'>
                                <label class="form-check-label">'.$personagemObj->getNome().' ('.$classeObj->getNome().')</label>
                            </div>
                            <span class="badge badge-primary badge-pill">
                                Força: '.$personagemObj->getForca().'
                            </span>
                            <span class="badge badge-primary badge-pill">
                                Destreza: '.$personagemObj->getDestreza().'
                            </span>
                            <span class="badge badge-primary badge-pill">
                                Magia: '.$personagemObj->getMagia().'
                            </span>
                        </li>';
                }
                ?>
 
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center mt-3">
        <div class="col-12 col-md-6">
            <input id="enviaTropa" type="submit" name="submit" class="btn btn-primary float-right" value="Enviar Tropa">
        </div>
    </div>
</form>