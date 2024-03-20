const passwordInputs = document.querySelectorAll('.password');
const togglePasswords = document.querySelectorAll('.togglePassword');

togglePasswords.forEach((togglePassword, index) => {
  togglePassword.addEventListener('click', function () {
    const type = passwordInputs[index].getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInputs[index].setAttribute('type', type);
    togglePassword.classList.toggle('fa-eye-slash');
    togglePassword.classList.toggle('fa-eye');
  });
});