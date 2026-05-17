
<div class="input-group mb-3">
                    <input type="password" class="form-control text-center" id="passwordInput" 
                    name="password" required autofocus placeholder="Enter password">
                    <div class="input-group-append">
                    <span class="input-group-text toggle-password" id="togglePassword">
                      <i class="fas fa-eye-slash"></i>
                    </span>
                  </div>
                  </div>


                  <script>
  const passwordInput = document.getElementById("passwordInput");
  const togglePassword = document.getElementById("togglePassword");

  togglePassword.addEventListener("click", () => {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
    } else {
      passwordInput.type = "password";
      togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }
  });
</script>