import * as angular from 'angular';
import {bootstrap} from '../../core/bootstrap';
import {COMMON_MODULE} from '../common';

import {DashboardController} from './controller/dashboard.controller';
import {CampaignService} from './service/campaign.service';

export const CAMPAIGN_MODULE = 'nanos.campaign';

angular.module(CAMPAIGN_MODULE, [COMMON_MODULE])
    .controller('DashboardController', DashboardController)
    .service('CampaignService', CampaignService)
;

bootstrap(CAMPAIGN_MODULE);
