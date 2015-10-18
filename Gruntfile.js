module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                options: {
                    sourcemap: 'none'
                },
                files: {
                    'assets/css/magictest.css': 'assets/css/scss/magictest.scss',
                }
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            css: {},
            js: {},
            cssVendor: {
                src: [
                    'assets/vendor/bootstrap/dist/css/bootstrap.css', 
                    'assets/vendor/font-awesome/css/font-awesome.css',
                ],
                dest: 'assets/css/vendor.css'
            },
            jsVendor: {
                src: [
                    'assets/vendor/jquery/dist/jquery.js', 
                    'assets/vendor/bootstrap/dist/js/bootstrap.js', 
                ],
                dest: 'assets/js/vendor.js'
            }
        },
        cssmin: {
            minify: {
                files: {
                    'assets/css/magictest.min.css': 'assets/css/magictest.css',
                    'assets/css/vendor.min.css': 'assets/css/vendor.css'
                }
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            main: {
                files: [{
                    'assets/js/vendor.min.js': 'assets/js/vendor.js',
                    'assets/js/magictest.min.js': 'assets/js/magictest.js'
                }]
            }
        },
        watch: {
            css: {
                files: ['assets/css/scss/**/*.scss'],
                tasks: ['sass', 'concat:css', 'cssmin']
            },
            js: {
                files: 'assets/js/*.js',
                tasks: ['concat:js']
            }
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true, 
                        flatten: true,
                        src: [
                            'assets/vendor/font-awesome/fonts/*', 
                            'assets/vendor/bootstrap/dist/fonts/*'
                        ], 
                        dest: 'assets/fonts'
                    }
                ]
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('compile', ['concat:jsVendor', 'uglify']);
    grunt.registerTask('build', ['sass','concat:cssVendor','cssmin', 'compile']);
}