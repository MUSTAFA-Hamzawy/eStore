<?php


class SessionWrapper extends SessionHandler
{
  private string $sessionName;
  private float $sessionMaxLifeTime;
  private bool $sessionSSL;
  private bool $sessionHTTPOnly;
  private string $sessionPath;
  private string $sessionSavePath;
  private string $sessionDomain;           //To make cookies visible on all subdomains
  private string $sessionCipherAlgorithm;
  private string $sessionCipherKey;
  private float $sessionTimeToLive;       // used to change the id after some time ( in  hours )


  private function initializeDataMembers(){
    $this->sessionName = SESSION_NAME;
    $this->sessionMaxLifeTime = SESSION_MAX_LIFE_TIME;
    $this->sessionSSL = false;              // not a secure connection
    $this->sessionHTTPOnly = true;        //prevent JS access to session cookie
    $this->sessionPath = SESSION_PATH;
    $this->sessionSavePath = SESSIONS_DIR;
    $this->sessionDomain = SESSIONS_DOMAIN;
    $this->sessionCipherAlgorithm = SESSIONS_CIPHER_METHOD;
    $this->sessionCipherKey = openssl_random_pseudo_bytes(openssl_cipher_iv_length(SESSIONS_CIPHER_METHOD));
    $this->sessionTimeToLive = 24;
  }

  public function __construct(){
    $this->initializeDataMembers();

    // override values in the php.ini
    ini_set("session.use_cookies", 1);  // to make the session uses cookies
    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_trans_sid", 0);
    ini_set("session.save_handler", "files");

    // session parameters
    session_name($this->sessionName);
    session_save_path($this->sessionSavePath);
    session_set_cookie_params([
      'lifetime' => $this->sessionMaxLifeTime,
      'path'     => $this->sessionPath,
      'secure'   => $this->sessionSSL,
      'httponly' =>  $this->sessionHTTPOnly
    ]);

    session_set_save_handler($this, true);
  }

  public function __isset($key)
  {
    return isset($_SESSION[$key]);
  }

  public function __get($key){
    return isset($key) ? $_SESSION[$key] : false;
  }

  public function __set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  private function setSessionStartTime(){
    if (! isset($this->sessionStartTime))
      $this->sessionStartTime = time();
  }

  private function sessionRenew(){
    $this->sessionStartTime = time();
    session_regenerate_id(true);
  }

  private function checkSessionExpirationTime(){
    if ((time() - $this->sessionStartTime) > ($this->sessionTimeToLive * 60 * 60))
      return $this->sessionRenew();
    return true;
  }

  public function start(){
    if (empty(session_id()))
    {
        if (@session_start())
        {
          $this->setSessionStartTime();
          $this->checkSessionExpirationTime();
        }
    }
  }

  public function read($session_id)
  {
    return openssl_decrypt(parent::read($session_id), $this->sessionCipherAlgorithm, $this->sessionCipherKey);
  }

  public function write($session_id, $session_data)
  {
    $initializationVector =  openssl_random_pseudo_bytes(openssl_cipher_iv_length(SESSIONS_CIPHER_METHOD));
    return parent::write($session_id, openssl_encrypt($session_data, $this->sessionCipherAlgorithm,
        $this->sessionCipherKey, $options = 0, $initializationVector));
  }

  public function sessionDestroy(){
    session_unset();
    setcookie($this->sessionName, '', time() - 3600, $this->sessionPath, $this->sessionDomain, $this->sessionSSL,
        $this->sessionHTTPOnly);
    session_destroy();

  }
}