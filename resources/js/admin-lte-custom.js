
var SELECTOR_PRELOADER = '.preloader';

function _interopDefaultLegacy (e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }


setTimeout(function () {
    var $__default = /*#__PURE__*/_interopDefaultLegacy($);
    var $preloader = $__default["default"](SELECTOR_PRELOADER);

    if ($preloader) {
        $preloader.css('height', 0);
        setTimeout(function () {
        $preloader.children().hide();
        }, 200);
    }
}, 200);
