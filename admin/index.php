<?php
include "../model/pdo.php";
include "../model/binhluan.php";
include "../model/danhmuc.php";
include "../model/sanpham.php";
include "../model/taikhoan.php";
include "header.php";

if(isset($_GET['act'])){
    $act =$_GET['act'];
    switch($act){
//danh muc
 case 'adddm':
    if(isset($_POST['themmoi'])&&($_POST['themmoi'])){
        $tenloai=$_POST['tenloai'];
        insert_danhmuc($tenloai);
        $thongbao="them thanh cong";
    }
    
    include "danhmuc/add.php";
    break;
    
    case 'listdm':
      $listdanhmuc=loadall_danhmuc();
      include "danhmuc/list.php";
      break;


       case 'xoadm':
        if(isset($_GET['id']) &&($_GET['id']>0 )){
            delete_danhmuc($_GET['id']);
        }
        $listdanhmuc = loadall_danhmuc();
        include "danhmuc/list.php";
        break;
     
        case 'suadm':
            if(isset($_GET['id']) &&($_GET['id']>0)){
                $dm =loadone_danhmuc($_GET['id']);
            }
            include "danhmuc/update.php";
            break;

            case 'updatedm':
                if(isset($_POST['capnhat']) &&($_POST['capnhat'])){
                    $tenloai =$_POST['tenloai'];
                    $id=$_POST['id'];
                    update_danhmuc($id,$tenloai);  
                    $thongbao="cap nhat thanh cong"; 
                }
                $listdanhmuc = loadall_danhmuc();
                include "danhmuc/list.php";
            break;
    }
}
else{
    include "home.php";
    
}
include "footer.php";

?>