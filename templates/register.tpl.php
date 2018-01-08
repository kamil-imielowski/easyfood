<div class="login-page">
  <div class="container">
    <div class="form-outer text-center align-items-center">
      <div class="form-inner">
        <div class="logo text-uppercase"><span>Easy</span><strong class="text-primary">Food</strong> Rejestracja</div>
        <form id="register-form">
          <div class="alert alert-danger" style="display: none;">
            <strong>Error!</strong> <span id="err">Indicates a dangerous or potentially negative action.</span>
          </div>
            <div class="form-group">
              <label for="email" class="label-custom">Email Address      </label>
              <input id="email" type="email" name="registerEmail" required>
            </div>
            <div class="form-group">
              <label for="passowrd" class="label-custom">Password</label>
              <input id="passowrd" type="password" name="registerPassword" required>
            </div>

            <div class="terms-conditions d-flex justify-content-center">
              <input id="res" type="checkbox" class="form-control-custom">
              <label for="res">Restauracja?</label>
            </div>

            <div class="form-group res-grp" style="display: none;">
              <label for="res_name" class="label-custom">Nazwa restauracji</label>
              <input id="res_name" type="text" name="res_name">
            </div>

            <div class="form-group row us-grp">
              <div class="col">
                <label for="firstname" class="label-custom">firstname</label>
                <input id="firstname" type="text" name="firstname">
              </div>
              <div class="col">
                <label for="lastname" class="label-custom">lastname</label>
                <input id="lastname" type="text" name="lastname">
              </div>
            </div>

            <div class="form-group">
              <label for="street" class="label-custom">Street</label>
              <input id="street" type="text" name="street" required>
            </div>



            <div class="form-group row">
              <div class="col">
                <label for="postcode" class="label-custom">postcode        </label>
                <input id="postcode" type="text" name="postcode" required>
              </div>
              <div class="col">
                <label for="city" class="label-custom">city        </label>
                <input id="city" type="text" name="city" required>
              </div>
            </div>

            <div class="form-group">
              <label for="phone" class="label-custom">Phone</label>
              <input id="phone" type="text" name="street" required>
            </div>

            <div class="terms-conditions d-flex justify-content-center">
              <input id="license" type="checkbox" class="form-control-custom">
              <label for="license">Agree the terms and policy</label>
            </div>
            <input id="register" type="submit" value="Register" class="btn btn-primary">
          </form>
          <small>Posiadasz już konto? </small><a href="login.html" class="signup">Zaloguj</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var MOD = "user";
  var ACT = "register";
  var API = base_url+'api/'+MOD+'/'+ACT+'/';
</script>
