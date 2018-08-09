export class CampaignService
{
    /* @ngInject */
    constructor(
        private $http: ng.IHttpService
    ) {}

    /**
     * @returns {angular.IPromise<angular.IHttpResponse<any>>}
     */
    getList() {
        return this.$http.get('/api/campaign/list')
            .then((response) => response.data);
    }

    /**
     * @param {number} campaignId
     * @returns {angular.IPromise<angular.IHttpResponse<any>>}
     */
    getById(campaignId: number) {
        return this.$http.get('/api/campaign/view/' + campaignId)
            .then((response) => response.data);
    }
}
