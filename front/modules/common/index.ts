import * as angular from 'angular';
import './index.scss';
import * as ngSanitize from 'angular-sanitize';
import * as uiModal from 'angular-ui-bootstrap/src/modal';

export const COMMON_MODULE = 'nanos.common';

angular.module(COMMON_MODULE, [ngSanitize, uiModal]);
