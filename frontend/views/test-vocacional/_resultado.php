<?php
	use yii\helpers\Html;
?>
<center >
    <h3 class='visible-print'>Unidad Educativa Fiscomisional<br> Tecnica Deportiva <br> "San Daniel Comboni" <br> Esmeraldas - Ecuador</h3>
    <br>
</center>
<h2>Resultados del Test Vocacional  <?= Html::a('Imprimir Resultado','#', ['class' => 'btn btn-info hidden-print','onClick'=>'window.print()']) ?></h2>
<hr>
<p>De acuerdo con lo contestado por el Estudiante <b><?=$model->idAlumno->apellido_paterno." ".$model->idAlumno->apellido_materno." ".$model->idAlumno->nombre ?></b> en el Test de Vocación usted debería seguir cualquiera de las carreras que esten en la siguientes area : </p>
<br><br>
<?php if($area=="A1"){ ?>
<h4>Creatividad y Artes</h4>
<br><br>
<ul>
	<li>Diseño de gráfico</li>
	<li>diseño y decoración de interiores</li>
	<li>diseño de jardines</li>
	<li>diseño de modas</li>
	<li>diseño de joyas</li>
	<li>artes plásticas</li>
	<li>( pinturas,estructuras,danza,teatro y artesanías)</li>
	<li>dibujo publicitario</li>
	<li>restauración</li>
	<li>museología</li>
	<li>modelaje</li>
	<li>fotografía</li>
	<li>fotografía digital</li>
	<li>gestión gráfica y publicitaria</li>
	<li>locución y publicidad</li>
	<li>actuación y camareografía</li>
	<li>art</li>
	<li>industrial</li>
	<li>producción audiovisual</li>
	<li>multimedia</li>
	<li>comunicación y producción en radio y televisión</li>
	<li>diseño de paisaje</li>
	<li>cine y video</li>
	<li>comunicación escénica para televisión</li>
</ul>
<?php }elseif ($area=="A2") { ?>	
<h4>Ciencias Sociales</h4>
<br><br>
<ul>
	<li>Psicología en general</li>
	<li>trabajo social</li>
	<li>idiomas</li>
	<li>educación internacional</li>
	<li>histórica y geográfica</li>
	<li>periodismos</li>
	<li>periodism</li>
	<li>digital</li>
	<li>derecho</li>
	<li>ciencia</li>
	<li>política</li>
	<li>sociología</li>
	<li>antropología</li>
	<li>arqueología</li>
	<li>gestión social y desarrollo</li>
	<li>consejería familiar</li>
	<li>comunicación y publicidad.</li>
	<li>Administración educativa</li>
	<li>educación especial</li>
	<li>psicopedagogía</li>
	<li>estimulación temprana<li>
	<li>traducción simultánea<li>
	<li>lingüística<li>
	<li>educación de párvulos<li>
	<li>bibliotecas<li>
	<li>museología<li>
	<li>relaciones internacionales <li>
	<li>diplomacia<li>
	<li>comunicación social mención marketing y gestión de empresas<li>
	<li>redacción creativa y publicitaria<li>
	<li>relació<li>
	<li>pública y comunicación organizacional: hotelería y turismo<li>
	<li>teología industrial<li>
</ul>
<?php }elseif ($area=="A3") { ?>	
<h4>Ciencias Administrativas Económicas y Financieras</h4>
<br><br>
<ul>
	<li>Administración de empresas</li>
	<li>contabilidad</li>
	<li>auditoría</li>
	<li>ventas</li>
	<li>marketing estratégico</li>
	<li>gestión y negocios internacionales</li>
	<li>gestión empresarial</li>
	<li>gestión financiera</li>
	<li>ingeniería comercial</li>
	<li>comercio exterior</li>
	<li>banca y finanzas</li>
	<li>gestión de rrhh</li>
	<li>comunicación integradas en marketing</li>
	<li>administración de empresas</li>
	<li>ecoturismo y hospitalidad</li>
	<li>ciencia económicas y financieras,</li>
	<li>Administración de ciencias públicas</li>
	<li>ciencias empresariales</li>
	<li>comercio electrónico</li>
	<li>emprendedores</li>
	<li>gestión de organismos públicos (municipios, ministerios ,etc.) </li>
	<li>gestión de centros educativos</li>
</ul>
<?php }elseif ($area=="A4") { ?>	
<h4>Ciencias Tecnológicas y Mecanicas</h4>
<br><br>
<ul>
	<li>Ingeniería en sistemas</li>
	<li>computacionales</li>
	<li>geología</li>
	<li>ingeniería civil</li>
	<li>arquitectura</li>
	<li>electrónica</li>
	<li>telemática</li>
	<li>telecomunicaciones</li>
	<li>ingeniería mecatrónica</li>
	<li>(robótica)</li>
	<li>imagen y sonidos</li>
	<li>minas y petróleos</li>
	<li>metalurgia</li>
	<li>ingenierí</li>
	<li>mecánica</li>
	<li>ingeniería industrial</li>
	<li>física matemática</li>
	<li>ingeniería en estadística</li>
	<li>ingeniería automotriz</li>
	<li>biotecnologí</li>
	<li>ambiental</li>
	<li>ingeniería geográfica</li>
	<li>carreras militares (marina, aviación, ejército)</li>
	<li>ingeniería en costas y obras portuarias</li>
	<li>estadística</li>
	<li>informática</li>
	<li>desarrollo de sistemas</li>
	<li>tecnología de informática educativa</li>
	<li>astronomía</li>
	<li>ingeniería en ciencia</li>
	<li>geográficas y desarrollo sustentable.</li>
</ul>
<?php }elseif ($area=="A5") { ?>	
<h4>Ciencias Médicas, Biológicas y Ecológicas</h4>
<br><br>
<ul>
	<li>Biología</li>
	<li>bioquímica</li>
	<li>farmacia</li>
	<li>biología marina</li>
	<li>bioanálisis</li>
	<li>biotecnología</li>
	<li>ciencias ambientales</li>
	<li>agronomía</li>
	<li>horticultura</li>
	<li>fruticultura</li>
	<li>ingeniería en alimentos</li>
	<li>gastronomía</li>
	<li>chef</li>
	<li>cultura física</li>
	<li>deportes y rehabilitación</li>
	<li>gestió</li>
	<li>ambiental</li>
	<li>ingeniería ambiental</li>
	<li>optometría</li>
	<li>homeopatía</li>
	<li>reflexología</li>
</ul>
<?php } ?>