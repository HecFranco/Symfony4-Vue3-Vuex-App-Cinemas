# Vue and Vuex - App Cinemas (Frontend)

In this sample we are going to setup a web project that can be easily managed by **Vue-CLI**.

### Summary steps:

0. [Prerequisites](#Prerequisites)
1. [Initialization of the Project](#1initialization-of-the-project)
    1. [Clean the Template](#11clean-the-template)
    2. [Change the Style](#12change-the-style)
2. [Adding Bootstrap 4](#2adding-bootstrap-4)
    1. [Change Favicon and Title of project](#21change-favicon-and-title-of-project)
3. [Defining **Namespace**](#3defining-namespace)
    1. [Defining Types for each Module, GLOBAL](#31defining-types-for-each-module,-global)
4. [Plugins for Vue](#4plugins-for-vue)
    1. [Vuex, Installation and Creation of Store](#41vuex,-installation-and-creation-of-store)
    2. [Requests HTTP using Vue-resource](#42requests-http-using-vue-resource)
    3. [Vue-BlockUI](#43vue-blockui)
    4. [Validations using Vee-Validate](#44validations-using-vee-validate)
    5. [Translations using Vue-i18n](#45translations-using-vue-i18n)
    6. [Vue-Tables-2](#46vue-Tables-2)
    7. [Vue-router](#47vue-router)
        1. [Route Checker](#471route-checker)
    8. [JWT-Decode](#48jwt-decode)
5. [Continuing with **Vuex**, Global Component](#5continuing-with-vuex,-global-component)
6. [Continuing Validations](#6continuing-validations)
7. [Namespace to Types of Module Auth](#7namespace-to-types-of-module-auth)
    1. [Declare module in the app](#71declare-module-in-the-app)
    2. [State](#72state)
    3. [Getters](#73getters)
    4. [Mutations](#74mutations)
    5. [Actions](#75actions)
8. [Navigation Component](#8navigation-component)
9. [Continuing BlockUI, Processing Request Message](#9continuing-blockui,-processing-request-message)
10. [Login Component](#10login-component)
    1. [Showing the Component in his Route](#101showing-the-component-in-his-route)
11. [Register Component](#11register-component)
    1. [Template](#111template)
    2. [Script](#112script)
    3. [Showing the Component in his Route](#113showing-the-component-in-his-route)
12. [Persist User in the Browser](#12persist-user-in-the-browser)

## Prerequisites

Install [Node.js and npm](https://nodejs.org/en/) (v6.x.x or higher) if they are not already installed on your computer. 

You will also need to have **Vue-CLI** installed globally. [Vue.js](https://vuex.vuejs.org/en/) provides an official CLI to quickly structure Single-page Applications (SPA). Provides **all-in-one** configurations for a modern frontend workflow. It only takes a few minutes, it's ready for development with: hot top-up, **lint-on-save** and ready-made versions:

```bash
`npm install -g @vue/cli`
```

> Verify that you are running at least node v6.x.x and npm 3.x.x by running `node -v`, `npm -v` and `vue -V` in a terminal/console window. Older versions may produce errors.

--------------------------------------------------------------------------------------------

## 1.Initialization of the Project

--------------------------------------------------------------------------------------------

- Create and navigate to the folder where you are going to create the empty project.

- Execute `vue create vue-app` to create a new **vue-app** project, you will be prompted to answer some information about the project.Once you have completed this information successfully, the **package.json** file will be generated.

```bash
vue create vue-app
```

- Access to the project's folder.

```bash
cd vue-app
```

> Run `npm install` if you do not have the folder [node_modules](./webapp/node_modules/) inside the project.

- Execute `npm run serve` to launch the project server.

```bash
npm run serve
```

- Now you can view the result of installation accessing to [http://localhost:8080/](http://localhost:8080/).

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 1.1.Clean The template

--------------------------------------------------------------------------------------------

* Delete the [vue-app/src/component/HelloWorld.vue](./vue-app/src/component/HelloWorld.vue).
* Clean the [vue-app/src/App.vue](./vue-app/src/App.vue) file.

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
--  <img src="./assets/logo.png">
--  <HelloWorld msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
-- import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'app',
  components: {
--  HelloWorld
  }
}
</script>

<style lang="scss">
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 1.2.Change the Style

--------------------------------------------------------------------------------------------

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
  </div>
</template>

<script>
export default {
  name: 'app',
  components: {
  }
}
</script>

<style lang="scss">
++ body {
++  background-color: #36383A !important;
++ }
++ .well {
++   background-color: #fff !important;
++ }
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
--  -moz-osx-font-smoothing: grayscale;
--  text-align: center;
  color: #2c3e50;
--  margin-top: 60px;
}
++ h1, h3, h4, p {
++   color: #fff !important;
++ }
++ h2, a {
++   color: #E33A2D !important;
++ }
++ th, td{
++   color: #E33A2D !important;
++   font-size: 16px;
++   font-weight: bold;
++   text-align: center;
++ }
++ td {
++   background-color: #fff;
++ }
++ hr {
++   border: 1px solid #E33A2D !important;
++   width: 100%;
++ }
++ .page-link.active  {
++   background-color: #D24839 !important;
++   color: #fff !important;
++   border: 1px solid #fff !important;
++ }
</style>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 2.Adding bootstrap 4

--------------------------------------------------------------------------------------------

(source: [https://bootstrap-vue.js.org/docs/](https://bootstrap-vue.js.org/docs/)https://bootstrap-vue.js.org/docs/))

To get started, use npm to get latest version of bootstrap-vue and bootstrap 4:

```bash
npm i bootstrap-vue
```

Then, register BootstrapVue plugin in your app entry point:

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

++ //bootstrapVue
++ import BootstrapVue from 'bootstrap-vue'
++ Vue.use(BootstrapVue);
++ import jQuery from 'jquery';
++ import bootstrap from 'bootstrap'; 
++ //.bootstrapVue
// ...
```

And import Bootstrap and Bootstrap-Vue css files:

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
// ...
<style lang="scss">
++ @import '../node_modules/bootstrap/dist/css/bootstrap.css';
++ @import '../node_modules/bootstrap-vue/dist/bootstrap-vue.css';

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 2.1.Change Favicon and Title of project

--------------------------------------------------------------------------------------------

_[vue-app/public/index.html](./vue-app/public/index.html)_
```diff
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
++  <link rel="icon" href="<%= BASE_URL %>favicon.ico">
++  <title>vuewebapp</title>
  </head>
  <body>
    <noscript>
      <strong>We're sorry but vuewebapp doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app"></div>
    <!-- built files will be auto injected -->
  </body>
</html>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 2.2.Font-Awesome

--------------------------------------------------------------------------------------------

```bash
npm i --save @fortawesome/fontawesome
npm i --save @fortawesome/vue-fontawesome
npm i --save @fortawesome/fontawesome-free-solid
```

We will created the file [vue-app/src/fa.config.js](./vue-app/src/fa.config.js) with the next configuration:

_[vue-app/src/fa.config.js](./vue-app/src/fa.config.js)_
```js
import Vue from 'vue';
import fontawesome from '@fortawesome/fontawesome';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import {
  faSpinner,
  faAngleLeft,
  faAngleRight,
} from '@fortawesome/fontawesome-free-solid';

fontawesome.library.add(
  faSpinner,
  faAngleLeft,
  faAngleRight,
);

Vue.component('font-awesome-icon', FontAwesomeIcon); // registered globally
```

Now can use teh font awesome component, like this.

```html
<template>
  <div>
    <font-awesome-icon icon="angle-left"></font-awesome-icon> Hey! FA Works
  </div>
</template>
```

(Source: [https://stackoverflow.com/questions/41537212/use-font-awesome-in-a-vue-app-created-with-vue-cli-webpack?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa](https://stackoverflow.com/questions/41537212/use-font-awesome-in-a-vue-app-created-with-vue-cli-webpack?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa))

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 2.3.Vue-popper.js

--------------------------------------------------------------------------------------------

```bash
npm install vue-popperjs --save
```

_Example_
```html
<template>
  <popper trigger="click" :options="{placement: 'top'}">
    <div class="popper">
      Popper Content
    </div>
 
    <button slot="reference">
      Reference Element
    </button>
  </popper>
</template>
 
<script>
  import Popper from 'vue-popperjs';
  import 'vue-popperjs/dist/css/vue-popper.css';
  
  export default {
    components: {
      'popper': Popper
    },
  }
</script> 
```

(Source: [https://www.npmjs.com/package/vue-popperjs](https://www.npmjs.com/package/vue-popperjs))

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 3.Defining **Namespace**

--------------------------------------------------------------------------------------------

> The **Namespaces** are commonly structured as hierarchies to allow reuse of names in different contexts.

_[vue-app/src/utils/namespace.js](./vue-app/src/utils/namespace.js)_
```js
function mapValues (obj, f) {
  const res = {};
  Object.keys(obj).forEach(key => {
    res[key] = f(obj[key], key)
  });
  return res;
}

export default (module, types) => {
  let newObj = {};
  mapValues(types, (names, type) => {
    newObj[type] = {};
    types[type].forEach(name=> {
      newObj[type][name] = module + ':' + name;
    });
  });
  return newObj;
}
```

(Source:[https://github.com/vuejs/vuex/issues/335](https://github.com/vuejs/vuex/issues/335))

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 3.1.Defining Types for each Module, GLOBAL

--------------------------------------------------------------------------------------------

* **processing**, will manage the requests that are being made in their entirety.
* **language**, will manage the value / status of a data.
* **changeLanguage**, will manage the action of changing the language.
* **mutations**, will manages state variations.

_[vue-app/src/types/global.js](./vue-app/src/types/global.js)_
```js
import namespace from '../utils/namespace'

export default namespace('global', {
  actions: [
    'changeLanguage'
  ],
  getters: [
    'processing',
    'language'
  ],
  mutations: [
    'startProcessing',
    'stopProcessing',
    'setLanguage'
  ]
});
```

**Mutations**, The only way to actually change state in a Vuex store is by committing a mutation. Vuex mutations are very similar to events: each mutation has a string type and a handler. The handler function is where we perform actual state modifications, and it will receive the state as the first argument:
```js
// ...
  mutations: [
    'startProcessing',
    'stopProcessing',
    'setLanguage'
  ]
// ...
```
**Getters**, Sometimes we may need to compute derived state based on store state, for example filtering through a list of items and counting them:
**Actions** are similar to mutations, the differences being that:
  * Instead of mutating the state, actions commit mutations.
  * Actions can contain arbitrary asynchronous operations.

* Now we can import the global typo into our application launch file _[src/main.js](./vue-app/src/main.js)_.

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //modules and types
++  import globalTypes from './types/global';
++ //.modules and types
// ...
```

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
  </div>
</template>

<script>
++ import globalTypes from './types/global';

export default {
  name: 'app',
  components: {
  }
}
</script>

<style lang="scss">
// ...
</style>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 4.Plugins for Vue

--------------------------------------------------------------------------------------------

* **Vuex**, installation and creation of **store** 
* Requests HTTP using Vue-resource
* **Vue-BlockUI**
* Validations using **Vee-Validate**
* Translations using **Vue-i18n**
* **Vue-Tables-2**
* **Vue-router**
* **jwt-decode**

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.1.**Vuex**, installation and creation of **store** 

--------------------------------------------------------------------------------------------

> Vuex is a **state management pattern + library** for Vue.js applications. It serves as a centralized store for all the components in an application, with rules ensuring that the state can only be mutated in a predictable fashion. It also integrates with Vue's official **[devtools extension](https://github.com/vuejs/vue-devtools)** to provide advanced features such as zero-config time-travel debugging and state snapshot export / import.

(Sources: [https://github.com/vuejs/vuex](https://github.com/vuejs/vuex) and [https://vuex.vuejs.org/](https://vuex.vuejs.org/))

```bash
npm install --save vuex 
```

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //vuex
++ import Vuex from 'vuex'
++ Vue.use(Vuex)
++  //global data warehouse with vuex
++  export const store = new Vuex.Store({
++    state: {
++      // default values  
++    },
++    actions: {
++      // actions 
++    },
++    getters: {
++      // get the value of data
++    },
++    mutations: {
++      // manage the change in the data
++    },
++    modules: {
++    }
++  });
++  //.global data warehouse with vuex
++ //.vuex
// ...

new Vue({
  render: h => h(App),
++ store
}).$mount('#app')
```

> Vue has a quality Chrome (and Firefox, sort of) extension that allows inspecting component trees, reviewing events, and time-travel debugging of Vuex states. These features make debugging ridiculously simple, even for fairly large apps.

* **vue-devtools**, [https://github.com/vuejs/vue-devtools](https://github.com/vuejs/vue-devtools)

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.2.Requests HTTP using Vue-resource

--------------------------------------------------------------------------------------------

> The plugin for Vue.js provides services for making web requests and handle responses using a XMLHttpRequest or JSONP.

(Source: [https://github.com/pagekit/vue-resource](https://github.com/pagekit/vue-resource))

```bash
npm install --save vue-resource
``` 

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //vue resource
++  import VueResource from 'vue-resource';
++  Vue.use(VueResource);
++  Vue.http.options.root = 'http://127.0.0.1:3333/api/v1/';
++  //.to send tokens
++    Vue.http.interceptors.push((request, next) => {
++      request.headers.set('Authorization', `Bearer ${window.localStorage.getItem('_token')}`);
++      next();
++    });
++  //.to send tokens
++ //.vue resource
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.3.**Vue-BlockUI**

--------------------------------------------------------------------------------------------

> BlockUI for vue 2, similiar to jquery blockUI, can be used for loading screen.

(Source: [https://github.com/realdah/vue-blockui](https://github.com/realdah/vue-blockui))

```bash
npm install --save vue-blockui
```

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //blockui
++ import BlockUI from 'vue-blockui';
++ Vue.use(BlockUI);
++ //.blockui
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.4.Validations using **Vee-Validate**

--------------------------------------------------------------------------------------------

> VeeValidate is a validation library for Vue.js. It has plenty of validation rules out of the box and support for custom ones as well. It is template based so it is similar and familiar with the HTML5 validation API. You can validate HTML5 inputs as well as custom Vue components.

It is also built with localization in mind, in fact we have about 44 languages supported and maintained by the wonderful community members.

(Source: [https://baianat.github.io/vee-validate/](https://baianat.github.io/vee-validate/))

```bash
npm install --save vee-validate
```

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //vee-validate
++ import VeeValidate, {Validator} from 'vee-validate';
++ // To make validator with translations......
++ Vue.use(VeeValidate);
++ //.vee-validate
// ...
```

* We are going to create the Validators in [vue-app/src/validator/en.js](./vue-app/src/validator/en.js) and [vue-app/src/validator/es.js](./vue-app/src/validator/es.js), and we will imported this files within [vue-app/src/main.js](./vue-app/src/main.js).

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
//vee-validate
import VeeValidate, {Validator} from 'vee-validate';
-- // To make validator with translations......
++ import validatorEs from '@/validator/es';
++ import validatorEn from '@/validator/en';
++ Validator.localize('es', validatorEs);
Vue.use(VeeValidate);
//.vee-validate
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.5.Translations using **Vue-i18n**

--------------------------------------------------------------------------------------------

* We are goint to create the translation file, [vue-app/src/translations/index.js](./vue-app/src/translations/index.js)

```bash
npm install --save vue-i18n
```

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //vue translations
++ import VueI18n from 'vue-i18n';
++ Vue.use(VueI18n);
++ import messages from './translations';
++ const i18n = new VueI18n({
++   locale: store.state.language,
++   messages
++ });
++ //.vue translations
// ...

new Vue({
  render: h => h(App),
--  store  
++  store,
++  i18n    
}).$mount('#app')
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.6.**Vue-Tables-2**

--------------------------------------------------------------------------------------------

(Source: [https://github.com/matfish2/vue-tables-2](hhttps://github.com/matfish2/vue-tables-2))

```bash
npm install --save vue-tables-2
```

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //vue-tables-2
++ import {ClientTable} from 'vue-tables-2';
++ Vue.use(ClientTable, {}, false, 'bootstrap4', 'default');
++ //.vue-tables-2
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 4.7.**Vue-router**

--------------------------------------------------------------------------------------------

> **Vue Router** is the official router for **Vue.js**. 

(Source: [https://router.vuejs.org/installation.html](https://router.vuejs.org/installation.html))

```bash
npm install --save vue-router
```

* We are goint to create the file that manage the router in pour app.

_[vue-app/src/router/index.js](./vue-app/src/router/index.js)_
```js
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    // configuration each router
  ]
});
//.configure the router

export default router;
```

* Now, we can declarate our routing system in the main file aplication, [vue-app/src/main.js](./vue-app/src/main.js).

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
++ //vue-router
++ import VueRouter from 'vue-router'
++ Vue.use(VueRouter)
++ //.vue-router
// ...

new Vue({
  render: h => h(App),
  store,
  i18n,
++ router
}).$mount('#app')
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>


--------------------------------------------------------------------------------------------

### 4.7.1.Route Checker

--------------------------------------------------------------------------------------------

_[vue-app/src/router/index.js](./vue-app/src/router/index.js)_
```diff
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    // configuration each router
  ]
});
//.configure the router

++ //for each route change
++ router.beforeEach((to, from, next) => {
++   document.title = to.meta.title;
++   // check if the route need authentication and the user is auth
++   if (to.meta.Auth && !store.state.authModule.logged) {
++     next({path: '/login'});
++   } else {
++     next();
++   }
++ });
++ //.for each route change

export default router;
```

--------------------------------------------------------------------------------------------

### 4.8.**jwt-decode**

--------------------------------------------------------------------------------------------

(Source: [https://www.npmjs.com/package/jwt-decode](https://www.npmjs.com/package/jwt-decode))

```bash
npm install --save jwt-decode
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 5.Continuing with **Vuex**, Global Component

--------------------------------------------------------------------------------------------

* **state**, will defined the default value of data.
* **processing**, will manage the requests that are being made in their entirety.
* **language**, will manage the value / status of a data.
* **changeLanguage**, will manage the action of changing the language.
* **mutations**, will manages state variations.

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
import Vue from 'vue'
import App from './App.vue'

// ...
//modules and types
  import globalTypes from './types/global';
//.modules and types

//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
      state: {
        // default values
++      processing: false,
++      language: 'es'      
      },
      actions: {
        // actions 
++      [globalTypes.actions.changeLanguage] : ({commit}, lang) =>{
++        commit(globalTypes.mutations.setLanguage, lang);
++        // To make validator with translations......
++      }
      },
      getters: {
        // get the value of data
++      [globalTypes.getters.processing]: state => state.processing,
++      [globalTypes.getters.language]: state => state.language,        
      },
      mutations: {
        // manage the change in the data
++      [globalTypes.mutations.startProcessing] (state) {
++        state.processing = true;
++      },
++      [globalTypes.mutations.stopProcessing] (state) {
++        state.processing = false;
++      },
++      [globalTypes.actions.setLanguage] : (state, lang) =>{
++        state.language = lang;
++      }
      },
      modules: {
      }
    });
    //.global data warehouse with vuex
//.vuex
// ...

new Vue({
  render: h => h(App),
  store
}).$mount('#app')
```

* We will showing the global data like this: 

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
++ {{processing}}  
  </div>
</template>

<script>
import globalTypes from './types/global';
++ import {mapGetters} from 'vuex';

export default {
  name: 'app',
  components: {
  }
++ computed: {
++   ...mapGetters({
++     processing: globalTypes.getters.processing,
++   })
++ }
}
</script>

<style lang="scss">
// ...
</style>
```

> These data will be of the **Vuex Global Component**.

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 6.Continuing Validations

--------------------------------------------------------------------------------------------

* After, we will defined the **action** within the **store** of the main file of the **app**, [vue-app/src/main.js](./vue-app/src/main.js).

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
// ...
//modules and types
  import globalTypes from './types/global';
//.modules and types

//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
      state: {
        // default values     
      },
      actions: {
        // actions 
        [globalTypes.actions.changeLanguage] : ({commit}, lang) =>{
          commit(globalTypes.mutations.setLanguage, lang);
++        switch (lang) {
++          case 'en': {
++            Validator.localize('en', validatorEn);
++            break;
++          }
++          case 'es': {
++            Validator.localize('es', validatorEs);
++            break;
++          }
++        }
        }
      },
      getters: {
        // get the value of data
      },
      mutations: {
        // manage the change in the data
      },
      modules: {
      }
    });
    //.global data warehouse with vuex
//.vuex
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 7.Namespace to Types of Module Auth

--------------------------------------------------------------------------------------------

_[vue-app/src/types/auth.js](./vue-app/src/types/auth.js)_
```js
import namespace from '../utils/namespace'

export default namespace('auth', {
  getters: [
    'user',
    'logged'
  ],
  actions: [
    'login',
    'register',
    'logout',
    'updateProfile'
  ],
  mutations: [
    'setUser',
    'setLogged'
  ]
});
```

_[vue-app/src/modules/auth.js](./vue-app/src/modules/auth.js)_
```js
import types from '../types/auth';
import globalTypes from '../types/global';
import Vue from 'vue';

const state = {
  // ... 
};
const actions = {
  // ... 
};
const getters = {
  // ... 
};
const mutations = {
  // ... 
};
export default {
  state,
  actions,
  getters,
  mutations
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 7.1.Declare module in the app

--------------------------------------------------------------------------------------------

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
// ...
//modules and types
  import globalTypes from './types/global';
++ import authModule from './modules/auth';
//.modules and types

//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
      state: {
        // default values
      },
      actions: {
        // actions 
      },
      getters: {
        // get the value of data
      },
      mutations: {
        // manage the change in the data
      },
      modules: {
++      authModule,
      }
    });
    //.global data warehouse with vuex
//.vuex
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 7.2.State

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/auth.js)_
```diff
import types from '../types/auth';
import globalTypes from '../types/global';
import Vue from 'vue';

const state = {
++ user: null,
++ // convert to boolean the _token in localStorage
++ logged: !!window.localStorage.getItem('_token')
};
const actions = {
  // ... 
};
const getters = {
  // ... 
};
const mutations = {
  // ... 
};
export default {
  state,
  actions,
  getters,
  mutations
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 7.3.Getters

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/auth.js)_
```diff
import types from '../types/auth';
import globalTypes from '../types/global';
import Vue from 'vue';

const state = {
  user: null,
  // convert to boolean the _token in localStorage
  logged: !!window.localStorage.getItem('_token')
};
const actions = {
  // ... 
};
const getters = {
++ // to get the user
++ [types.getters.user]: (state) => {
++   return state.user;
++ },
++ // to be logged in?
++ [types.getters.logged]: (state) => {
++   return state.logged;
++ }
};
const mutations = {
  // ... 
};
export default {
  state,
  actions,
  getters,
  mutations
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 7.4.Mutations

--------------------------------------------------------------------------------------------

> You need the plugin **jwt-decode** for this part.

_[vue-app/src/modules/auth.js](./vue-app/src/modules/auth.js)_
```diff
import types from '../types/auth';
import globalTypes from '../types/global';
import Vue from 'vue';

const state = {
  user: null,
  // convert to boolean the _token in localStorage
  logged: !!window.localStorage.getItem('_token')
};
const actions = {
  // ... 
};
const getters = {
  // to get the user
  [types.getters.user]: (state) => {
    return state.user;
  },
  // to be logged in?
  [types.getters.logged]: (state) => {
    return state.logged;
  }
};
const mutations = {
++ // to set the user through the token jwt
++ [types.mutations.setUser]: (state) => {
++   if(window.localStorage.getItem('_token')) {
++     const token = window.localStorage.getItem('_token');
++     const jwtDecode = require('jwt-decode');
++     state.user = jwtDecode(token);
++     state.logged = true;
++   } else {
++     state.logged = false;
++     state.user = null;
++   }
++ },
++ // to establish the user's status
++ [types.mutations.setLogged]: (state, logged) => {
++   state.logged = logged;
++ }
};
export default {
  state,
  actions,
  getters,
  mutations
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 7.5.Actions

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/auth.js)_
```diff
_[vue-app/src/modules/auth.js](./vue-app/src/modules/auth.js)_
```diff
import types from '../types/auth';
import globalTypes from '../types/global';
import Vue from 'vue';
++ import Axios from 'axios';

const state = {
  // ...
};
const actions = {
++ [types.actions.login]: ({commit}, userInput) => {
++  // start processing
++  commit(globalTypes.mutations.startProcessing);    
++  return new Promise((resolve, reject) => {
++    let json = JSON.stringify({user: userInput});
++    let params = "json=" + json;
++    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
++    Axios
++      .post('http://127.0.0.1:8000/api/v1/login',
++        params,
++        {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
++      .then(response => {
++        window.localStorage.setItem('_token', response.data);
++        commit(types.mutations.setUser);
++        resolve(response);
++      })
++      .catch(error => {
++        reject(error);
++      });
++      // end processing
++      commit(globalTypes.mutations.stopProcessing);
++  })
++ },
++ [types.actions.register]: ({commit}, userInput) => {
++  // start processing
++  commit(globalTypes.mutations.startProcessing);
++  return new Promise((resolve, reject) => {
++    let json = JSON.stringify({user: userInput});
++    let params = "json=" + json;
++    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
++    Axios
++      .post('http://127.0.0.1:8000/api/v1/register',
++        params,
++        {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
++      .then(response => {
++        resolve(response);
++      })
++      .catch(error => {
++        reject(error);
++      });
++      // end processing
++      commit(globalTypes.mutations.stopProcessing);
++  })
++ },
++ [types.actions.updateProfile]: ({commit}, userInput) => {
++  // start processing
++  commit(globalTypes.mutations.startProcessing);
++  return new Promise((resolve, reject) => {
++    Vue.http.put('profile', {user: userInput})
++      .then(user => {
++        window.localStorage.setItem('_token', user.body.token);
++        commit(types.mutations.setUser);
++        resolve(user);
++      })
++      .catch(error => {
++        reject(error);
++      })
++      .finally(() => {
++        // finally processing
++        commit(globalTypes.mutations.stopProcessing);
++      })
++  })
++ }
};
const getters = {
  // ...
};
const mutations = {
  // ...
};
export default {
  state,
  actions,
  getters,
  mutations
}
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 8.Navigation Component

--------------------------------------------------------------------------------------------

* `$t`, is a global variable of the vue-i18n plugin that manages the change of languages.

_[vue-app/src/components/Navigation.vue](./vue-app/src/components/Navigation.vue)_
```html
<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Vue.js 2</a>
    <button 
      class="navbar-toggler" 
      type="button" 
      data-toggle="collapse" 
      data-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" 
      aria-expanded="false" 
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto"> 
        <li class="nav-item active">
          <router-link class="nav-link" to="/">
            <font-awesome-icon icon="map-marker"></font-awesome-icon>
            {{ $t('navigation.cinema') }}
          </router-link>
        </li>
        <li class="nav-item"><router-link class="nav-link" to="/profile" v-if="isLogged && userLogged != null">{{ $t('navigation.my_account') }}</router-link></li>
        <li class="nav-item"><router-link class="nav-link" to="/bookings" v-if="isLogged && userLogged != null">{{ $t('navigation.bookings') }}</router-link></li>
        <!--
        <language-selector></language-selector>          
        -->
      </ul>
      <ul class="navbar-nav my-auto"> 
          <li class="nav-item">
            <router-link class="nav-link" to="/login" v-if="!isLogged || userLogged == null">
              <font-awesome-icon icon="sign-in-alt"></font-awesome-icon>
              {{ $t('navigation.login') }}
            </router-link>
            
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/register" v-if="!isLogged || userLogged == null">
              <font-awesome-icon icon="user-plus"></font-awesome-icon>
              {{ $t('navigation.register') }}
            </router-link>
          </li>
          <li class="nav-item"><a class="nav-link" href="#" @click.prevent="logout()" v-if="isLogged && userLogged != null">{{ $t('navigation.logout') }}</a></li>
      </ul>      
    </div>   
  </nav>    
</template>

<script>
  import {mapGetters, mapActions} from 'vuex';
  import authTypes from '../types/auth';

  export default {
    name: 'navigation',
    methods: {
      ...mapActions({
        // alias : methods
        _logout: authTypes.actions.logout
      }),
      logout() {
          this._logout();
          this.$router.push({name: 'login'});
      }
    },
    computed: {
      ...mapGetters({
        isLogged: authTypes.getters.logged,
        userLogged: authTypes.getters.user
      })
    }
  }
</script>
```

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
++  <navigation></navigation>
    {{processing}} 
  </div>
</template>

<script>
import globalTypes from './types/global';
import {mapGetters} from 'vuex';

++ import Navigation from './components/Navigation.vue';

export default {
  name: 'app',
  components: {
--  HelloWorld
++  Navigation,
++ },
++ data () {
++   return {
++   }
++ },
  computed: {
    ...mapGetters({
      processing: globalTypes.getters.processing,
    })
  }
}
</script>

<style lang="scss">
// ...
</style>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 9.Continuing BlockUI, Processing Request Message

--------------------------------------------------------------------------------------------

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
    <navigation></navigation>
--  {{processing}}
++  <div v-if="processing">
++    <BlockUI :message="$t('messages.processing')"></BlockUI>
++  </div>
  </div>
</template>

<script>
import globalTypes from './types/global';
import {mapGetters} from 'vuex';

import Navigation from './components/Navigation.vue';

export default {
  name: 'app',
  components: {
    Navigation,
  },
  data () {
    return {
    }
  },
  computed: {
    ...mapGetters({
      processing: globalTypes.getters.processing,
    })
  }
}
</script>

<style lang="scss">
// ...
</style>
```

> This change shows a message that blocks the screen, in different languages, in which the information that is processing the request is found.

**IMPORTANT**: We can change the processing status within the file [file] to test it.

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
//...
//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
    state: {
--    processing: false,
++    processing: true,
      language: 'es'
    },
    //...
```

> Do not forget to return to the initial value of the `processing` variable.

_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
//...
//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
    state: {
--    processing: true,
++    processing: false,
      language: 'es'
    },
    //...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 10.Login Component

--------------------------------------------------------------------------------------------

We will created the **Login Component** in the file [vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue).

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```html
<template>
  <div class="login col-md-6 offset-md-3">
  </div>
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';

  export default {
    name: 'login',
    data () {
      return {
        user: {
          email: '',
          password: '',
          getHash: null
        },
        error: null
      }
    },
    methods: {
      ...mapActions({
        // we define the action of model auth.js 'authTypes.actions.login' like 'login' alias
        login: authTypes.actions.login
      })
    }
  }
</script>
```

* We are going to add the template for this component.

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```diff
<template>
  <div class="login col-md-6 col-md-offset-3">
++  <!-- Title of Form -->  
++  <h1 class="text-center">
++    <u v-html="$t('login.title')"></u>
++  </h1>
++  <!-- Message of Error -->  
++  <div class="alert alert-danger" v-if="error" v-html="$t('login.error')"></div>
++  <hr />
  </div>
</template>

<script>
  // ...
</script>
```

* Now, we can create the structure and the logic to start with the login form.

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```diff
<template>
  <div class="login col-md-6 col-md-offset-3">
    <!-- Title of Form -->  
    <h1 class="text-center text-muted">
      <u v-html="$t('login.title')"></u>
    </h1>
    <!-- Message of Error --> 
    <div class="alert alert-danger" v-if="error" v-html="$t('login.error')"></div>
    <hr />
++  <!-- Block Form Login -->    
++  <div class="card">
++    <div class="card-body">
++      <form
++        autocomplete="off"
++        @submit.prevent="validateBeforeSubmit"
++      >
++        <div class="form-group">
++          // To make input email...
++        </div>
++        <div class="form-group">
++          // To make input password...
++        </div>
++        <button>
++          // To make bottom submit...
++        </button>
++      </form>
++    </div>
++  </div>
  </div>
</template>

<script>
  // ...
</script>
```

The logic of this login form include the validation using the **vee-validate** plugin.

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```diff
<template>
  // ...
</template>
<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';

  export default {
    name: 'login',
    data () {
      return {
        user: {
          email: '',
          password: '',
          getHash: null
        },
        error: null
      }
    },
    methods: {
      ...mapActions({
        // we define the action of model auth.js 'authTypes.actions.login' like 'login' alias
        login: authTypes.actions.login
--    })
++    }),
++    validateBeforeSubmit(){
++      // validator for the login form
++    }
    }
  }
</script>
```

* Next, we can add the input of the form.

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```diff
<template>
  <div class="login col-md-6 offset-md-3">
     <!-- Title of Form -->  
    <h1 class="text-center">
      <u v-html="$t('login.title')"></u>
    </h1>
    <!-- Message of Error --> 
    <div class="alert alert-danger" v-if="error" v-html="$t('login.error')"></div>
    <hr />
    <!-- Block Form Login -->
    <div class="card">
      <div class="card-body">
        <form
          autocomplete="off"
          class="form-horizontal"
          @submit.prevent="validateBeforeSubmit"
        >
        <div class="form-group">
--         // To make input email...        
++        <label 
++          class="control-label col-md-4"
++          for="email"
++          v-html="$t{'login.email'}"
++        >
++        </label>
++        <div class="col-md-8" :class="{ 'has-error': errors.has('email') }">
++          <input
++            autocomplete="off"
++            name="email"
++            v-model="user.email"
++            v-validate
++            data-vv-rules="required|email"
++            class="form-control"
++            type="text"
++            id="email"
++            :placeholder="$t('register.email')"
++            :class="{ 'has-error' : errors.has('email') }"
++          >
++          <span
++            v-shwo="errors.has('email')"
++            class="text-danger"
++          >
++            {{ errors.first('email') }}
++          </span>
++        </div>
        </div>
        <div class="form-group">
--         // To make input password...         
++        <label
++          class="control-label col-md-4"
++          for="password"
++          v-html="$t('register.password')"
++        >
++        </label>
++        <div
++          class="col-md-8"
++          :class="{ 'has-error' : errors.has('password') }"
++        >
++          <input
++            autocomplete="off"
++            name="password"
++            v-model="user.password"
++            v-validate
++            data-vv-rules="required|min:6"
++            class="form-control"
++            type="password"
++            id="password"
++            :placeholder="$t('register.password')"
++            :class="{ 'has-error' : errors.has('password') }"
++          >
++          <span
++            v-show="errors.has('password')"
++            class="text-danger"
++          >
++            {{ errors.first('password') }}
++          </span>
++        </div>
        </div>
++      <button
++        type="submit"
++        class="btn btn-success btn-block"
++        v-html="btnText"
++      >        
--      <button>
--        // To make bottom submit...
        </button>  
        </form>
      </div>
    </div>                
  </div>
</template>

<script>
  // ...
</script>
```

The validation will be like this:

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```diff
<template>
  // ...
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';

  export default {
    name: 'login',
    data () {
      return {
        user:{
          email: '',
          password: '',
          getHash: null
        },
        error: null
      }
    },
    methods: {
      ...mapActions({
        // we define the action of model auth.js 'authTypes.actions.login' like 'login' alias
        login: authTypes.actions.login
      }),
      validateBeforeSubmit () {
        // validator for the login form
++      this.$validator.validateAll().then(result => {
++        if ( ! result) {
++          //There are errors
++          console.log('Vee-Validate is not working correctly')
++        } else {
++          this.login({
++            email: this.email,
++            password: this.password,
++            getHash: this.user.getHash
++          })
++            .then(
++              user => {
++                this.$router.push('/');
++              },
++              error => {
++                this.error = true;
++              }
++            )
++        }
++      })
++      .catch(error =>{
++        console.log(error);
++      })
++    }
    }
  }
</script>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 10.1.Showing the Component in his Route

--------------------------------------------------------------------------------------------

Add the new route in [vue-app/src/router/index.js](./vue-app/src/router/index.js)

_[vue-app/src/router/index.js](./vue-app/src/router/index.js)_
```diff
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
++ import Login from '../components/Auth/Login';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    // configuration each router
++  {
++    path: '/login',
++    name: '/login',
++    component: Login,
++    meta: { Auth: false, title: 'Iniciar sesión' },
++    beforeEnter: (to, from, next) =>{
++      // if the user is loggin  
++      if(store.state.authModule.logged) {
++        next({ path: '/' });
++      } else {
++        next();
++      }
++    }
++  },
  ]
});
//.configure the router

//for each route change
  // ...
//.for each route change

export default router;
```

And we will add the component `<router-view></router-view>` within [vue-app/src/App.vue](./vue-app/src/App.vue).

_[vue-app/src/App.vue](./vue-app/src/App.vue)_
```diff
<template>
  <div id="app">
    <navigation></navigation>
    <div v-if="processing">
      <BlockUI :message="$t('messages.processing')"></BlockUI>
    </div>
++  <router-view></router-view>
  </div>
</template>

<script>
  // ...
</script>  

<style lang="scss">
  // ...
</style> 
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 11.Register Component

--------------------------------------------------------------------------------------------

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 11.1.Template

--------------------------------------------------------------------------------------------

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```html
<template>
  <div class="register col-md-6 offset-md-3">
     <!-- Title of Form -->  
    <h1 class="text-center">
      <u v-html="$t('register.title')"></u>
    </h1>
    <!-- Message of Error --> 
    <div class="alert alert-danger" v-if="error" v-html="$t('register.error')"></div>
    <hr />
    <!-- Block Form username -->
    <div class="card">
      <div class="card-body">
        <form
          autocomplete="off"
          class="form-horizontal"
          @submit.prevent="validateBeforeSubmit"
        >
          <div class="form-group">
            <label
              class="control-label col-md-12"
              for="username"
              v-html="$t('register.username')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('username') }"
            >
              <input
                autocomplete="off"
                name="username"
                v-model="username"
                v-validate
                data-vv-rules="required"
                class="form-control"
                type="text"
                id="username"
                :placeholder="$t('register.username')"
                :class="{ 'has-error' : errors.has('username') }"
              >
              <span
                v-show="errors.has('username')"
                class="text-danger"
              >
                {{ errors.first('username') }}
              </span>
            </div>
          </div>
          <div class="form-group">
            <label
              class="control-label col-md-12"
              for="email"
              v-html="$t('register.email')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('email') }"
            >
              <input
                autocomplete="off"
                name="email"
                v-model="email"
                v-validate
                data-vv-rules="required|email"
                class="form-control"
                type="text"
                id="email"
                :placeholder="$t('register.email')"
                :class="{ 'has-error' : errors.has('email') }"
              >
              <span
                v-show="errors.has('email')"
                class="text-danger"
              >
                {{ errors.first('email') }}
              </span>
            </div>
          </div>
          <div
            class="form-group"
          >
            <label
              class="control-label col-md-12"
              for="password"
              v-html="$t('register.password')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('password') }"
            >
              <input
                autocomplete="off"
                name="password"
                v-model="password"
                v-validate
                data-vv-rules="required|min:6"
                class="form-control"
                type="password"
                id="password"
                :placeholder="$t('register.password')"
                :class="{ 'has-error' : errors.has('password') }"
              >
              <span
                v-show="errors.has('password')"
                class="text-danger"
              >
                {{ errors.first('password') }}
              </span>
            </div>
          </div>
          <div
            class="form-group"
          >
            <label
              class="control-label col-md-12"
              for="password_confirmation"
              v-html="$t('register.password_confirmation')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('password_confirmation') }"
            >
              <input
                autocomplete="off"
                name="password_confirmation"
                v-model="password_confirmation"
                v-validate
                data-vv-rules="required|confirmed:password"
                class="form-control"
                type="password"
                id="password_confirmation"
                :placeholder="$t('register.password_confirmation')"
                :class="{ 'has-error' : errors.has('password_confirmation') }"
              >
              <span
                v-show="errors.has('password_confirmation')"
                class="text-danger"
              >
                {{ errors.first('password_confirmation') }}
              </span>
            </div>
          </div>
          <button
            type="submit"
            class="btn btn-success btn-block"
            v-html="$t('register.title')"
          >
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  // ...
</script>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 11.2.Script

--------------------------------------------------------------------------------------------

_[vue-app/src/components/Auth/Login.vue](/vue-app/src/components/Auth/Login.vue)_
```html
<template>
    <!-- -->
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';

  export default {
    name: 'register',
    data () {
      return {
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
        error: null
      }
    },
    methods: {
      ...mapActions({
        // we define the action of model auth.js 'authTypes.actions.register' like 'register' alias
        register: authTypes.actions.register
      }),
      validateBeforeSubmit () {
        // validator for the register form
        this.$validator.validateAll()
          .then(result => {
            if ( ! result) {
              //There are errors
              console.log('Vee-Validate is not working correctly')
            } else {
              this.register({
                  email: this.email,
                  password: this.password,
                  username: this.username
                })
                .then(
                  response => {
                    this.$router.push('/login');
                  },
                  error => {
                    this.error = true;
                  }
                )  
            }
          })
          .catch(error =>{
            console.log(error);
            this.error = true;
          })
      }
    }
  }
</script>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 11.3.Showing the Component in his Route

--------------------------------------------------------------------------------------------

Add the new route in [vue-app/src/router/index.js](./vue-app/src/router/index.js)

_[vue-app/src/router/index.js](./vue-app/src/router/index.js)_
```diff
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
import Login from '../components/Auth/Login';
++ import Register from '../components/Auth/Register';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    // configuration each router
    {
      // config login route ...
    },
++  {
++    path: '/register',
++    name: '/register',
++    component: Register,
++    meta: { Auth: false, title: 'Registrarse' },
++    beforeEnter: (to, from, next) =>{
++      // if the user is loggin  
++      if(store.state.authModule.logged) {
++        next({ path: '/' });
++      } else {
++        next();
++      }
++    }
++  },
  ]
});
//.configure the router

//for each route change
  // ...
//.for each route change

export default router;
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 12.Persist User in the Browser

--------------------------------------------------------------------------------------------

_[vue-app/src/router/index.js](./vue-app/src/router/index.js)_
```diff
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
import Login from '../components/Auth/Login';
++ import Register from '../components/Auth/Register';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    // configuration each router
    {
      // config login route ...
    },
    {
      // config register route ...
    },
  ]
});
//.configure the router

//for each route change
router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  // check if the route need authentication and the user is auth
  if (to.meta.Auth && !store.state.authModule.logged) {
    next({path: '/login'});
  } else {
++  if (store.state.authModule.logged) {
++    store.commit(authTypes.mutations.setUser);
++  }
    next();
  }
});
//.for each route change

export default router;
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

## 13.Cinema Module

--------------------------------------------------------------------------------------------

_[vue-app/src/types/cinema.js](./vue-app/src/types/cinema.js)_
```js
import namespace from '../utils/namespace';

export default namespace('cinema', {
  getters: [
    'cinemas',
    'search',
    'rooms',
    'seats'
  ],
  actions: [
    'fetchCinemas'
  ],
  mutations: [
    'receivedCinemas',
    'setSearch',
    'setRooms',
    'setSeats',
    'clearFilter'
  ]
})
```

_[vue-app/src/modules/auth.js](./vue-app/src/modules/cinema.js)_
```js
import types from '../types/cinema';
import globalTypes from '../types/global';
import Vue from 'vue';

const state = {
  // ...
};
const actions = {
  // ...
};
const getters = {
  // ...  
};
const mutations = {
  // ...  
};

export default {
  state,
  actions,
  getters,
  mutations
};
```


_[vue-app/src/main.js](./vue-app/src/main.js)_
```diff
// ...
//modules and types
  import globalTypes from './types/global';
  import authModule from './modules/auth';
++ import cinemaModule from './modules/cinema';
//.modules and types

//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
      state: {
        // default values
      },
      actions: {
        // actions 
      },
      getters: {
        // get the value of data
      },
      mutations: {
        // manage the change in the data
      },
      modules: {
        authModule,
++      cinemaModule,
      }
    });
    //.global data warehouse with vuex
//.vuex
// ...
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>


--------------------------------------------------------------------------------------------

### 13.1.State

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/cinema.js)_
```diff
import types from '@/types/cinema';
import globalTypes from '@/types/global';
import Vue from 'vue';

const state = {
++ cinemas: [],
++ query: {
++   search: '',
++   rooms: null,
++   seats: null
++ }
};
const actions = {
  // ...
};
const getters = {
  // ...  
};
const mutations = {
  // ...  
};

export default {
  state,
  actions,
  getters,
  mutations
};
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>


--------------------------------------------------------------------------------------------

### 13.2.Actions

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/cinema.js)_
```diff
import types from '@/types/cinema';
import globalTypes from '@/types/global';
import Vue from 'vue';
++ import Axios from 'axios';

const state = {
  // ...  
};
const actions = {
++ [types.actions.fetchCinemas]: ({commit}) => {
++   // start processing  
++   commit(globalTypes.mutations.startProcessing);
++   Axios
++     .post('http://127.0.0.1:8000/api/v1/cinemas',
++       {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
++     .then(response => {
++       commit(types.mutations.receivedCinemas, {apiResponse: response.data});
++       // end processing
++       commit(globalTypes.mutations.stopProcessing);
++     })
++ }
};
const getters = {
  // ...  
};
const mutations = {
  // ...  
};

export default {
  state,
  actions,
  getters,
  mutations
};
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 13.3.Mutations

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/cinema.js)_
```diff
import types from '@/types/cinema';
import globalTypes from '@/types/global';
import Vue from 'vue';
import Axios from 'axios';

const state = {
  // ...  
};
const actions = {
  // ...  
};
const getters = {
  // ...  
};
const mutations = {
++ [types.mutations.receivedCinemas]: (state, {apiResponse}) => {
++   state.cinemas = apiResponse.data;
++ },
++ // Filter setSearch ... to do
++ // Filter setRooms ... to do
++ // Filter setSeats ... to do
++ // Filter clearFilter ... to do
};

export default {
  state,
  actions,
  getters,
  mutations
};
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 13.4.Getters

--------------------------------------------------------------------------------------------

_[vue-app/src/modules/auth.js](./vue-app/src/modules/cinema.js)_
```diff
import types from '@/types/cinema';
import globalTypes from '@/types/global';
import Vue from 'vue';
import Axios from 'axios';

const state = {
  // ...  
};
const actions = {
  // ...  
};
const getters = {
++ [types.getters.search]: state => state.query.search,
++ [types.getters.rooms]: state => state.query.rooms,
++ [types.getters.seats]: state => state.query.seats,
++ [types.getters.cinemas]: (state) => {
++   let cinemas = state.cinemas;
++   if(state.query.search) {
++     cinemas = cinemas.filter(cinema => cinema.cinema_name.toLowerCase().includes(state.query.search))
++   }
++   if(state.query.rooms) {
++     cinemas = cinemas.filter(cinema => cinema.__meta__.number_of_rooms >= state.query.rooms);
++   }
++   if(state.query.seats) {
++     cinemas = cinemas.filter(cinema => cinema.cinema_seat_capacity >= state.query.seats);
++   }
++   return cinemas;
++ } 
};
const mutations = {
  // ...  
};

export default {
  state,
  actions,
  getters,
  mutations
};
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 13.5.Cinema Component with Hook Mounted

--------------------------------------------------------------------------------------------

_[vue-app/src/router/index.js](./vue-app/src/router/index.js)_
```diff
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
import Login from '../components/Auth/Login';
import Register from '../components/Auth/Register';
++ import Cinemas from '../components/Cinemas/Cinemas';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    // configuration each router
    {
      // config login route ...
    },
    {
      // config register route ...
    },
++  {
++    path: '/',
++    name: 'cinemas',
++    component: Cinemas,
++    meta: { Auth: false, title: 'Cines' },
++  },    
  ]
});
//.configure the router

//for each route change
  // ...
//.for each route change

export default router;
```

_[vue-app/src/components/Cinemas/Cinemas.vue](./vue-app/src/components/Cinemas/Cinemas.vue)_
```html
<template>
  <div>
    <div class="col-md-3 col-xs-12" id="filters">
    </div>
    <div class="row" id="cinemas" >
    </div>
  </div>
</template>

<script>
  import cinemaTypes from '../../types/cinema';
  import {mapGetters} from 'vuex';

export default {
    name: 'cinema-list',
  }
</script>
```

_[vue-app/src/components/Cinemas/Cinemas.vue](./vue-app/src/components/Cinemas/Cinemas.vue)_
```diff
<template>
  <div>
    <div class="col-md-3 col-xs-12" id="filters">
    </div>
    <div class="row" id="cinemas" >
    </div>
  </div>
</template>

<script>
  import cinemaTypes from '../../types/cinema';
  import {mapGetters} from 'vuex';

export default {
    name: 'cinema-list',
++  mounted () {
++     this.$store.dispatch(cinemaTypes.actions.fetchCinemas);
++  },
  }
</script>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>

--------------------------------------------------------------------------------------------

### 13.6.Subcomponent Item

--------------------------------------------------------------------------------------------

_[vue-app/src/components/Cinemas/CinemaItem.vue](./vue-app/src/components/Cinemas/CinemaItem.vue)_
```html
<template>
  <div class="col-md-12 col-xs-12 CinemaItem__Wrapper">
  </div>
</template>

<script>
  export default {

  }
</script>

<style scoped>
  .CinemaItem__Wrapper {
    background: #181D23 !important;
    padding: 10px;
  }
  .CinemaItem__Wrapper h2 {
    margin-top: 0;
  }
</style>
```

_[vue-app/src/components/Cinemas/Cinemas.vue](./vue-app/src/components/Cinemas/Cinemas.vue)_
```diff
<template>
  <div>
    <div class="col-md-3 col-xs-12" id="filters">
    </div>
    <div class="row" id="cinemas" >
++    <cinema-item></cinema-item>
    </div>
  </div>
</template>

<script>
  import cinemaTypes from '../../types/cinema';
  import {mapGetters} from 'vuex';
++ import CinemaItem from "./CinemaItem";

export default {
    name: 'cinema-list',
++  components: {
++    CinemaItem
++  },    
    mounted () {
      this.$store.dispatch(cinemaTypes.actions.fetchCinemas);
    },
  }
</script>
```

_[vue-app/src/components/Cinemas/CinemaItem.vue](./vue-app/src/components/Cinemas/CinemaItem.vue)_
```diff
<template>
  <div class="col-md-12 col-xs-12 CinemaItem__Wrapper">
  </div>
</template>

<script>
  export default {
++  name: 'cinema-item',
++  props: {
++      cinema: {
++          type: Object,
++          required: true
++      }
++  }
  }
</script>

<style scoped>
  .CinemaItem__Wrapper {
    background: #181D23 !important;
    padding: 10px;
  }
  .CinemaItem__Wrapper h2 {
    margin-top: 0;
  }
</style>
```

_[vue-app/src/components/Cinemas/Cinemas.vue](./vue-app/src/components/Cinemas/Cinemas.vue)_
```diff
<template>
  <div>
    <div class="col-md-3 col-xs-12" id="filters">
    </div>
    <div class="row" id="cinemas" >
--    <cinema-item></cinema-item>
++    <cinema-item :cinema="cinema" :key="index" style="margin:10px;"></cinema-item>
    </div>
  </div>
</template>

<script>
  import cinemaTypes from '../../types/cinema';
  import {mapGetters} from 'vuex';
  import CinemaItem from "./CinemaItem";

export default {
    name: 'cinema-list',
    components: {
      CinemaItem
    },    
    mounted () {
      this.$store.dispatch(cinemaTypes.actions.fetchCinemas);
    },
  }
</script>
```


_[vue-app/src/components/Cinemas/CinemaItem.vue](./vue-app/src/components/Cinemas/CinemaItem.vue)_
```diff
<template>
-- <div class="col-md-12 col-xs-12 CinemaItem__Wrapper">
++ <div class="card" style="background:#181d23;">
++  <div class="col-md-12 col-xs-12">
++    <img :src="'./assets/screenshot/'+cinema.screenshot" class="card-img-top" alt="Card image cap"/>
++  </div>
++  <div class="card-body">
++    <h2 class="card-title">
++      <router-link :to="{name: 'cinema', params: {id: cinema.id}}" class="card-link" style="line-height: 1; max-height: 2;">
++        {{ $t('cinema.name') }}: {{ cinema.name }}
++      </router-link>
++    </h2>
++    <p class="card-text">{{ $t('cinema.address') }}: </p>
++    <p class="card-text" style="line-height: 1; max-height: 2; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ cinema.address }}</p>
++    <p class="card-text">{{ $t('cinema.details') }}: {{ cinema.details }}</p>
++    <p class="card-text">{{ $t('cinema.telephone') }}: {{ cinema.phone }}</p>
++    <p class="card-text">{{ $t('cinema.seats') }}: {{ cinema.seatCapacity }}</p>
++    <p class="card-text">{{ $t('cinema.rooms') }}: {{ cinema.countRooms }}</p>
++  </div>
  </div>
</template>

<script>
  export default {
    name: 'cinema-item',
    props: {
      cinema: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style scoped>
  .CinemaItem__Wrapper {
    background: #181D23 !important;
    padding: 10px;
  }
  .CinemaItem__Wrapper h2 {
    margin-top: 0;
  }
</style>
```

* We will used the getter to can filter the result.
> It's necessary define the `:key="index"` in the bucle for.

_[vue-app/src/components/Cinemas/Cinemas.vue](./vue-app/src/components/Cinemas/Cinemas.vue)_
```diff
<template>
  <div>
    <div class="col-md-3 col-xs-12" id="filters">
    </div>
    <div class="row" id="cinemas" >
++    <div v-if="cinemas.data.length > 0" class="row" id="cinemas" >
++      <div v-for="(cinema, index) in cinemas" :key="index" class="col-lg-4 col-md-6 col-xs-12" style="padding:0px;">
--        <cinema-item :cinema="cinema"></cinema-item>
++        <cinema-item :cinema="cinema" :key="index" style="margin:10px;"></cinema-item>
++      </div>
++    </div>
    </div>
  </div>
</template>

<script>
  import cinemaTypes from '../../types/cinema';
  import {mapGetters} from 'vuex';
  import CinemaItem from "./CinemaItem";

export default {
    name: 'cinema-list',
    components: {
      CinemaItem
    },    
    mounted () {
      this.$store.dispatch(cinemaTypes.actions.fetchCinemas);
    },
++  computed: {
++    ...mapGetters({
++      cinemas: cinemaTypes.getters.cinemas
++    })
++  }   
  }
</script>
```

<div style="text-align: right"><a href="#summary-steps">Return to <strong>Summary Steps</strong></a></div>