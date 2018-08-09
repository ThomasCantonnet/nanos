// We're using Bootstrap config
const autoprefixerConfig = {
    remove: false,
    browsers: [
        'Chrome >= 45',
        'Firefox ESR',
        'Edge >= 12',
        'Explorer >= 11',
        'iOS >= 8',
        'Safari >= 8',
        'Android >= 4.4',
        'Opera >= 30'
    ]
};

module.exports = {
    plugins: [
        require('autoprefixer')(autoprefixerConfig),
    ]
};
