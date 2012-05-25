<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>New User</title>
<LINK rel="stylesheet" type=text/css href="styles/table.css" title="php-style">
<script language="JavaScript" src="javascript/cookies.js"></script>
<script language="JavaScript">
  function verifyData(this)
  {
    if (empty(this)) {
      alert("Empty " . this.name . " not allowed!");
      return false;
    }
    return true;
  }
</script>
</head>
<body>
<h1>Login</h1>

  <p>If the account does not exist, one will be created for you</p>

  <form name='login' action="create-account.php?referer=<?= $HTTP_REFERER ?>" method="post">
  <table summary="Create a new account">
    <tr>
      <th>Login name:*</th><td><input type="text" name="login" onChange="verifyData();"/></td>
    </tr>
    <tr>
      <th>Password:*</th><td><input type="password" name="passwd" onChange="verifyData();"/></td>
    </tr>
    <tr>
      <th>Full name:</th><td><input type="text" name="fullname"/></td>
    </tr>
    <tr>
      <td align="right" colspan="2"><input type="submit" name="submit" value="Login" onClick="verifyData(this.form.login); verifyData(this.form.passwd);/></td>
    </tr>
  </table>
  </form>
</body>
</html>