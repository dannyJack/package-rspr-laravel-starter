import $ from 'jquery';
import {createApp}  from 'vue';

let vueAppList = {};

import HelloWorld from './components/HelloWorld.vue'; vueAppList['hello-world'] = createApp(HelloWorld);

function initVueComponents()
{
    var routeName = $('body').data('page');
    var vueComponents = {};

    if (typeof window.vueComponentPageKeyValuPair !== 'undefined') {
        vueComponents = window.vueComponentPageKeyValuPair;
    }

    var components;

    for (var route in vueComponents) {
        if (routeName == route) {
            components = vueComponents[route];

            for (var i in components) {
                let elements = $(components[i]);

                for (let el of elements) {
                    vueAppList[components[i]].mount(components[i]);
                }
            }
        }
    }
}

initVueComponents();
