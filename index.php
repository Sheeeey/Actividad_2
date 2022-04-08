<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unna&display=swap" rel="stylesheet">
    <title>Carta sushi</title>
</head>
<body>
<header class="eva-heading">
    <h2 class="eva-heading__title">NEON</h2>
    <h2 class="eva-heading__title">GENESIS</h2>
    <h1 class="eva-heading__title">SUSHI</h1>
    <h3 class="eva-heading__episode-number">EPISODE: 4</h3>
    <h4 class="eva-heading__episode-title">
    Japanese Restaurant<br>By: Sheyla Suanez Espinoza
    </h4>
  </header>
<!-- <div class="row">
      <div class="column-3 menu">
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>
        <p>Sopa</p>

      </div>
      <div class="column-66">
        <div class="row">
            <div class="column-3 item">
            <h1>comida</h1>
            <h2>precio</h2>
            <h3>descripción</h3>
            </div>
            <div class="column-3 item">
            <h1>comida</h1>
            <h2>precio</h2>
            <h3>descripción</h3>       
            </div>
            <div class="column-3 item">
            <h1>comida</h1>
            <h2>precio</h2>
            <h3>descripción</h3>     
            </div>
        </div>
        <div class="row">
            <div class="column-3 item">
            <h1>comida</h1>
            <h2>precio</h2>
            <h3>descripción</h3>
            </div>
            <div class="column-3 item">
            <h1>comida</h1>
            <h2>precio</h2>
            <h3>descripción</h3>                
            </div>
            <div class="column-3 item">
            <h1>comida</h1>
            <h2>precio</h2>
            <h3>descripción</h3>                
            </div>

        </div>
      </div>

  </div> -->
  <?php
      if (file_exists('restaurante.xml')) {
        $carta = simplexml_load_file('restaurante.xml');
    } else {
        exit('Error abriendo restaurante.xml');
    }
    $tipos = array();

    //ORDENAR XML POR TIPOS EN $tipos
    $tiposInsertados = array();
    foreach($carta->plato as $plato) {
        if (!in_array((string)$plato->nombre["type"], $tiposInsertados)) {
            $tipoTexto = (string)$plato->nombre["type"];
            array_push($tiposInsertados, $tipoTexto);
            $actualTipo = array();
            foreach($carta->plato as $plato2) {
                if ($tipoTexto == (string)$plato2->nombre["type"]) {
                    array_push($actualTipo, $plato2);
                }
            }
            array_push($tipos, $actualTipo);
        }
    }
//Imprimir xml 
    print('
    <div class="row">
    <div class="column-3 menu">
    ');
    foreach($tipos as $type){
        print('<a href="index.php?type='.$type[0]->nombre['type'].'">'.$type[0]->nombre['type'].'</a><br>');
    }
    print('
    </div>
    <div class="column-66">
    <div class="row">
    ');
    foreach($tipos as $type){
        $platos=0;
        
        foreach($type as $plato){
     
            if(isset($_GET['type'])){
                if((string)$plato->nombre['type']==$_GET['type']){
                    $platos++;
                    print('
                    <div class="column-3 item">
                    <img src="./img/'.$plato->nombre.'.jpg" alt="" width="100%">
                    <h1>'.$plato->nombre.'</h1>
                    <h2>'.$plato->descripcion.'</h2>
                    <h3>'.$plato->precioeuros.' - '.$plato->calorias.'</h3>
                    ');
                    foreach($plato->caracteristicas as $item) {
                        foreach($item as $ite) {
                            print('<img src="./img/'.$ite.'.svg" alt="'.$ite.'" width="15%" style="filter: invert(1); margin-right: 4%;">');
                        }
                    }
                    print ('</div>
                    ');
                    if($platos%3==0){
                        print('
                        </div>
                        <div class="row">
                        ');
                    }
                }

            }
    
        }
    }
    print('
    </div>

     </div>
    </div>
    ');
?>
</body>
</html>