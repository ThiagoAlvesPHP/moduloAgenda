<?php
require 'autoload.php';

if (!empty($_POST['mes'])):

	?>
        <table class="table table-hover" id="resultado">
            <tr>
            <?php
            $x = 0;
            $numero = cal_days_in_month(CAL_GREGORIAN, $_POST['mes'], date('Y'));

            for ($i=1; $i <= $numero; $i++) { 
                $x++;

                $id = 'ag'.$i;
                $v['data'] = date('Y-'.$_POST['mes'].'-'.$i);

                $lem = (new Cadastro())->getAgendasData($v['data']);

                if (date('l', strtotime($v['data'])) == 'Monday') {
                    $dia = 'Segunda-Feira';
                }
                elseif (date('l', strtotime($v['data'])) == 'Tuesday') {
                    $dia = 'Terça-Feira';
                }
                elseif (date('l', strtotime($v['data'])) == 'Wednesday') {
                    $dia = 'Quarta-Feira';
                }
                elseif (date('l', strtotime($v['data'])) == 'Thursday') {
                    $dia = 'Quinta-Feira';
                }
                elseif (date('l', strtotime($v['data'])) == 'Friday') {
                    $dia = 'Sexta-Feira';
                }
                elseif (date('l', strtotime($v['data'])) == 'Saturday') {
                    $dia = 'Sábado';
                }
                elseif (date('l', strtotime($v['data'])) == 'Sunday') {
                    $dia = 'Domingo';
                }

                if (($x % 7) != 0) {  
                    echo '<td>';
                    //SE ESTIVER PREENCHIDO
                    if (!empty($lem)) {
                        $data = date('Y-m-d', strtotime($v['data']));

                        if ($data >= date('Y-'.$_POST['mes'].'-d')) {
                            if ($data == date('Y-'.$_POST['mes'].'-d')) {
                                if ($dia == 'Sábado') {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-success btn-block send">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                                } else {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-success btn-block send">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                                }
                                
                            } else {
                                if ($dia == 'Sábado') {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-primary btn-block">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                                } else {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-primary btn-block">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                                }
                                
                            }
                        } else {
                            if ($dia == 'Sábado') {
                                echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-danger btn-block">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                            } else {
                                echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-danger btn-block">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                            }
                            
                        }
                    } else {
                        if ($dia == 'Sábado') {
                            echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-default btn-block">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                        } else {
                            echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-default btn-block">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                        }
                        
                    }

                    ?>
                <!-- MODAL PARA LEMBRETE -->
                <div id="<?=$id; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    <?php
                                    $dt = date('Y-'.$_POST['mes'].'-'.$i);
                                    $lembretes = (new Cadastro())->getAgendasData($dt);
                                    echo date('d/m/Y', strtotime($dt));
                                    ?>
                                </h4>
                            </div>

                            <div class="modal-body">
                                <p>
                                    <h3>Lembretes do dia</h3>
                                    <?php
                                    foreach ($lembretes as $l) {
                                       echo '<div class="lembretes">'.htmlspecialchars(substr($l['lembrete'], 0, 50)).' - Cadastrado em: '.date('d/m/Y H:i', strtotime($l['dt_cadastro'])).'</div>';
                                    }
                                    ?>
                                </p>
                                <hr>
                                <p>
                                    <form method="POST">
                                        <label>Lembrete</label>
                                        <input type="text" name="data" value="<?=$dt; ?>" hidden="">
                                        <textarea id="lembrete" name="lembrete" class="form-control"></textarea>
                                        <br>
                                        <button class="btn btn-primary btn-block btn-lg">Salvar</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <?php

                    echo '</td>';
                } else {
                    echo '<td>';

                    //SE ESTIVER PREENCHIDO
                    if (!empty($lem)) {
                        $data = date('Y-m-d', strtotime($v['data']));

                        if ($data >= date('Y-'.$_POST['mes'].'m-d')) {
                            if ($data == date('Y-'.$_POST['mes'].'-d')) {
                                if ($dia == 'Sábado') {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-success btn-block send">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                                } else {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-success btn-block send">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                                }
                                
                            } else {
                                if ($dia == 'Sábado') {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-primary btn-block">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                                } else {
                                    echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-primary btn-block">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                                }
                                
                            }
                        } else {
                            if ($dia == 'Sábado') {
                                echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-danger btn-block">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                            } else {
                                echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-danger btn-block">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                            }
                            
                        }
                    } else {
                        if ($dia == 'Sábado') {
                            echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-default btn-block">'.$i.'<br>'.substr($dia, 0, 4).'</button>';
                        } else {
                            echo '<button title="'.$dia.'" data-toggle="modal" data-target="#'.$id.'" class="btn btn-default btn-block">'.$i.'<br>'.substr($dia, 0, 3).'</button>';
                        }
                        
                    }

                    ?>
                <!-- MODAL PARA LEMBRETE -->
                <div id="<?=$id; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    <?php
                                    $dt = date('Y-'.$_POST['mes'].'-'.$i);
                                    $lembretes = (new Cadastro())->getAgendasData($dt);
                                    echo date('d/m/Y', strtotime($dt));
                                    ?>
                                </h4>
                            </div>

                            <div class="modal-body">
                                <p>
                                    <h3>Lembretes do dia</h3>
                                    <?php
                                    foreach ($lembretes as $l) {
                                       echo '<div class="lembretes">'.htmlspecialchars(substr($l['lembrete'], 0, 50)).' - Cadastrado em: '.date('d/m/Y H:i', strtotime($l['dt_cadastro'])).'</div>';
                                    }
                                    ?>
                                </p>
                                <hr>
                                <p>
                                    <form method="POST">
                                        <label>Lembrete</label>
                                        <input type="text" name="data" value="<?=$dt; ?>" hidden="">
                                        <textarea id="lembrete" name="lembrete" class="form-control"></textarea>
                                        <br>
                                        <button class="btn btn-primary btn-block btn-lg">Salvar</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <?php

                    echo '</td>';
                    echo '</tr>';
                    //echo '<tr>';
                }
                }
            ?>
            </tbody>
        </table>
    <?php

endif;