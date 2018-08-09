import {CampaignService} from '../service/campaign.service';

export class DashboardController implements ng.IController
{
    private campaigns: any;

    /* @ngInject */
    constructor(
        private CampaignService: CampaignService,
        private $uibModal: ng.ui.bootstrap.IModalService
    ) {}

    $onInit() {
        // Initialize campaign list
        this.CampaignService.getList().then((response: any) => {
            this.campaigns = response.campaigns;
        });
    }

    viewCampaign(campaignId: number) {
        this.CampaignService.getById(campaignId).then((response: any) => {
            this.$uibModal.open({
                animation: true,
                windowClass: 'application-modal md-modal',
                template: `
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                   <th>Id</th>
                                   <th>Name</th>
                                   <th>Goal</th>
                                   <th>Total budget</th>
                                   <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   <th>{{$ctrl.campaign.id}}</th>
                                   <th>{{$ctrl.campaign.name}}</th>
                                   <th>{{$ctrl.campaign.goal}}</th>
                                   <th>{{$ctrl.campaign.total_budget}}</th>
                                   <th>{{$ctrl.campaign.status.code}}</th>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div ng-repeat="platform in $ctrl.campaign.platforms">
                            <h2>Platform: {{platform.type}}</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                       <th>Status</th>
                                       <th>Total budget</th>
                                       <th>Remaining budget</th>
                                       <th>Start date</th>
                                       <th>End date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <th>{{platform.status.code}}</th>
                                       <th>{{platform.total_budget}}</th>
                                       <th>{{platform.remaining_budget}}</th>
                                       <th>{{platform.start_date}}</th>
                                       <th>{{platform.end_date}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                                <img src="/images/{{platform.creatives.image}}" width="500" />
                            </div>
                        </div>
                    </div>
                `,
                controller: require('./modal/campaign.modal.controller').CampaignModalController,
                controllerAs: '$ctrl',
                size: 'lg',
                resolve: {
                    campaign: /* @ngInject */ () => response.campaign
                }
            });
        });
    }
}
