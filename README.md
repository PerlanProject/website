# Perlan Data Website (and Utilities)

This repository contains the WordPress site (all files and a text file backup of the database)
for the Perlan Project's data website. As of this writing, the website is hosted at at https://perlanproject.cloud, though this may change later.

At the root are utilities for synchronizing between the cloud copy and your local dev environment.

- data: a symlink to ../data, so that that dir can use Git LFS in its own repo
- data_convert: JupyterLab notebooks and Python to prep data from other locations, e.g., SVN and the old data web location
- wordpress: the root of the WordPress web site
- wp-content/plugins/perlan: the Perlan plugin, which works with the Theme
- wp-content/themes/perlan: the Perlan child theme of Illustratr
- pods_templates: file backup of the PODS templates (in the database) used to display single posts.
- wp-mysqldump.cloud: shell script to make a text file backup of the database as it is on the cloud server
- wp-mysqldump.local: shell script to make a text file backup of the database as it is on the local server
- wp-rsync.local: shell script to synchronize files between this directory and its clone on the cloud server

# Plugins

- PODS
- Post Tables Pro
- Perlan
- wp-plotly
- plotwp
- debug-bar
- debug-this
- duplicator
- query-monitor
- wp-downgrade
- github-updater: auto installs & updates plugins & themes from Github

## Plugin Versions

As of this writing, plugin versions are as follows:

  ```sh
  $ brew install wp-cli
  $ wp plugin list
  +-----------------+----------+------------------------------+-----------+
  | name            | status   | update                       | version   |
  +-----------------+----------+------------------------------+-----------+
  | akismet         | inactive | none                         | 4.1.8     |
  | debug-bar       | active   | none                         | 1.1.2     |
  | debug-this      | active   | none                         | 0.6.3     |
  | duplicator      | active   | none                         | 1.3.40.1  |
  | github-updater  | active   | none                         | 9.9.8     |
  | perlan          | active   | none                         | 1.0.0     |
  | plotwp          | active   | none                         | 0.4       |
  | wp-plotly       | active   | none                         | 1.0.2     |
  | pods            | active   | version higher than expected | 2.8.0-b-1 |
  | posts-table-pro | active   | none                         | 2.3.2     |
  | query-monitor   | active   | none                         | 3.6.7     |
  | wp-downgrade    | active   | none                         | 1.2.2     |
  | db.php          | dropin   | none                         |           |
  +-----------------+----------+------------------------------+-----------+
  ```

