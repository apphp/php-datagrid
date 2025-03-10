<?php
################################################################################
## --------------------------------------------------------------------------- #
##  ApPHP DataGrid Pro (AJAX enabled)                                          #
##  Developed by:  ApPHP <info@apphp.com>                                      # 
##  License:       GNU LGPL v.3                                                #
##  Site:          https://www.apphp.com/php-datagrid/                         #
##  Copyright:     ApPHP DataGrid (c) 2006-2017. All rights reserved.          #
##                                                                             # 
################################################################################

    // Last changed: 16.10.2011

    session_start();    

    $export_method = 'session';

    if($export_method == 'session'){
        //$dir   = 'tmp/export/';
        $dir   = (isset($_SESSION['datagrid_export_dir']) && $_SESSION['datagrid_export_dir'] != null) ? $_SESSION['datagrid_export_dir'] : '';
        $file  = (isset($_SESSION['datagrid_export_file']) && $_SESSION['datagrid_export_file'] != null) ? $_SESSION['datagrid_export_file'] : '';
        $debug = (isset($_SESSION['datagrid_debug']) && $_SESSION['datagrid_debug'] != null) ? $_SESSION['datagrid_debug'] : '';
    }else{
        //$dir   = 'tmp/export/';
        $dir   = (isset($_GET['datagrid_export_dir']) && $_GET['datagrid_export_dir'] != null) ? $_GET['datagrid_export_dir'] : '';
        $file  = (isset($_GET['datagrid_export_file']) && $_GET['datagrid_export_file'] != null) ? $_GET['datagrid_export_file'] : '';
        $debug = (isset($_GET['datagrid_debug']) && $_GET['datagrid_debug'] != null) ? $_GET['datagrid_debug'] : '';
    }    
    
    // define the appropriate path, relatively to download.php
    // 1. For example: $file_path = '../../'.$dir.$file; for following structure
    //          export/
    //          datagrid/
    //              - datagrid.class.php
    //              - scripts/
    //                -- download.php
    //
    // 2. For example: $file_path = '../../admin/'.$dir.$file; for following structure
    //          admin/
    //              - export/
    //          datagrid/
    //              - datagrid.class.php
    //              - scripts/
    //                -- download.php
    //
    // 3. For example: $file_path = '../'.$dir.$file; for following structure
    //          datagrid/
    //              - export/
    //              - datagrid.class.php
    //              - scripts/
    //                -- download.php
    //
    // 4. For example: $file_path = '../examples/'.$dir.$file; for following structure
    //          datagrid/
    //              - examples/
    //                  - export/
    //              - datagrid.class.php
    //              - scripts/
    //                -- download.php

    $file_path = '../'.$dir.$file;

    unset($_SESSION['datagrid_export_dir']);
    unset($_SESSION['datagrid_export_file']);
    unset($_SESSION['datagrid_debug']);
    
    // check for hacking attacks
    if(preg_match('/0/', $file) || preg_match('/0/', $dir) || preg_match("/%00/", $file)){
        echo 'Cannot find export file! Turn on debug mode to see more info.';
    }else if(in_array($file, array('export.xml', 'export.csv', 'export.xls', 'export.pdf', 'export.doc')) && @file_exists($file_path) && is_file($file_path)){
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
        header('Pragma: no-cache'); // HTTP/1.0
        header('Content-type: application/force-download');
        header('Content-Disposition: inline; filename="'.$file.'"'); 
        header('Content-Transfer-Encoding: binary'); 
        header('Content-length: '.filesize($file_path)); 
        header('Content-Type: application/octet-stream'); 
        header('Content-Disposition: attachment; filename="'.$file.'"'); 
        ## Special headers for IE 6
        // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        // header('Pragma: public');
        readfile($file_path);
    }else{
        if($debug){
            echo 'Cannot find such path: '.$file_path.'! Also, check please you have added session_start(); command in your code';
        }else{
            echo 'Cannot find export file! Turn on debug mode to get more info.';                                         
        }        
    }
    exit(0);

