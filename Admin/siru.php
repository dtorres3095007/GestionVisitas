<?php

class Aes
{
    /**
    * Desencriptar
    *
    * @param passphrase $passphrase passphrase
    * @param jsonString $jsonString jsonString
    *
    * @return object
    */
    private function _cryptoJsAesDecrypt($passphrase, $jsonString)
    {
        $jsondata = json_decode($jsonString, true);
        $salt = $this->_hextobin($jsondata["s"]);
        $ctt = base64_decode($jsondata["ct"]);
        $ivt = $this->_hextobin($jsondata["iv"]); 
        $md5 = array(md5($concatedPassphrase = $passphrase.$salt, true));
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++)
            $result .= $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
        return json_decode(openssl_decrypt($ctt, 'aes-256-cbc', substr($result, 0, 32), true, $ivt), true);
    }

    /**
    * Encriptar
    *
    * @param passphrase $passphrase passphrase
    * @param value      $value      value
    *
    * @return json
    */
    private function _cryptoJsAesEncrypt($passphrase, $value)
    {
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx.$passphrase.$salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);
    }

    /**
    * Encriptar
    *
    * @param hexstr $hexstr hexstr
    *
    * @return bin
    */
    private function _hextobin($hexstr)
    { 
        for($i = 0, $sbin = ""; $i < strlen($hexstr); $i+= 2)
            $sbin .= pack("H*", substr($hexstr, $i, 2));
        return $sbin; 
    }

    /**
    * Desencriptar
    *
    * @param hash $hash hash
    *
    * @return object
    */
    public function desencriptar($hash)
    {
        $key = 'aaed7ffa192a463feec46dbb6266be27';
        $json = $this->_cryptoJsAesDecrypt($key, $hash);
        return $json;
    }

    /**
    * Encriptar
    *
    * @param hash $hash hash
    *
    * @return object
    */
    public function encriptar($hash)
    {
        $key = 'aaed7ffa192a463feec46dbb6266be27';
        $json = $this->_cryptoJsAesEncrypt($key, $hash);
        return $json;
    }
}
$aes = new aes;

// Credenciales de acceso encriptadas
$hash = $aes->encriptar(json_encode(array(
    "usuario" => "preview",
    "contrasena" => "previewpreview",
    "secret" => "kCgm4XNFqwa2QzbdSd1G"
)));


$server = "olivos.cuc.edu.co";
$url = "http://{$server}/recursos/index.php/login/validarUsuario";
$ch = curl_init();


// Nos logueamos al servidor
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'hash=' . $hash);
ob_start();
$result = curl_exec($ch);
$data = ob_get_clean();
ob_end_clean();
curl_close($ch);
$data = json_decode($result);

$token = $data->datos->session_id;

/* 
Establecemos la url de acceso para el cliente
Puede recibir de parametro:
token: es el session id que haz obtenido previamente (obligatorio).
fecha: fecha que se desea consultar en formato Y-m-d
hora_inicio: hora de inicio del evento en formato H:i:s
hora_fin: hora de finalizacion del evento en formato H:i:s
reserva: consecutivo de la reserva

No es necesario loguearte cada vez que haces una peticion ya que el token es valido por 24 horas despues del ultimo acceso.
*/
$consulta=$_POST["consulta"];
//$consulta="fecha=2017-03-07";
$url = "http://{$server}/recursos/index.php/recursos/eventos/consultar?$consulta&token={$token}";
$result = file_get_contents($url);

echo $result;