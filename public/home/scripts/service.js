const inputEmail = document.querySelector('.has-email');
const span = document.querySelector('.has-email-span');
const validEmail = document.querySelector('.valid-email');

function validateEmail(email) {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(email);
}

inputEmail.addEventListener('input', function() {
  const userEmail = inputEmail.value;
  const isValidEmail = validateEmail(userEmail);

  if (inputEmail.value !== '') {
    span.style.transform = 'translateX(2px) translateY(-26px)';
    span.style.fontSize = '8px';
    if (isValidEmail) {
      validEmail.style.opacity = '0';
    } else {
      validEmail.style.opacity = '1'; 
    }
  } else {
    span.style.transform = 'translateX(0px) translateY(0px)';
    span.style.fontSize = '11px';
  }

});

const textarea = document.querySelector('.has-textarea');
const spanTextarea = document.querySelector('.has-textarea-span');

textarea.addEventListener('input', function() {
  if (textarea.value.trim() !== '') {
    spanTextarea.style.transform = 'translateX(2px) translateY(-6px)';
    spanTextarea.style.fontSize = '8px';
  } else {
    spanTextarea.style.transform = 'translateX(0px) translateY(0px)';
    spanTextarea.style.fontSize = '11px';
  }
});

// Get all required input and textarea elements
const requiredInputs = document.querySelectorAll('input[required], textarea[required]');

requiredInputs.forEach(input => {
  const inputBox = input.closest('.input-box');
  const requireMessage = inputBox.querySelector('.require-message');

  input.addEventListener('blur', function() {
    if (input.value.trim() === '') {
      requireMessage.style.opacity = '1';
    } else {
      requireMessage.style.opacity = '0'; 
    }
  });

  input.addEventListener('input', function() {
    if (input.value.trim() !== '') {
      requireMessage.style.opacity = '0';
    }
  });
});

