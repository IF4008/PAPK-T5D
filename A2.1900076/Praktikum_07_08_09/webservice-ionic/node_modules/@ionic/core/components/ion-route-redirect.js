/*!
 * (C) Ionic http://ionicframework.com - MIT License
 */
import { HTMLElement, createEvent, proxyCustomElement } from '@stencil/core/internal/client';

let RouteRedirect = class extends HTMLElement {
  constructor() {
    super();
    this.__registerHost();
    this.ionRouteRedirectChanged = createEvent(this, "ionRouteRedirectChanged", 7);
  }
  propDidChange() {
    this.ionRouteRedirectChanged.emit();
  }
  connectedCallback() {
    this.ionRouteRedirectChanged.emit();
  }
  static get watchers() { return {
    "from": ["propDidChange"],
    "to": ["propDidChange"]
  }; }
};
RouteRedirect = /*@__PURE__*/ proxyCustomElement(RouteRedirect, [0, "ion-route-redirect", {
    "from": [1],
    "to": [1]
  }]);
function defineCustomElement$1() {
  if (typeof customElements === "undefined") {
    return;
  }
  const components = ["ion-route-redirect"];
  components.forEach(tagName => { switch (tagName) {
    case "ion-route-redirect":
      if (!customElements.get(tagName)) {
        customElements.define(tagName, RouteRedirect);
      }
      break;
  } });
}

const IonRouteRedirect = RouteRedirect;
const defineCustomElement = defineCustomElement$1;

export { IonRouteRedirect, defineCustomElement };
