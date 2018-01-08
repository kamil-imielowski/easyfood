<div class="login-page">
  <div class="container">
    <div class="form-outer text-center d-flex align-items-center">
      <div class="form-inner">
        <div class="logo text-uppercase"><span>Easy</span><strong class="text-primary">Food</strong> Logowanie</div>
        <form id="login-form" method="post">
          <div class="alert alert-danger" style="display: none;">
            <strong>Error!</strong> <span id="err">Indicates a dangerous or potentially negative action.</span>
          </div>
          <div class="form-group">
            <label for="login-username" class="label-custom">Email</label>
            <input id="login-username" type="text" name="loginUsername" required="">
          </div>
          <div class="form-group">
            <label for="login-password" class="label-custom">Password</label>
            <input id="login-password" type="password" name="loginPassword" required="">
          </div>  <input id="login" type="submit" value="Login" class="btn btn-primary">
        </form><small>Nie posiadasz konta? </small><a href="register.html" class="signup">Zarejestruj się!</a>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  var MOD = "user";
  var ACT = "login";
  var API = base_url+'api/'+MOD+'/'+ACT+'/';
</script>
