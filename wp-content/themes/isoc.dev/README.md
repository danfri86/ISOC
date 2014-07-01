# Welcome to BOXcss
[http://alexanderhansson.se/boxcss/](http://alexanderhansson.se/boxcss/)


## Installing Grunt on your computer
Grunt and Grunt plugins are installed and managed via npm, the Node.js package manager. Read more and download Node.js at http://nodejs.org/

npm install -g grunt-cli
	    
### Install Grunt on an existing project
Change to the project's root directory with the terminal. cd path/to/BOXcss-master.
Install project dependencies with npm install.
Run Grunt with grunt.

A typical setup will involve adding two files to your project: package.json and the Gruntfile. These two are already added. All you have to do is to run the Grunt-command and grunt will create our CSS-files from the LESS-files. Runt "grunt watch" if you want grunt to watch if your files change and then compile them and/or perform other tasks.