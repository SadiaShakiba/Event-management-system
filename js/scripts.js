const eyeIcon = document.getElementById("eye");
const passwordField = document.getElementById("password");
eyeIcon.addEventListener("click", () => {
  if (passwordField.type === "password" && passwordField.value) {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  }
});

const confirmEyeIcon = document.getElementById("eyeConfirmPassword");
const confirmPasswordField = document.getElementById("confirmPassword");

confirmEyeIcon.addEventListener("click", () => {
  if (confirmPasswordField.type === "password" && confirmPasswordField.value) {
    confirmPasswordField.type = "text";
    confirmEyeIcon.classList.remove("fa-eye");
    confirmEyeIcon.classList.add("fa-eye-slash");
  } else {
    confirmPasswordField.type = "password";
    confirmEyeIcon.classList.remove("fa-eye-slash");
    confirmEyeIcon.classList.add("fa-eye");
  }
});
