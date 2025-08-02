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
            //sp
          
            case 'addsp':
                // Kiểm tra xem người dùng có click vào nút add hay không
                if(isset($_POST['themmoi'])&&($_POST['themmoi'])){
                    $iddm=$_POST['iddm'];
                    $tensp=$_POST['tensp'];
                    $giasp=$_POST['giasp'];
                    $mota=$_POST['mota'];
                    $hinh=$_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir .basename($_FILES["hinh"]["name"]);
                    if(move_uploaded_file($_FILES["hinh"]["tmp_name"],$target_file)){
                         //quá là ok
                    }else{
                        // lỗi r
                    }

                    insert_sanpham($tensp,$giasp,$hinh,$mota,$iddm);
                    $thongbao="Thêm thành công";
                    
                }
                $listdanhmuc = loadall_danhmuc();
                include "./sanpham/add.php";
                break;
            
            case 'listsp':
                if(isset($_POST['listok'])&&($_POST['listok'])){
                    $kyw = $_POST['kyw'];
                    $iddm = $_POST['iddm'];
                }else{
                    $kyw = '';
                    $iddm = 0;
                }
                $listdanhmuc = loadall_danhmuc();
                $listsanpham = loadall_sanpham($kyw,$iddm);
                include "sanpham/list.php";
                break;

            case 'xoasp':
                if(isset($_GET['id']) && ($_GET['id'] >0)){
                    delete_sanpham($_GET['id']);
                }
                $listsanpham = loadall_sanpham("",0);
                include "sanpham/list.php";
                break;

                   case 'updatesp':
                // Kiểm tra xem người dùng có click vào nút add hay không
                if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                    $id=$_POST['id'];
                    $iddm=$_POST['iddm'];
                    $tensp=$_POST['tensp'];
                    $giasp=$_POST['giasp'];
                    $mota=$_POST['mota'];
                    $hinh=$_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir .basename($_FILES["hinh"]["name"]);
                    if(move_uploaded_file($_FILES["hinh"]["tmp_name"],$target_file)){
                         //quá là ok
                    }else{
                        // lỗi r
                    }
                    update_sanpham($id,$iddm,$tensp,$giasp,$mota,$hinh);
                    $thongbao="Cập nhật thành công thành công";
                    
                }
                $listdanhmuc = loadall_danhmuc();
                $listsanpham = loadall_sanpham("",0);
                include "sanpham/list.php";
                break;
    }
}
else{
    include "home.php";
    
}
include "footer.php";

?>