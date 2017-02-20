module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json')

    // compiling sass
    , sass: {
      dist: {
        options: {
          style: 'compressed'
        },
        files: [{
          expand: true,
          cwd: 'scss',
          src: ['**/*.scss'],
          dest: '../',
          ext: '.css'
        }]
      }
    }

    // uglifying scripts
    , uglify: {
      app: {
        options: {
          beautify: true
          ,compress: false
        },
        files: {
          '../javascript/all.min.js': [
            'node_modules/tether/dist/js/tether.js',
            'node_modules/bootstrap/dist/js/bootstrap.js',
            'javascript-source/**/*.js'
          ]
        }
      }
    }

    // copying files
    , copy: {
      fontawesome: {
        expand: true,
        src: 'node_modules/font-awesome/fonts/*',
        dest: '../fonts/',
        flatten: true,
        filter: 'isFile'
      }
    }

    // defining watchers
    , watch: {
      options: {
        livereload: true
      }

      // SASS
      , sass: {
        files: ['scss/**/*.scss'],
        tasks: ['sass']
      }

      // JS
      , javascript: {
        files: ['javascript-source/**/*.js'],
        tasks: ['uglify']
      }

      // PHP
      , php: {
        files: ['../**/*.php'],
        tasks: []
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');

};
