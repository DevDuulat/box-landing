import '../css/app.css';
import Alpine from 'alpinejs'
import header from './header'

window.Alpine = Alpine

Alpine.data('header', header)

Alpine.start()
