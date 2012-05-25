<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>New User</title>
<LINK rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript">

  function isblank(s)
  {
    for (var i = 0; i < s.length; i++) {
      var c = s.charAt(i);
      if ((c != ' ') && (c != '\n') && (c != '\t'))
        return false;
    }
    return true;
  }

  function verify(f)
  {
    var msg = "";
    var empty_fields = "";

    // for each form element
    for(var i = 0; i < f.length; i++) {
      var e = f.elements[i];
      if (((e.type == 'text') || (e.type == 'textarea')) && !e.optional) {
        if ((e.value == null) || (e.value == '') || isblank(e.value)) {
	  empty_fields += "\n    " + e.name;
	  continue;
	}
      }
    }
    if (!empty_fields && samePasswd(f))
      return true;

    msg =  "-------------------------------------------------------------\n\n";
    msg += "The form was not submitted because of the following error(s).\n";
    msg += "Please correct the errors and re-submit\n";
    msg += "-------------------------------------------------------------\n\n";
    if (empty_fields)
      msg += "- The following required field(s) are empty:" + empty_fields + "\n";
    if (! samePasswd(f))
      msg += "- The passwords did not match.\n";
    alert(msg);
    return false;
  }

  function samePasswd(f) {
    if (f.passwd.value != f.passwd2.value) {
      return false;
    }
    return true;
  }

</script>
</head>
<body>
<h1>Create a new user account</h1>
<p>If you have cookies enabled in your browser, it can 'remember' your login for next
time. This is just a convenience.</p>

  <form name='login' action="../users/create-account.php?referer=<?= $HTTP_SERVER_VARS[HTTP_REFERER] ?>" method="post" onSubmit="this.fullname.optional = true; return verify(this);">
  <table summary="Create a new account">
    <tr>
      <th>Login name:*</th><td><input type="text" name="username"/></td>
    </tr>
    <tr>
      <th>Password:*</th><td><input type="password" name="passwd"/></td>
    </tr>
    <tr>
      <th>Password:*</th><td><input type="password" name="passwd2"/></td>
    </tr>
    <tr>
      <th>Full name:</th><td><input type="text" name="fullname"/></td>
    </tr>
    <tr>
      <td align="right" colspan="2"><input type="submit" name="submit" value="login"/></td>
    </tr>
  </table>
  </form>
</body>
</html>