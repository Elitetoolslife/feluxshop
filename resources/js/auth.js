document.addEventListener('DOMContentLoaded', function () {
       const registerForm = document.getElementById('register-form');
       const loginForm = document.getElementById('login-form');

       if (registerForm) {
           registerForm.addEventListener('submit', function (e) {
               e.preventDefault();
               const formData = new FormData(registerForm);
               fetch('/register', {
                   method: 'POST',
                   body: formData,
                   headers: {
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                   },
               })
                   .then(response => response.json())
                   .then(data => {
                       if (data.errors) {
                           // Show validation errors
                       } else {
                           // Show success toast
                       }
                   });
           });
       }

       if (loginForm) {
           loginForm.addEventListener('submit', function (e) {
               e.preventDefault();
               const formData = new FormData(loginForm);
               fetch('/login', {
                   method: 'POST',
                   body: formData,
                   headers: {
                       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                   },
               })
                   .then(response => response.json())
                   .then(data => {
                       if (data.error) {
                           // Show error toast
                       } else {
                           // Show success toast and redirect
                       }
                   });
           });
       }
   });