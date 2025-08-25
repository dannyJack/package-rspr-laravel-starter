import $ from 'jquery';
import {createApp}  from 'vue';
import Lang from 'lang.js';
import axios from 'axios';

let vueAppList = {};
let languageResource = null;
var languageResourceVersion = '';

import HelloWorld from './components/HelloWorld.vue'; vueAppList['hello-world'] = HelloWorld;

function initVueComponents()
{
    var defaultLocale = 'en';
    var fallbackLocale = 'en';

    if (typeof window.defaultLocale !== 'undefined') {
        defaultLocale = window.defaultLocale;
    }

    if (typeof window.fallbackLocale !== 'undefined') {
        fallbackLocale = window.fallbackLocale;
    }

    const LangCustom = new Lang({
        messages: languageResource,
        locale: defaultLocale,
        fallback: fallbackLocale
    });

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
                    const props = {};
                    Array.from(el.attributes).forEach(attr => {
                        try {
                            props[attr.name] = JSON.parse(attr.value)
                        } catch {
                            props[attr.name] = attr.value
                        }
                    });

                    var elComponent = createApp(vueAppList[components[i]], props);
                    elComponent.config.globalProperties.__ = (key, replacements, locale) => {
                        return LangCustom.get(key, replacements, locale);
                    };
                    elComponent.mount(el)
                }
            }

            break;
        }
    }
}

if (typeof window.languageResourceVersion !== 'undefined') {
    languageResourceVersion = window.languageResourceVersion;
}

axios
    .get('/storage/lang/language-resource.json?v=' + languageResourceVersion)
    .then(response => {
        let data = response.data;

        if (typeof data == 'string' ? data.search('export default') !== -1 : false) {
            data = data.split('export default ');

            if (data.length > 1) {
                languageResource = JSON.parse(data[1]);
            } else {
                console.error(['error languageResource', data]);
            }
        } else {
            languageResource = data;
        }

        initVueComponents();
    })
    .catch(function (error) {
        initVueComponents();
    });
