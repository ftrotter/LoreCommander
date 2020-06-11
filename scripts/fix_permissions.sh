#!/bin/bash

# change the group owner of the all the things to 'careset'
chgrp careset * -R
# change the ownership of the storage directory to be writeable by apache
#chgrp www-data storage -R
#better is to ensure that www-data is a member of the careset user group..
usermod -a -G careset www-data

# ensure that members of the careset group can read, and write to the files. Ensure that new files have the same permission with the sticky bit
chmod g+rw * -R
# add the +s permission, but only to the directories..
find ./ -type d | xargs chmod g+s
