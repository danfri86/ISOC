module.exports = function (grunt) {
  'use strict';

  grunt.util.linefeed = '\n';

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    box: {
      less: 'less/_box.less',
      css: 'css/box.css',
      cssMin: 'css/box.min.css',
      banner: '/*! BOXcss <%= pkg.version %> |  https://github.com/hejhansson/BOXcss */\n'    
    },

    // Tasks
    clean: {
      dist: ['dist']
    },
    
    less: {
      dist: {
        files: {
          '<%= box.css %>': '<%= box.less %>'
        }
      },

      distMin: {
        options: {
          cleancss: true,
          report: 'min'
        },
        files: {
          '<%= box.cssMin %>': '<%= box.css %>'
        }
      }
    },

    usebanner: {
      dist: {
        options: {
          position: 'top',
          banner: '<%= box.banner %>'
        },
        files: {
          src: [
            '<%= box.cssMin %>'
          ]
        }
      }
    },

    watch: {
      less: {
        files: ['less/partials/*.less','less/*.less'],
        tasks: ['less', 'usebanner'],
        options: {
          livereload: true,
        }
      }
    }
  });

  require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

  grunt.registerTask('default', ['clean', 'less', 'usebanner']);
};