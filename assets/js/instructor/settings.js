document.addEventListener('DOMContentLoaded', function() {
  if (document.getElementById('popup')) {
    // --------------------------   Phone Mask   --------------------------
    const element = document.getElementById('exampleInputTel');
    const maskOptions = {
      mask: '+{7}(000)000-00-00'
    };
    const mask = IMask(element, maskOptions);
    // ---------------------------   Password   ---------------------------
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#exampleInputPassword');
    const togglePasswordNew = document.querySelector('#togglePasswordNew');
    const passwordNew = document.querySelector('#exampleInputPasswordNew');

    togglePassword.addEventListener('click', function (e) {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('bi-eye');
    });

    togglePasswordNew.addEventListener('click', function (e) {
      const type = passwordNew.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordNew.setAttribute('type', type);
      this.classList.toggle('bi-eye');
    });
  }
});