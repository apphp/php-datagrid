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

    // Last changed: 26.01.2012

    session_start();    
    
    $post_type = 'session';
        
    if($post_type == 'session'){
        $file_content = isset($_SESSION['datagrid_df_content']) ? $_SESSION['datagrid_df_content'] : '';        
        $file_type    = isset($_SESSION['datagrid_df_blob_type']) ? $_SESSION['datagrid_df_blob_type'] : '';        
        $file_name    = isset($_SESSION['datagrid_df_blob_name']) ? $_SESSION['datagrid_df_blob_name'] : '';
        $file_size    = isset($_SESSION['datagrid_df_blob_size']) ? $_SESSION['datagrid_df_blob_size'] : '';
        $fn           = isset($_GET['fn']) ? $_GET['fn'] : '';
    }else{
        $frid = isset($_GET['frid']) ? $_GET['frid'] : '';
        
        //add database connection parameters here...
        //...
        //$sql = 'SELECT bin_data, filetype, filename, filesize FROM tbl_Files WHERE id_files='.$file_name;
        //  
        //$result = @mysqli_query($link, $sql);
		//$row = @mysqli_fetch_array($result, MYSQLI_NUM);
        //$file_content = $row['bin_data'];
        //$file_name = $row['filename'];
        //$file_size = $row['filesize'];
        //$file_type = $row['filetype'];
    }

    if($file_name == '' || $file_size == 0 || $file_type == '' || $file_content == ''){
        echo 'Wrong parameters passed. Please refresh the page and try to download file again. <a href="javascript:history.go(-1);">Back</a>';
        exit;
    }else if($file_name != $fn){
        echo 'Wrong parameters passed. Please refresh the page and try to download file again.';
        exit;        
    }
    
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
    header('Pragma: no-cache'); // HTTP/1.0

    header('Content-type: '.$file_type);
    header('Content-length: '.$file_size);
    header('Content-Disposition: attachment; filename='.$file_name);
    header('Content-Description: PHP Generated Data');
    echo $file_content;
        
    unset($_SESSION['datagrid_df_content']);
    unset($_SESSION['datagrid_df_blob_type']);
    unset($_SESSION['datagrid_df_blob_name']);
    unset($_SESSION['datagrid_df_blob_size']);
    exit;
