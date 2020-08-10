# Application Symfony avec VueJs et TailwindCss


## Installation

### Symfony

Créer un projet symfony

```

symfony new nomDuProjet --full

```

Ajouter le pack apache pour avoir la barre de debug qui fonctionne correctement

```

composer require apache-pack

```

Installer webpack Encore

```

composer require webpack-encore

```

### Côté Js

Installer les dépendances pour webpack-encore

```

yarn install

```

### vueJs

Activer vueJs pour webpack

```
//webpack.config.js

.enableVueLoader()

```

Lancer la commande

```
yarn run dev-server

```

VueJs n'étant pas installé, vous aurez un message avec les composants à ajouter.
Lors de la création du document ( août 2019) la commande est 
 
```

yarn add vue vue-loader@^15.0.11 vue-template-compiler --dev

```

### Tailwindcss

```

yarn add tailwindcss

```

Créer un fichier à la racine du projet **postcss.config.js**

```
module.exports = {
  plugins: [
    require('tailwindcss'),
    require('autoprefixer')
  ]
}

```

Activer postCss et autoprefixer

```
//webpack.config.js

.enablePostCssLoader()

```

Lancer la commande

```
yarn run dev-server

```

postcss n'étant pas installé, vous aurez un message avec les composants à ajouter.
Lors de la création du document ( août 2019) la commande est

```

yarn add postcss-loader@^3.0.0 autoprefixer --dev

```

Ajouter ensuite dans votre **package.json**

```
"browserslist": [
    "> 0.5%",
    "last 2 versions",
    "IE 11"
 ]

```

### sass

```

yarn add sass-loader sass node-sass --dev

```

Activer sass pour webpack

```

//webpack.config.js


.enableSassLoader()

```

Si vous utilisez tailwindcss vous devez désactiver le resolverUrl

```


.enableSassLoader(function (options) {}, {
  resolveUrlLoader: false
})

```
## Premier pas

Pour communiquer avec webpack depuis votre VM et bénéficier des avantages du server Js modifier dans votre

**package.json**

```
...


"scripts": {
    "dev-server": "encore dev-server --port 8081 --host 0.0.0.0 --public http://VOTREDNS:8081 --disable-host-check",
     ...   
},

...

```

Créer un controller

```
php bin/console make:controller

```

Ajouter les liens css et js pour webpack

```
//ex: template/base.html.twig

//pour le css
{% block stylesheets %}
    {{ encore_entry_link_tags('app') }}
{% endblock %}

//pour le js
{% block javascripts %}
    {{ encore_entry_script_tags('app') }}
{% endblock %}

```
le tag **app** et lié à l'entrée définie dans **webpack.config.js**

```
.addEntry('app', './assets/js/app.js')

```

Afficher une page héritant de votre template principal, et modifier la couleur de fond par exemple, la modification
sera automatiquement appliquée...(merci le hot reloading)

```
//assets/css/app.css

body {
    background-color: red;
}


```

Ajoutons un peu de VueJs avec un component Custom

Créer un fichier **assets/vuejs/index.js**

```

import Vue from 'vue'

new Vue({
    el: '#appWithVueJsComponent'
});


```

On va greffer VueJs à un élement html ayant l'id **appWithVueJsComponent**

Ajouter ensuite l'entrée dans **webpack.config.js**

```
.addEntry('vuejs', './assets/vuejs/index.js')

```

Déclarer l'élement id et le Js pour webpack

```
ex: templates/base.html.twig

{% block stylesheets %}
    ....
    {{ encore_entry_link_tags('vuejs') }}
{% endblock %}

<div id="appWithVueJsComponent">
    {% block body %}
    
    {% endblock %}
</div>

....

{% block javascripts %}
    ....    
    {{ encore_entry_script_tags('vuejs') }}

{% endblock %}


``` 
Redémarrer le serveur Js pour qu'il prenne en compte la nouvelle entrée.

``` 

yarn run dev-server

``` 

### Création d'un composant vueJs

Créer un fichier sous assets/vuejs/components/HelloWord.vue

```

<script>
    export  default {
        name: 'HelloWord'
    }
</script>
<template>
    <div>
        <span class="title">Mon composant qui fait HelloWord</span>
    </div>
</template>
<style lang="scss">

    $colorTitle: #FF0000;

    .title {
        background: $colorTitle;
        color: #FFF;
    }

</style>


```
Activation du composant globalement

```
//assets/vuejs/index.js

import Vue from 'vue'
import HelloWord from "./components/HelloWord";


new Vue({
    el: '#app',
    components: {
        HelloWord
    }
});


```

Il ne reste plus qu'à l'utiliser dans notre template twig

```
//templates/app/index.html.twig

{% block body %}
    <div>Mon super projet</div>
    <div><hello-word/></div>
{% endblock %}


```

# Polyfill

De base webpackEncore ajoute tous les polyfills nécessaire pour que votre application soit le plus compatible possible.

Cependant lors de l'utilisation de promise dans un composant vuejs j'ai rencontré sur IE 11 une erreur de style

```

Promise est indéfinie

```

La solution trouvée a été de re-importer les polyfills nécessaire.

```
assets/vuejs/index.js

import "core-js/stable";
import "regenerator-runtime/runtime";


## Tests

```

yarn add @vue/test-utils jest --dev

```

si besoin

```
yarn add jest jest-canvas-mock babel-jest vue-jest --dev 
```

package.json

```
"scripts": {
    ...
     "test": "jest"
}
```

jest.config.js

```
module.exports = {
    moduleFileExtensions: [
        'js',
        'jsx',
        'json',
        'vue'
    ],
    transform: {
        '^.+\\.vue$': 'vue-jest',
        '^.+\\.jsx?$': 'babel-jest'
    },
    transformIgnorePatterns: [
        '/node_modules/'
    ],
    moduleNameMapper: {
        '^@/(.*)$': '<rootDir>/src/$1'
    },
    testMatch: [
        '**/tests/**/*.spec.(js|jsx|ts|tsx)|**/__tests__/*.(js|jsx|ts|tsx)'
    ],
    testURL: 'http://localhost/'
}

```

babel.config.js

```
module.exports = {
    presets: [
        [
            '@babel/preset-env',
            {
                targets: {
                    node: 'current',
                },
            },
        ],
    ],
};

```







## Références

- https://symfony.com/doc/current/frontend.html

- https://tailwindcss.com



