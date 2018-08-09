import * as angular from 'angular';

export const APP_MODULE = 'nanos.app';

let bootstrapped = false;

angular.module(APP_MODULE, []);

export function bootstrap(module: string) {
    // add our module to the global module dependency
    angular.module(APP_MODULE).requires.push(module);
    bootstrapped = true;

    // bootstrap the global module when document is ready (when all scripts are loaded)
    angular.element(document).ready(() => {
        angular.bootstrap(document.body, [APP_MODULE], {
            strictDi: true
        });
    });
}

export function isBootstrapped() {
    return bootstrapped;
}
