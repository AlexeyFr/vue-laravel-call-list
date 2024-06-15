import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue';
import DashboardComponent from './components/DashboardComponent.vue';
createApp(DashboardComponent).mount('#app');
