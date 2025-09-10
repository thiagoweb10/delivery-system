import Swal from 'sweetalert2'

export const useAlert = () => {
  const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
  })

  const success = (msg = 'Sucesso!') => {
    toast.fire({
      icon: 'success',
      title: msg,
    })
  }

  const error = (msg = 'Algo deu errado') => {
    toast.fire({
      icon: 'error',
      title: msg,
    })
  }

  const warning = (msg = 'Algo deu errado') => {
    toast.fire({
      icon: 'warning',
      title: msg,
      background: '#FFA500',
      color: '#FFFFFF',  
    })
  }

  const confirm = async (title = 'Tem certeza?', text = '') => {
    return Swal.fire({
      title,
      text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim',
      cancelButtonText: 'Cancelar',
    })
  }

  return { success, error, confirm, warning}
}