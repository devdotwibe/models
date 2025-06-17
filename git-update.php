<?php

$out = shell_exec("git --version 2>&1");
print_r($out);


$logFile = "gitlog/git-update-" . date("d-M-Y") . ".log";


if (!file_exists('gitlog')) {
    mkdir('gitlog', 0755, true);
}

$out = shell_exec("git pull 2>&1 | tee -a $logFile");
print_r($out);


if (strpos($out, 'bad index file sha1 signature') !== false) {
   
    shell_exec("rm -f .git/index");


    $resetOutput = shell_exec("git reset 2>&1");
    print_r($resetOutput);

    shell_exec("git checkout -- .");

    $out = shell_exec("git pull 2>&1 | tee -a $logFile");
  
    print_r($out);
} elseif (strpos($out, 'Your configuration specifies to merge with the ref') !== false) {
 
    echo "Error: No such branch found in the remote repository.\n";
}
?>