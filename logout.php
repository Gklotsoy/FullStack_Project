<?php

require ('./functions/databaseFunctions.php');
require ('./functions/genericFunctions.php');
require ('./functions/userFunctions.php');

startSession();

logUserOut();
redirectTo('./index.php');