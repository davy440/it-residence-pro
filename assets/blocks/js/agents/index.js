/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/blocks/jsx/agents/index.js":
/*!*******************************************!*\
  !*** ./assets/blocks/jsx/agents/index.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   attsContext: () => (/* binding */ attsContext)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _section__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./section */ "./assets/blocks/jsx/agents/section.js");
/* harmony import */ var _inc_blocks_agents_block_json__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../../../inc/blocks/agents/block.json */ "./inc/blocks/agents/block.json");









const attsContext = (0,react__WEBPACK_IMPORTED_MODULE_6__.createContext)();
const slug = 'it-listings/agents';
const blockData = {
  icon: {
    src: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
      xmlns: "http://www.w3.org/2000/svg",
      "enable-background": "new 0 0 24 24",
      height: "24px",
      viewBox: "0 0 24 24",
      width: "24px",
      fill: "#000000"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("rect", {
      fill: "none",
      height: "24",
      width: "24"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "M21,6.5V14h-2V7.5L14,4L9,7.5V9H7V6.5l7-5L21,6.5z M15.5,7h-1v1h1V7z M13.5,7h-1v1h1V7z M15.5,9h-1v1h1V9z M13.5,9h-1v1h1V9 z M19,16h-2c0-1.2-0.75-2.28-1.87-2.7L8.97,11H1v11h6v-1.44l7,1.94l8-2.5v-1C22,17.34,20.66,16,19,16z M3,20v-7h2v7H3z M13.97,20.41 L7,18.48V13h1.61l5.82,2.17C14.77,15.3,15,15.63,15,16c0,0-1.99-0.05-2.3-0.15l-2.38-0.79l-0.63,1.9l2.38,0.79 c0.51,0.17,1.04,0.26,1.58,0.26H19c0.39,0,0.74,0.23,0.9,0.56L13.97,20.41z"
    }))
  },
  edit: ({
    attributes,
    setAttributes
  }) => {
    const allAgents = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.useSelect)(select => select('core').getEntityRecords('postType', 'agent', {
      per_page: -1
    }), []);
    const {
      title,
      description,
      agents
    } = attributes;
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)({
      className: "itre-editor-agents section"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
      className: "itre-editor-agents__title"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Agents")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Title"),
      value: title,
      onChange: value => setAttributes({
        title: value
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Description"),
      value: description,
      onChange: value => setAttributes({
        description: value
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(attsContext.Provider, {
      value: {
        attributes,
        setAttributes
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "itre-editor-agents__wrapper"
    }, agents.map(agent => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_section__WEBPACK_IMPORTED_MODULE_7__["default"], {
      agent: agent,
      all: allAgents
    })))));
  },
  save: () => null,
  ..._inc_blocks_agents_block_json__WEBPACK_IMPORTED_MODULE_8__
};
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)(slug, blockData);

/***/ }),

/***/ "./assets/blocks/jsx/agents/section.js":
/*!*********************************************!*\
  !*** ./assets/blocks/jsx/agents/section.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var ___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! . */ "./assets/blocks/jsx/agents/index.js");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);






const Agent = ({
  agent,
  all
}) => {
  const {
    attributes,
    setAttributes
  } = (0,react__WEBPACK_IMPORTED_MODULE_1__.useContext)(___WEBPACK_IMPORTED_MODULE_2__.attsContext);
  const {
    agents
  } = attributes;
  const {
    order,
    agentId,
    role,
    phone,
    mail
  } = agent;
  const telInput = (0,react__WEBPACK_IMPORTED_MODULE_1__.useRef)();
  const mailInput = (0,react__WEBPACK_IMPORTED_MODULE_1__.useRef)();
  const validatePhone = value => {
    return /^(\+?[0-9]{1,3}\s?)\(?([0-9]{3})\)?[\s.-]?[0-9]{3}[\s.-]?[0-9]{4}$/.test(value);
  };
  const validateEmail = value => {
    return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value);
  };
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (phone === "" || validatePhone(phone)) {
      telInput.current.classList.remove('error');
      (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.dispatch)('core/editor').unlockPostSaving('invalid-phone');
    } else {
      telInput.current.classList.add('error');
      (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.dispatch)('core/editor').lockPostSaving('invalid-phone');
    }
  }, [phone]);
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (mail === "" || validateEmail(mail)) {
      mailInput.current.classList.remove('error');
      (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.dispatch)('core/editor').unlockPostSaving('invalid-mail');
    } else {
      mailInput.current.classList.add('error');
      (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.dispatch)('core/editor').lockPostSaving('invalid-mail');
    }
  }, [mail]);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "itre-editor-agents__agent"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Select Agent"),
    value: agentId,
    onChange: value => {
      const newAgents = agents.map(item => {
        return item['order'] === order ? {
          ...item,
          agentId: value
        } : item;
      });
      setAttributes({
        agents: newAgents
      });
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("option", {
    value: 0
  }, "\u2013Select\u2013"), all !== null && all.map(item => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("option", {
    value: item['id']
  }, item['title'].rendered))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Role"),
    placeholder: "Agent",
    value: role,
    onChange: value => {
      const newAgents = agents.map(item => {
        return item['order'] === order ? {
          ...item,
          role: value
        } : item;
      });
      setAttributes({
        agents: newAgents
      });
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    ref: telInput,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Phone"),
    placeholder: "+1 123-456-7890",
    type: "tel",
    value: phone,
    onChange: value => {
      const newAgents = agents.map(item => {
        return item['order'] === order ? {
          ...item,
          phone: value
        } : item;
      });
      setAttributes({
        agents: newAgents
      });
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    ref: mailInput,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Mail"),
    type: "email",
    value: mail,
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("abc@example.com"),
    onChange: value => {
      const newAgents = agents.map(item => {
        return item['order'] === order ? {
          ...item,
          mail: value
        } : item;
      });
      setAttributes({
        agents: newAgents
      });
    }
  }));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Agent);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./inc/blocks/agents/block.json":
/*!**************************************!*\
  !*** ./inc/blocks/agents/block.json ***!
  \**************************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"apiVersion":3,"name":"it-listings/agents","title":"Agents","category":"it-listings","keywords":["agents","properties","real estate","dealers","brokers","property"],"attributes":{"title":{"type":"string","default":""},"description":{"type":"string","default":""},"align":{"type":"string","default":"center"},"agents":{"type":"array","default":[{"order":1,"agentId":0,"role":"","phone":"","mail":""},{"order":2,"agentId":0,"role":"","phone":"","mail":""},{"order":3,"agentId":0,"role":"","phone":"","mail":""},{"order":4,"agentId":0,"role":"","phone":"","mail":""}]}},"editorStyle":"itre-editor-agents-css","style":"itre-agents-css","editorScript":"itre-agents-js","render":"./agents.php"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/blocks/jsx/agents/index.js");
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map