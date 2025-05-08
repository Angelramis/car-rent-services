
// Mostrar/ocultar elemento de menú
function displayPagesMenu(id) {
  document.getElementById(id).classList.toggle("show_menu");
}

// Mostrar error dinámico
function showError(errorMessage) {
  let errorDiv = document.getElementById('error-div')
  let errorText = document.getElementById('error-text');

  errorText.innerHTML = '';
  errorDiv.classList.add('flex');
  errorDiv.classList.remove('hidden');
  errorText.innerHTML = errorMessage;
}