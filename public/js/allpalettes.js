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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 55);
/******/ })
/************************************************************************/
/******/ ({

/***/ 55:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(56);


/***/ }),

/***/ 56:
/***/ (function(module, exports) {

$(document).ready(function () {

    $('body').on('click', '.heart', function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var palette_id = $(this).parent().parent().find('.id').val();

        if ($(this).hasClass('glyphicon-heart-empty')) {
            //LIKE
            $(this).removeClass('glyphicon-heart-empty');
            $(this).addClass('glyphicon-heart');

            var likes = $(this).closest('.single-palett-wrapper').find('.likes-nr').html();
            $(this).closest('.single-palett-wrapper').find('.likes-nr').html(likes - -1);

            var type = "POST";
        } else if ($(this).hasClass('glyphicon-heart')) {
            //UNLIKE
            $(this).removeClass('glyphicon-heart');
            $(this).addClass('glyphicon-heart-empty');
            if (window.location.pathname == '/palettes/favourite') {
                $(this).closest('.single-palett-wrapper').remove();
            }
            var likes = $(this).closest('.single-palett-wrapper').find('.likes-nr').html();
            $(this).closest('.single-palett-wrapper').find('.likes-nr').html(likes - 1);

            var type = "DELETE";
        }

        $.ajax({
            type: type,
            url: '/like/' + palette_id,
            success: function success(data) {},
            error: function error(data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.trash', function (e) {
        e.preventDefault();
        if (confirm("Do you realy want to delete palette?") == true) {
            //OK
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            var palette_id = $(this).parent().parent().find('.id').val();
            $(this).closest('.single-palett-wrapper').remove();

            $.ajax({
                type: 'DELETE',
                url: '/palette/' + palette_id,
                success: function success(data) {},
                error: function error(data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    $('.palettes-wrapper').ready(function () {
        $('.color-title').each(function () {

            var color = $(this).html();

            var hsl = rgbToHsl(hexToRgb(color).r, hexToRgb(color).g, hexToRgb(color).b);
            if (hsl[2] > 0.7) {
                $(this).css("color", 'black');
            } else if (hsl[2] <= 0.7) {
                $(this).css("color", 'white');
            }
        });
    });
});

/***/ })

/******/ });