// errorHandler.js
import Swal from 'sweetalert2';

export const showError = (message, title = 'Error') => {
  Swal.fire({
    icon: 'error',
    title: title,
    text: message,
    confirmButtonText: 'close'
  });
};

export const showConfirmation = async (message, title = 'Confirmar') => {
  const result = await Swal.fire({
    title: title,
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!',
    cancelButtonText: 'Não',
    buttonsStyling: true,
    allowOutsideClick: false,
    allowEscapeKey: false
  });
  return result.isConfirmed;
};

export const showSuccess = (message, title = 'Success') => {
  Swal.fire({
    icon: 'success',
    title: title,
    text: message,
    confirmButtonText: 'OK'
  });
};