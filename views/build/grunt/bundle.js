module.exports = function(grunt) {

    var requirejs   = grunt.config('requirejs') || {};
    var clean       = grunt.config('clean') || {};
    var copy        = grunt.config('copy') || {};

    var root        = grunt.option('root');
    var libs        = grunt.option('mainlibs');
    var ext         = require(root + '/tao/views/build/tasks/helpers/extensions')(grunt, root);
    var out         = 'output';

    /**
     * Remove bundled and bundling files
     */
    clean.generishardbundle = [out];

    /**
     * Compile tao files into a bundle
     */
    requirejs.generishardbundle = {
        options: {
            baseUrl : '../js',
            dir : out,
            mainConfigFile : './config/requirejs.build.js',
            paths : { 'generisHard' : root + '/generisHard/views/js' },
            modules : [{
                name: 'generisHard/controller/routes',
                include : ext.getExtensionsControllers(['generisHard']),
                exclude : ['mathJax', 'mediaElement'].concat(libs)
            }]
        }
    };

    /**
     * copy the bundles to the right place
     */
    copy.generishardbundle = {
        files: [
            { src: [out + '/generisHard/controller/routes.js'],  dest: root + '/generisHard/views/js/controllers.min.js' },
            { src: [out + '/generisHard/controller/routes.js.map'],  dest: root + '/generisHard/views/js/controllers.min.js.map' }
        ]
    };

    grunt.config('clean', clean);
    grunt.config('requirejs', requirejs);
    grunt.config('copy', copy);

    // bundle task
    grunt.registerTask('generishardbundle', ['clean:generishardbundle', 'requirejs:generishardbundle', 'copy:generishardbundle']);
};
