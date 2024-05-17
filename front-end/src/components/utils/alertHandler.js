// errorHandler.js
import Swal from 'sweetalert2';

export const showError = (message) => {
  Swal.fire({
    icon: 'error',
    title: 'Erro',
    text: message,
    confirmButtonText: 'close'
  });
};
