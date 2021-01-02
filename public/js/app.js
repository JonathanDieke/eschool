/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

// require('./bootstrap');
// window.Vue = require('vue');
// import VueRouter from 'vue-router'
// import VueX from 'vuex'
// import store from './store.js'
// import WelcomeComponent from './components/WelcomeComponent.vue'
// import StudentComponent from './components/StudentComponent.vue'
// import ClassroomComponent from './components/ClassroomComponent.vue'
// import RoomComponent from './components/RoomComponent.vue'
// import TeacherComponent from './components/TeacherComponent.vue'
// import CategoryComponent from './components/CategoryComponent.vue'
// import TestComponent from './components/TestComponent.vue'
// import {CoolSelectPlugin} from 'vue-cool-select'
// import 'vue-cool-select/dist/themes/bootstrap.css'
// Vue.use(VueX)
// Vue.use(VueRouter)
// Vue.use(CoolSelectPlugin)
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// const router = new VueRouter({
//     mode: '',
//     routes: [
//         {
//             path: '/',
//             component: WelcomeComponent,
//             name: 'welcome'
//         },
//         {
//             path: '/student',
//             component: StudentComponent,
//             name: 'student'
//         },
//         {
//             path: '/classroom',
//             component: ClassroomComponent,
//             name: 'classroom'
//         },
//         {
//             path: '/room',
//             component: RoomComponent,
//             name: 'room'
//         },
//         {
//             path: '/teacher',
//             component: TeacherComponent,
//             name: 'teacher'
//         },
//         {
//             path: '/category',
//             component: CategoryComponent,
//             name: 'category'
//         },
//         {
//             path: '/component',
//             component: TestComponent,
//             name: 'testcomponent'
//         },
//     ]
// })
// const app = new Vue({
//     el: '#app',
//     store: store,
//     router,
//     beforeMount() {
//         this.$store.commit('CREATE_STUDENT_CONTROLLER')
//         this.$store.commit('CREATE_CLASSROOM_CONTROLLER')
//         this.$store.commit('CREATE_TEACHER_CONTROLLER')
//         this.$store.commit('CREATE_CATEGORY_CONTROLLER')
//         this.$store.commit('CREATE_ROOM_CONTROLLER')
//     },
//     data() {
//         return {
//             message: 'data.data'
//         }
//     },
// });

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! c:\Users\ANGE DJEKE\Desktop\Laravel\Genie-Logiciel\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! c:\Users\ANGE DJEKE\Desktop\Laravel\Genie-Logiciel\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });