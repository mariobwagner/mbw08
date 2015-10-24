<?php
// Starts/keeps session, sets DB constants and loads user class
require_once("include/functions.php"); 

if (!isset($_SESSION['s_formAttempt'])) {
	$user = new User;
	$user->logout();
} 

$ua=getBrowser();
$browser=$ua['name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style_01.css" />
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/login_validate.js"></script>
	<title>Login</title>
</head>

<body>
<fieldset style = "width: 700px; margin: 0px auto;" class="login_fldset" >
  <?php include('page_header.php'); ?>

  <br />
 
  <!-- *** Message area begins here -->	
  <fieldset style = "width: 80%; margin: 0px auto;" class="msg_fldset">
    <table width="100%" border="0" cellspacing="3" cellpadding="3" align="center">
      <tr>
        <td align="center" width="100%">
          <div id="error_message_01" class="error_div">
            &nbsp;
            <?php
            print " ";
            if (isset($_SESSION['s_error']) && isset($_SESSION['s_formAttempt'])) {
              print $_SESSION['s_error'] . " (by PHP)";
              unset($_SESSION['s_error']);
              unset($_SESSION['s_formAttempt']);
            } //end if
            ?>
          </div>
        </td>
      </tr>
    </table>
  </fieldset>
  <!-- *** Message area ends here -->

  <br />

  <fieldset style = "width: 380px; margin: 0px auto;" class="inner_login_fldset">
    
    <form id="login_form" method="POST" action="login_proc.php">
      <table width="99.9%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eeeeee">
        <tr>
          <td colspan='2' align="center" bgcolor="#dcdcdc" >
            <span class="login_table_name"><br/>Faça seu Login<br/><br/></span>
          </td>
        </tr>
        
        <tr>
          <td width='10%'>
            <br/><br/>
          </td>
          <td align='left' valign='bottom'>
            <span class="login_table_label">Usuário</span>
          </td>
        </tr>
        
        <tr>
          <td colspan='2' align="center">
            <input type="text" name="email" id="email" size="48" required />
            <input type="hidden" name="browser" value="<?php echo $browser; ?>">
          </td>
        </tr>
        
        <tr>
          <td width='10%'>
            <br/><br/>
          </td>
          <td align='left' valign='bottom'>
            <span class="login_table_label">Senha</span>
          </td>
        </tr>
        
        <tr>
          <td colspan='2' align="center">
            <input type="password" name="password"  id="password" size="48" required />
          </td>
        </tr>
        
        <tr>
          <td colspan='2' align="center">
            <br/>
            <input type="submit" name="submit" id="submit" value="Login" disabled="disabled" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" name="forgot_pass" id="forgot_pass" value="Esqueci minha senha" disabled="disabled" 
              onclick="window.location.href='pass_recovery.php'" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" name="sair" id="sair" value="Sair" onclick="window.location.href='goodbye_screen.php'" />
            <br/>
          </td>
        </tr>
        
        <tr>
          <td colspan='2'>&nbsp;</td>
        </tr>
        
      </table>
    </form>
    
  </fieldset>

  <br />
  <br />

  <fieldset style = "width: 500px; margin: 0px auto;" class="login_fldset">
      <table width="100%" border="0" cellspacing="3" cellpadding="3" align="center">
        <tr>
          <td align="center">
            Em caso de dificuldade para fazer Login, entre em contato <br />
            com o administrador (mariowagner@medbase.com.br).
          </td>
        </tr>
        <tr>
          <td align="center">
            <noscript>
              <br />
              <hr width="90%" size="1" />
              <br />
              Este sistema foi otimizado para utilização em navegadores com a <br />
              linguagem <strong>JavaScript</strong> habilitada.<br /><br />
              Aparentemente, seu navegador <font size="2" color="red"><strong>não está com JavaScript habilitada</strong></font>,<br /> 
              o que impossibilita a utilização. <br /><br />
              Clique 
              <a href="http://www.enable-javascript.com/"><font size="2" color="blue"><strong>
              aqui</strong></font></a>
              para obter instruções de como habilitar <br />
              a linguagem JavaScript no seu navegador.
            </noscript>
          </td>
        </tr>
      </table>
  </fieldset>

  <?php
  // PHP function to detect user browser
  function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'um navegador não identificado';
    $platform = 'não identificado';
    
    //First get the platform?
    if (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'Mac';
    }
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'Linux';
    }
    if (preg_match('/windows|win32|win64/i', $u_agent)) {
        $platform = 'Windows';
    }
      
    // Next get the name of the useragent - yes separately and for good reason.
    if (preg_match('/Chrome/i',$u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    if (preg_match('/Firefox/i',$u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    if (preg_match('/Safari/i',$u_agent) && !preg_match('/Chrome/i',$u_agent) ) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    if (preg_match('/Opera/i',$u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    }
    if (preg_match('/Netscape/i',$u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    if ( (preg_match('/MSIE/i',$u_agent) or preg_match('/Trident/i',$u_agent)) && !preg_match('/Opera/i',$u_agent) ) {
        $bname = 'Internet Explorer';
        $ub = "Internet Explorer";
    }
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'platform'  => $platform,
    );
  }
  //var_dump(get_defined_vars());
  ?>

  <br />
  <br />

</fieldset>
<?php
include('page_footer.php');
//var_dump(get_defined_vars());
?>

</body>
</html>