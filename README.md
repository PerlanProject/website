# Perlan (Data) Website

This repository contains the WordPress site (all files and a text file backup of the database)
for the Perlan Project's data website. As of this writing, the website is hosted at at https://perlanproject.cloud, though this may change later.

## Top-level Directories
- data: a symlink to ../data, so that that dir can use Git LFS in its own repo
- doc: details about how the site works, how it was created, and how to change things yourself.
- wordpress: the root of the WordPress web site
	- wp-content/plugins/perlan: the Perlan plugin, which works with the Theme
	- wp-content/themes/perlan: the Perlan child theme of Illustratr
- pods_templates: file backup of the PODS templates (in the database) used to display single posts.
- wrangling: JupyterLab notebooks and Python to prep data from other locations, e.g., SVN and the old data web location

## Top-level Files
I chose to put the scripts to make database backups and sync between local and cloud at the top level because they (should) get used frequently.
- wp-mysqldump.cloud: shell script to make a text file backup of the database as it is on the cloud server
- wp-mysqldump.local: shell script to make a text file backup of the database as it is on the local server
- wp-rsync.local: shell script to synchronize files between this directory and its clone on the cloud server

