const Encore = require('@symfony/webpack-encore');
const dotenv = require('dotenv-webpack');

require("dotenv").config();

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath(process.env.APP_URL + 'build')
    .setManifestKeyPrefix('build/')
    .addEntry('TH/app', './assets/TH/index.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .addPlugin(new dotenv({
        ignoreStub: true
    }))
;

module.exports = Encore.getWebpackConfig();
