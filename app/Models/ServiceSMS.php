<?php
//Ejemplo PHP.  Para verificar libreria CURL use phpinfo()
namespace App\Models;
use Exception;

class ServiceSMS
{
  private $token = "ODc2NTc4NTYyNjo1UUcwVko2OUlaRDE=";
  private $autorization = "Authorization: Bearer ";
  
  private $smstype = "1"; // 0: remitente largo, 1: remitente corto (varía el costo del servicio)
  private $shorturl = "0"; // acortador URL

  private $url = "";

  public function __construct()
  {
    $this->autorization .= $this->token;

    //Preparamos las variables que queremos enviar
    $this->url = 'https://api3.gamanet.pe/token/smssend';
  }

  /**
   * Envía un mensaje de texto al número consignado, retorna un valor lógico cuando se concreta la operación
   * @param string $smsnumber
   * @param string $smstext
   * @return void
   */
  public function sendSMS(string $smsnumber, string $smstext):bool
  {
    $fields_string = '';

    $fields = array(
      'smsnumber' => urlencode($smsnumber),
      'smstext' => urlencode($smstext),
      'smstype' => urlencode($this->smstype),
      'shorturl' => urlencode($this->shorturl)
    );

    //Preparamos el string para hacer POST (formato querystring)
    foreach ($fields as $key => $value) {
      $fields_string .= $key . '=' . $value . '&';
    }

    $fields_string = rtrim($fields_string, '&');

    //abrimos la conexion
    $ch = curl_init();

    //configuramos la URL, numero de variables POST y los datos POST
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', $this->autorization));
    curl_setopt($ch, CURLOPT_URL, $this->url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Descomentarlo si usa HTTPS
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    //ejecutamos POST
    $result = curl_exec($ch);

    //cerramos la conexion
    curl_close($ch);
    $resultFormat = json_decode($result, true);
    $error = intval($resultFormat['messages'][0]['error']);

    return $error == 0 ? true: false;
  }

}