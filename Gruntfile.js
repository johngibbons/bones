/*global module:false*/
module.exports = function(grunt) {

  require('time-grunt')(grunt);

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      dist: {
        src: ['library/**/*.js'],
        dest: 'dist/<%= pkg.name %>.js'
      }
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      dist: {
        src: '<%= concat.dist.dest %>',
        dest: 'dist/<%= pkg.name %>.min.js'
      }
    },
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        browser: true,
        globals: {
          jQuery: true
        },
        force: true,
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      files: {
        src: ['library/js/scripts.js']
      }
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['newer:jshint:gruntfile']
      },
      lib_test: {
        files: '<%= jshint.lib_test.src %>',
        tasks: ['newer:jshint:lib_test', 'qunit']
      },
      css: {
        files: 'library/**/*.scss',
        tasks: ['newer:compass']
      },
      livereload: {
        files: ['library/css/*.css'],
        options: { livereload: true }
      }
    },
      compass: {                  // Task
        dist: {                   // Target
          options: {              // Target options
            sassDir: 'library/scss',
            cssDir: 'library/css',
            imagesDir: 'library/images',
            javascriptsDir: 'library/js'
          }
        }
      },
      imagemin: {                          // Task
        static: {                          // Target
          options: {                       // Target options
            optimizationLevel: 3,
            svgoPlugins: [{ removeViewBox: false }],
          }
        },
        dynamic: {                         // Another target
          files: [{
            expand: true,                  // Enable dynamic expansion
            cwd: 'library/images',                   // Src matches are relative to this path
            src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
            dest: 'dist/'                  // Destination path prefix
          }]
        }
      }
  });

  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt);

  // Default task.
  grunt.registerTask('default', ['jshint', 'newer:concat', 'newer:uglify', 'newer:compass', 'newer:imagemin']);

};
