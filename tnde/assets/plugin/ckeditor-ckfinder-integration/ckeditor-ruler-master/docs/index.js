require('ckeditor-ruler');

window.onload = function() {
    CKEDITOR.plugins.addExternal('ruler', '/node_modules/ckeditor-ruler/', 'plugin.js');
    CKEDITOR.config.extraPlugins = 'ruler';
    CKEDITOR.config.height = '600px';

    CKEDITOR.replace('editor');
};
