const Encore = require('@symfony/webpack-encore');
const dotenv = require('dotenv-webpack');
const resolve = require("path").resolve;

require("dotenv").config();

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath(process.env.APP_URL + 'build')
    .setManifestKeyPrefix('build/')
    .addEntry('jefes/app', './assets/jefes/index.js')
    .addEntry('control/app', './assets/control/index.js')
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

let config = Encore.getWebpackConfig();
config.resolve.alias = {
    '@': resolve(__dirname, './assets')
};

module.exports = config;
