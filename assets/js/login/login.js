// ---------------------------   Password   ---------------------------
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#exampleInputPassword');

togglePassword.addEventListener('click', function (e) {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  this.classList.toggle('bi-eye');
});