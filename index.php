<?php
    require 'autoload.php';

    //registrando lembrete em banco de dados
    if (!empty($_POST['lembrete'])) {
        $lembrete = addslashes($_POST['lembrete']);
        $data = addslashes($_POST['data']);

        
        if (date('Y-m-d', strtotime($data)) >= date('Y-m-d')) {
            $sql = (new Cadastro())->setAgenda($lembrete, $data);
            echo '<script> alert("Cadastro realizado com sucesso!"); window.location.href = "index.php"; </script>';
        } else {
            echo '<script> alert("Cadastro não realizado - Abaixo da data atual!"); window.location.href = "index.php"; </script>';
        }
        
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Agenda</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <style type="text/css">
        #lembrete{
            height: 250px;
            background-color: #000;
            color: #fff;
            font-size: 20px;
        }
        .lembretes{
            width: 100%;
            height: 25px;
            background-color: #B0C4DE;
            font-size: 18px;
            margin-top: 5px;
            text-align: center;
        }
        .lembretes:hover{
            background-color: #4682B4;
            color: #fff;
        }
        .th{
            text-align: center;
        }

        .send {
          box-shadow: 0 0 0 0 rgba(69, 152, 27, 0.5);
        }

        .send {
          animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
          0% {
            transform: scale(.9);
          }
          70% {
            transform: scale(1);
            box-shadow: 0 0 0 50px rgba(69, 152, 27, 0);
          }
          100% {
            transform: scale(.9);
            box-shadow: 0 0 0 0 rgba(69, 152, 27, 0);
          }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "portuguese");
        date_default_timezone_set('America/Sao_Paulo');

        $data = date('Y-m');
        if (utf8_decode(strftime("%B", strtotime($data))) == 'mar?o') {
            echo strftime("Março de %Y", strtotime($data));
        } else {
            echo '<h3>'.ucfirst(strftime("%B de %Y", strtotime($data))).'</h3>';
        }
        $x = 0;
        ?>
        <div class="row">
            <div class="col-sm-6">
                <h4>Agenda</h4>
            </div>
            <!-- <div class="col-sm-6">
                <select class="form-control">
                    <option>Selecione um mês</option>
                    <?php
                    $mesAtual = date('Y-m');
                    for ($i=1; $i < 13; $i++) { 
                        $dt = date('Y-'.$i);

                        if ($mesAtual == $dt) {
                            if (utf8_decode(strftime("%B", strtotime($dt))) == 'mar?o') {
                                echo '<option selected value="'.$i.'">'.ucfirst(strftime("Março", strtotime($dt))).'</option>';
                            } else {
                                echo '<option selected value="'.$i.'">'.ucfirst(strftime("%B", strtotime($dt))).'</option>';
                            }
                        } else {
                            if (utf8_decode(strftime("%B", strtotime($dt))) == 'mar?o') {
                                echo '<option value="'.$i.'">'.ucfirst(strftime("Março", strtotime($dt))).'</option>';
                            } else {
                                echo '<option value="'.$i.'">'.ucfirst(strftime("%B", strtotime($dt))).'</option>';
                            }
                        }
                        
                    }
                    ?>
                </select>
            </div> -->
        </div>
        <hr>
        <table class="table table-hover">
            <tr>
            <?php
            for ($i=1; $i <= date('t'); $i++) { 
                $x++;

                $id = 'ag'.$i;
                $v['data'] = date('Y-m-').$i;
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

                        if ($data >= date('Y-m-d')) {
                            if ($data == date('Y-m-d')) {
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

                    echo '</td>';
                } else {
                    echo '<td>';

                    //SE ESTIVER PREENCHIDO
                    if (!empty($lem)) {
                        $data = date('Y-m-d', strtotime($v['data']));

                        if ($data >= date('Y-m-d')) {
                            if ($data == date('Y-m-d')) {
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

                    echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                ?>
                <div id="<?=$id; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    <?php
                                    $dt = date('Y-m-').$i;
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
                                       echo '<div class="lembretes">'.htmlspecialchars($l['lembrete']).' - Cadastrado em: '.date('d/m/Y H:i', strtotime($l['dt_cadastro'])).'</div>';
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
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>



