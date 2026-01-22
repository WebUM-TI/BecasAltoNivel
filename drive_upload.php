<?php 

require 'conexion.php';
include 'api-google/vendor/autoload.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=becasocadminticumanizales-77636c5a3ff8.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setScopes(['https://www.googleapis.com/auth/drive.file']);   

$nombre = $_POST["name"];
$cedula = $_POST["cedula"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$tipo_programa = $_POST["tipo_programa"];
$maestrias = $_POST["maestrias"];
$doctorados = $_POST["doctorados"];
$Fecha = $_POST["Fecha"];

try {

   /// Inicio del los servicios de la api de drive
   $service = new Google_Service_Drive($client);

   /// Capturar los nombres de cada archivo adjuntado en el form
   $file_path = $_FILES['registro_civil']['tmp_name'];
   $file_path_cedula = $_FILES['fotocopia_cedula']['tmp_name'];
   $file_path_residencia = $_FILES['certicado_residencia']['tmp_name'];
   $file_path_admision = $_FILES['certificado_admision']['tmp_name'];
   $file_path_perfil_propuesta = $_FILES['perfil_propuesta']['tmp_name'];
   $file_path_carta_compromiso = $_FILES['carta_compromiso']['tmp_name'];
   $file_path_acta_pregrado = $_FILES['acta_pregrado']['tmp_name'];
   $file_path_anexo_1 = $_FILES['anexo_1']['tmp_name'];
   $file_path_certificado_notas = $_FILES['certificado_notas']['tmp_name'];
   $file_path_sisben = $_FILES['sisben']['tmp_name'];
   $file_path_autorreconocimiento = $_FILES['autorreconocimiento']['tmp_name'];
   $file_path_certificado_electoral = $_FILES['certificado_electoral']['tmp_name'];

   /// Crear un objeto file para la carpeta a crear
   $file = new Google_Service_Drive_DriveFile();
   $file->setName($nombre);

   /// Crear objetos file para cada archivo a introducir en la carpeta
   $registro_civil = new Google_Service_Drive_DriveFile();
   $registro_civil->setName($_FILES['registro_civil']['name']);
   $fotocopia_cedula = new Google_Service_Drive_DriveFile();
   $fotocopia_cedula->setName($_FILES['fotocopia_cedula']['name']);
   $certicado_residencia = new Google_Service_Drive_DriveFile();
   $certicado_residencia->setName($_FILES['certicado_residencia']['name']);
   $certificado_admision = new Google_Service_Drive_DriveFile();
   $certificado_admision->setName($_FILES['certificado_admision']['name']);
   $acta_pregrado = new Google_Service_Drive_DriveFile();
   $acta_pregrado->setName($_FILES['acta_pregrado']['name']);
   $anexo_1 = new Google_Service_Drive_DriveFile();
   $anexo_1->setName($_FILES['anexo_1']['name']);
   $perfil_propuesta = new Google_Service_Drive_DriveFile();
   $perfil_propuesta->setName($_FILES['perfil_propuesta']['name']);
   $carta_compromiso = new Google_Service_Drive_DriveFile();
   $carta_compromiso->setName($_FILES['carta_compromiso']['name']);
   $certificado_notas = new Google_Service_Drive_DriveFile();
   $certificado_notas->setName($_FILES['certificado_notas']['name']);
   $autorreconocimiento = new Google_Service_Drive_DriveFile();
   $autorreconocimiento->setName($_FILES['autorreconocimiento']['name']);
   $sisben = new Google_Service_Drive_DriveFile();
   $sisben->setName($_FILES['sisben']['name']);
   $certificado_electoral = new Google_Service_Drive_DriveFile();
   $certificado_electoral->setName($_FILES['certificado_electoral']['name']);

   /// Obtener el tipo de archivo o extension
   $finfo = finfo_open(FILEINFO_MIME_TYPE);
   $mime_type = finfo_file($finfo, $file_path);
   $mime_type_cedula = finfo_file($finfo, $file_path_cedula);
   $mime_type_residencia = finfo_file($finfo, $file_path_residencia);
   $mime_type_certificado_admision = finfo_file($finfo, $file_path_admision);
   $mime_type_acta_pregrado = finfo_file($finfo, $file_path_acta_pregrado);
   $mime_type_anexo_1 = finfo_file($finfo, $file_path_anexo_1);
   $mime_type_perfil_propuesta = finfo_file($finfo, $file_path_perfil_propuesta);
   $mime_type_carta_compromiso = finfo_file($finfo, $file_path_carta_compromiso);
   $mime_type_certificado_notas = finfo_file($finfo, $file_path_certificado_notas);
   $mime_type_sisben = finfo_file($finfo, $file_path_sisben);
   $mime_type_autorreconocimiento = finfo_file($finfo, $file_path_autorreconocimiento);
   $mime_type_certificado_electoral = finfo_file($finfo, $file_path_certificado_electoral);
   $mime_type_certificado_carta_compromiso = finfo_file($finfo, $file_path_carta_compromiso);

   /// Traer el id de la carpeta en drive donde se crea la nueva carpeta con los archivos adjuntos
   $file->setParents(array("1xLqG3jXs-jueHiAoNL8nGMQYKQ4HGqQ0"));
   $file->setDescription("Archivo cargado...");
   $file->setMimeType("application/vnd.google-apps.folder");

   /// Crear carpeta
   $folder = $service->files->create($file);
   
   /// Enlazar el id de la carpeta creada en cada uno de los archivos, obtener también el tipo de archivo
   $registro_civil->setParents(array($folder->id));
   $registro_civil->setMimeType($mime_type);        
   $fotocopia_cedula->setParents(array($folder->id));
   $fotocopia_cedula->setMimeType($mime_type_cedula);        
   $certicado_residencia->setParents(array($folder->id));
   $certicado_residencia->setMimeType($mime_type_residencia);        
   $certificado_admision->setParents(array($folder->id));
   $certificado_admision->setMimeType($mime_type_certificado_admision);        
   $acta_pregrado->setParents(array($folder->id));
   $acta_pregrado->setMimeType($mime_type_acta_pregrado);       
   $anexo_1->setParents(array($folder->id));
   $anexo_1->setMimeType($mime_type_anexo_1);       
   $perfil_propuesta->setParents(array($folder->id));
   $perfil_propuesta->setMimeType($mime_type_perfil_propuesta);     
   $carta_compromiso->setParents(array($folder->id));
   $carta_compromiso->setMimeType($mime_type_carta_compromiso);          
   $certificado_notas->setParents(array($folder->id));
   $certificado_notas->setMimeType($mime_type_certificado_notas);  
   $sisben->setParents(array($folder->id));
   $sisben->setMimeType($mime_type_sisben); 
   $autorreconocimiento->setParents(array($folder->id));
   $autorreconocimiento->setMimeType($mime_type_autorreconocimiento);   
   $certificado_electoral->setParents(array($folder->id));
   $certificado_electoral->setMimeType($mime_type_certificado_electoral);   
   
   /// Crear archivo para registro civil
   if($_FILES["registro_civil"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   {
      $resultado = $service->files->create(
            $registro_civil,
            array(
               'data' => file_get_contents($file_path),
               'mimeType' => $mime_type,
               'uploadType'=> 'media'
            )
      );
   }   

   /// Crear archivo para fotocopia cédula
   if($_FILES["fotocopia_cedula"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   {
      $resultado2 = $service->files->create(
         $fotocopia_cedula,
         array(
            'data' => file_get_contents($file_path_cedula),
            'mimeType' => $mime_type_cedula,
            'uploadType'=> 'media'
         )
      );
   }

   /// Crear archivo para certificado residencia
   if($_FILES["certicado_residencia"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   {
      $resultado3 = $service->files->create(
            $certicado_residencia,
            array(
               'data' => file_get_contents($file_path_residencia),
               'mimeType' => $mime_type_residencia,
               'uploadType'=> 'media'
            )
      );
   }   

   /// Crear archivo para certificado de admisión
   if($_FILES["certificado_admision"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   {
      $resultado4 = $service->files->create(
            $certificado_admision,
            array(
               'data' => file_get_contents($file_path_admision),
               'mimeType' => $mime_type_certificado_admision,
               'uploadType'=> 'media'
            )
      );
   }

   /// Crear archivo para acta de pregrado
   if($_FILES["acta_pregrado"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   {  
      $resultado5 = $service->files->create(
            $acta_pregrado,
            array(
               'data' => file_get_contents($file_path_acta_pregrado),
               'mimeType' => $mime_type_acta_pregrado,
               'uploadType'=> 'media'
            )
      );
   }   

   /// Formato requisito de vinculación
   if($_FILES["anexo_1"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   {  
      $resultado12 = $service->files->create(
            $anexo_1,
            array(
               'data' => file_get_contents($file_path_anexo_1),
               'mimeType' => $mime_type_anexo_1,
               'uploadType'=> 'media'
            )
      );
   }  

   /// Crear archivo para perfil de la propuesta
   if($_FILES["perfil_propuesta"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   { 
      $resultado6 = $service->files->create(
            $perfil_propuesta,
            array(
               'data' => file_get_contents($file_path_perfil_propuesta),
               'mimeType' => $mime_type_perfil_propuesta,
               'uploadType'=> 'media'
            )
      );
   }    

   /// Crear archivo para el certificado de notas
   if($_FILES["certificado_notas"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   { 
      $resultado8 = $service->files->create(
            $certificado_notas,
            array(
               'data' => file_get_contents($file_path_certificado_notas),
               'mimeType' => $mime_type_certificado_notas,
               'uploadType'=> 'media'
            )
      );
   }    

   
   /// Crear archivo para el certificado de notas
   if($_FILES["sisben"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   { 
      $resultado20 = $service->files->create(
            $sisben,
            array(
               'data' => file_get_contents($file_path_sisben),
               'mimeType' => $mime_type_sisben,
               'uploadType'=> 'media'
            )
      );
   } 

   
   /// Crear archivo para el certificado de notas
   if($_FILES["autorreconocimiento"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   { 
      $resultado20 = $service->files->create(
            $autorreconocimiento,
            array(
               'data' => file_get_contents($file_path_autorreconocimiento),
               'mimeType' => $mime_type_autorreconocimiento,
               'uploadType'=> 'media'
            )
      );
   }  

   /// Crear archivo para el certificado electoral
   if($_FILES["certificado_electoral"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   { 
      $resultado10 = $service->files->create(
            $certificado_electoral,
            array(
               'data' => file_get_contents($file_path_certificado_electoral),
               'mimeType' => $mime_type_certificado_electoral,
               'uploadType'=> 'media'
            )
      );
   }

   /// Crear archivo para la carta de compromiso
   if($_FILES["carta_compromiso"]["size"] == 0)
   {
      echo "no se adjuntaron archivos";
   }
   else
   { 
      $resultado11 = $service->files->create(
            $carta_compromiso,
            array(
               'data' => file_get_contents($file_path_carta_compromiso),
               'mimeType' => $mime_type_certificado_carta_compromiso,
               'uploadType'=> 'media'
            )
      );   
   }

   // Inicio de envio de form por mail
   //Capturo los datos enviados por POST desde el formulario
   $email2               = $_REQUEST["email"]; 
   $nombreCompleto      = $_REQUEST["name"];
   $desdEmail           = 'becasaltonivel@umanizales.edu.co'; 
   // $desdEmail           = 'web@umanizales.edu.co'; 
   // $desdEmail           = 'yomarstevenmier@gmail.com'; 
   $desdEmailRespuesta           = $_REQUEST["email"]; 
   $EmailCCOculto           = 'conectatealau@umanizales.edu.co'; 
   $EmailCCOculto2           = 'web@umanizales.edu.co'; 
   $EmailCCOculto3           = 'amcastro@umanizales.edu.co'; 
   $EmailCCOculto4           = 'mpbotero@umanizales.edu.co'; 

   //Construyo el cuerpo del mensaje    
   $message            = "Nombre: " . $nombreCompleto . "\n";
   $message            = $message . "Cédula de ciudadania: " . $cedula . "\n";
   $message            = $message . "Correo electrónico: " . $email2 . "\n";
   $message            = $message . "Celular: " . $phone . "\n";
   $message            = $message . "Tipo de programa: " . $tipo_programa . "\n";
   $message            = $message . "Programa académico: " . $maestrias . " " . $doctorados . "\n";
   $message            = $message . "Fecha: " . $Fecha . "\n";
   $message            = $message . "Carpeta en Drive: " . "https://drive.google.com/open?id=".$folder->id. "\n";
  
   //Leer el archivo y codificar el contenido para armar el cuerpo del email
   $handle              = fopen($file_tmp_name, "r");
   $content             = fread($handle, $file_size);
   fclose($handle);
   $encoded_content     = chunk_split(base64_encode($content));

   $boundary            = md5("pera");

   //Encabezados
   $headers             = "MIME-Version: 1.0\r\n"; 
   $headers            .= "From:".$desdEmail."\r\n"; 
   $headers            .= "Reply-To: ".$email2."" . "\r\n";
   $headers            .= "Bcc: ".$EmailCCOculto.", ".$EmailCCOculto2.", ".$EmailCCOculto3.", ".$EmailCCOculto4."" . "\r\n";
   $headers            .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
         
   //Texto plano
   $body               = "--$boundary\r\n";
   $body               .= "Content-Type: text/plain; charset=utf-8\r\n";
   $body               .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
   $body               .= chunk_split(base64_encode($message)); 

   /// Asunto   
   $subject            = "Convocatoria para la formación de alto nivel en el Departamento del Huila";

   //Construyo el cuerpo del mensaje de respuesta 
   $messageResp            = "Hola: " . $nombreCompleto . ", has sido postulado correctamente al proceso de 
   convocatoria para la formación de alto nivel en el Departamento del Huila, recuerda que ya debiste ser admitido a la Universidad de Manizales al programa de " . $maestrias . " " . $doctorados . "
   antes de haber hecho este proceso.\n";
   $messageResp            = $messageResp . "Fecha: " . $Fecha . "\n";
  
   //Leer el archivo y codificar el contenido para armar el cuerpo del email de respuesta
   $handle2              = fopen($file_tmp_name, "r");
   $content2             = fread($handle2, $file_size);
   fclose($handle2);
   $encoded_content2     = chunk_split(base64_encode($content2));
   $boundary2            = md5("pera");

   //Encabezados de respuesta
   $headersResp             = "MIME-Version: 1.0\r\n"; 
   $headersResp            .= "From:".$desdEmailRespuesta."\r\n"; 
   // $headersResp            .= "Reply-To: ".$email2."" . "\r\n";
   // $headersResp            .= "Bcc: ".$EmailCCOculto.", ".$EmailCCOculto2.", ".$EmailCCOculto3.", ".$EmailCCOculto4."" . "\r\n";
   $headersResp            .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
         
   //Texto plano de respuesta
   $bodyResp               = "--$boundary2\r\n";
   $bodyResp               .= "Content-Type: text/plain; charset=utf-8\r\n";
   $bodyResp               .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
   $bodyResp               .= chunk_split(base64_encode($messageResp)); 

   /// Asunto de respuesta
   $subject2            = "Hola " . $nombreCompleto . ", fuiste postulado a la convocatoria para la formación de alto nivel en el Departamento del Huila ";
   
   //Enviando el mail
   $sentMail = mail($desdEmail, $subject, $body, $headers);
   $sentMail2 = mail($desdEmailRespuesta, $subject2, $bodyResp, $headersResp);
   if(($sentMail)&& ($sentMail2)){   

      // / Insertar los datos del formulario en la base de datos
      $ruta = 'https://drive.google.com/open?id='.$folder->id;

      $sql = "INSERT INTO postulacion(nombre, cedula, correo, celular, tipo_programa, maestria, doctorado, ruta,
      fecha) VALUES('$nombre', '$cedula', '$email', '$phone', '$tipo_programa', '$maestrias', '$doctorados',
      '$ruta', '$Fecha' )";

      // echo $sql;
      $mysqli->query($sql);      
      // header('location: index.php');
   }
   else{
         echo "<h2>Se produjo un error y su postulación para la beca no pudo ser enviada</h2>";
   }    

   
   header('location: index.php');
   // Fin de envio de form por mail
} catch (Google_Service_Exception $gs) {
   $mensaje = json_decode($gs->getMessage);
   echo $mensaje->error->message();
}
catch(Exception $e)
{
   echo $e->getMessage();
}
?>
