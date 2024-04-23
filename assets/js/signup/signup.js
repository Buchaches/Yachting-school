// ---------------------------   Phone Mask   ---------------------------
const element = document.getElementById('exampleInputTel');
const maskOptions = {
  mask: '+{7}(000)000-00-00'
};
const mask = IMask(element, maskOptions);

// ---------------------------   Password   ---------------------------
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#exampleInputPassword');

togglePassword.addEventListener('click', function (e) {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  this.classList.toggle('bi-eye');
});