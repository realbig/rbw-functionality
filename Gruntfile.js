'use strict';
module.exports = function (grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        // Define watch tasks
        watch: {
            options: {
                livereload: true
            },
            sass: {
                files: ['build/sass/**/*.scss', '!build/sass/login/**/*.scss', '!build/sass/login.scss'],
                tasks: ['sass:admin', 'autoprefixer:admin', 'notify:sass']
            },
            sass_login: {
                files: ['build/sass/login/**/*.scss'],
                tasks: ['sass:login', 'autoprefixer:login', 'notify:login']
            },
            js: {
                files: ['build/js/**/*.js'],
                tasks: ['uglify:admin', 'notify:js']
            },
            livereload: {
                files: ['**/*.html', '**/*.php', 'build/images/**/*.{png,jpg,jpeg,gif,webp,svg}', '!**/*ajax*.php']
            }
        },

        // SASS
        sass: {
            options: {
                sourceMap: true
            },
            admin: {
                files: {
                    'css/style.css': 'build/sass/main.scss'
                }
            },
            login: {
                files: {
                    'css/login.css': 'build/sass/login.scss'
                }
            }
        },

        // Auto prefix our CSS with vendor prefixes
        autoprefixer: {
            options: {
                map: true
            },
            admin: {
                src: 'css/style.css'
            },
            login: {
                src: 'css/login.css'
            }
        },

        // Uglify and concatenate
        uglify: {
            options: {
                sourceMap: true
            },
            admin: {
                files: {
                    'js/script.js': [
                        'build/js/**/*.js',
                    ]
                }
            }
        },

        notify: {
            js: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'JS Complete'
                }
            },
            sass: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'SASS Complete'
                }
            },
            login: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'Login Complete'
                }
            }
        }

    });

    // Register our main task
    grunt.registerTask('default', ['watch']);
};