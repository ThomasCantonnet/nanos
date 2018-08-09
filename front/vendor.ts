import * as angular from 'angular';
import {bootstrap, isBootstrapped} from './core/bootstrap';
import {COMMON_MODULE} from './modules/common';

angular.element(document).ready(() => {
    if (!isBootstrapped()) {
        bootstrap(COMMON_MODULE);
    }
});
