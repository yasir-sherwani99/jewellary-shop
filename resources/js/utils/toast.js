import Toastify from 'toastify-js'
import 'toastify-js/src/toastify.css'

export function showToast(message, type = 'success') {
    const background = type === 'success' 
        ? '#4CAF50' 
        : type === 'error' 
            ? '#f44336' 
            : '#2196F3'

    Toastify({
        text: message,
        duration: 5000,
        close: true,
        gravity: 'top',
        position: 'right',
        backgroundColor: background,
        className: 'toast-notification',
        stopOnFocus: true,
    }).showToast()
}

// Make available globally if needed
window.showToast = showToast