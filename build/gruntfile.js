module.exports = function (grunt) {   
    require('jit-grunt')(grunt);
    
    var extFolder = 'ext/';
    var srcFolder = 'src/';
    var cssFolder = srcFolder + 'css/';
    var jsFolder = srcFolder + 'js/';
    var lessFolder = srcFolder + 'less/';
    var tsFolder = srcFolder + 'ts/';
    var bowerFolder = 'bower_components/';
    
    grunt.file.setBase('..');
 
    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-git');
    grunt.loadNpmTasks('grunt-typescript');
    
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        copy: {
            bootstrap: {
                expand: true, 
                cwd: bowerFolder + 'bootstrap/dist',
                src: '**/*',
                dest: srcFolder
            },
            jquery: {
                expand: true, 
                cwd: bowerFolder + 'jquery/dist',
                src: '**/*',
                dest: jsFolder
            }
        },
        
        gitclone: {
            definitelytyped: {
                options: {
                    repository: 'https://github.com/borisyankov/DefinitelyTyped.git',
                    directory: extFolder + 'definitelytyped'
                }
            }
        },
        
        bower: {
            install: {
            }
        },
        
        typescript: {
            source: {
                src: tsFolder + '**/*.ts',
                dest: jsFolder,
                options: {
                    declaration: false,
                }
            }   
        },
       
        less: {
            development: {
                options: {
                    compress: false,
                    yuicompress: false,
                    optimization: 2
                },
                files: {
                    'src/css/gallant.css': lessFolder + '/gallant.less'
                }
            }
        },
        
        watch: {
            styles: {
                files: [
                    lessFolder + '**/*.less',
                    tsFolder + '**/*.ts'
                ],
                tasks: ['default'],
                options: {
                    nospawn: true
                }
            }
        }
    });
    
    grunt.registerTask('init', [
        'gitclone:definitelytyped', 
        'bower', 
        'copy:bootstrap', 
        'copy:jquery',
        'default']);
        
    grunt.registerTask('default', [
        'less', 
        'typescript']);
}    