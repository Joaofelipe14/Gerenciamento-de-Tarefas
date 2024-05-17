// errorHandler.js
import Swal from 'sweetalert2';

export const showError = (message,title='Error') => {
  Swal.fire({
    icon: 'error',
    title: title,
    text: message,
    confirmButtonText: 'close'
  });
};
