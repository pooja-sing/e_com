<?php
include("connection_inc.php");
if(isset($_POST["add-categories"])){
    $cate_id = mt_rand(11111,99999);
    $name = $_POST['name'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $meta_title = $_POST['meta_title'];
    $status = $_POST['status'];
    $added_on = date('Y-m-d H:i:s');
    $slug_url=slugUrl($name);
 
    $query = "INSERT INTO  categories(cate_id,name,meta_desc,meta_key,meta_title,slug_url,status,added_on) VALUES ('$cate_id','$name', '$meta_desc','$meta_key','$meta_title','$slug_url','1','$added_on')";
    $check=mysqli_query($conn, $query);
    if($check) {
        ?>
        <script type="text/javascript">alert('data inserted sucessfully');
            window.location.href='view_categories.php';
        </script>


        <?php
    }
}

if(isset($_POST["add-sub-categories"])){
    $cate_id = mt_rand(11111,99999);
    $name = $_POST['name'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $meta_title = $_POST['meta_title'];
    $status = $_POST['status'];
    $added_on = date('Y-m-d H:i:s');
    $parent_id=$_POST['parent_id'];
    $slug_url=slugUrl($name);
 
    $parent_id=$_POST['parent_id'];
    $parent_id=$_POST['parent_id'];
    $query = "INSERT INTO  sub_categories(cate_id,parent_id,name,meta_desc,meta_key,meta_title,slug_url,status,added_on) VALUES ('$cate_id','$parent_id','$name', '$meta_desc','$meta_key','$meta_title','$slug_url','1','$added_on')";
    $check=mysqli_query($conn, $query);
    if($check) {
        ?>
        <script type="text/javascript">alert('data inserted sucessfully');
            window.location.href='view-sub-categories.php';
        </script>


        <?php
    }
}

function get_Categories($conn) {
    include("connection_inc.php");
    $query = "SELECT * FROM categories ORDER BY id DESC";
    $check = mysqli_query($conn, $query);
    
    $sno=1;
    while ($result = mysqli_fetch_assoc($check)) {
       echo $output = "<tr>
                        <td>".$sno++."</td>;
                        <td>".$result['cate_id']."</td>;
                        <td>".$result['name']."</td>;
                        <td>".$result['slug_url']."</td>;
                        <td>".$result['status']."</td>;
                        <td>".$result['added_on']."</td>;

                        
                    </tr>";
    }
    
}


function get_Sub_Categories($conn) {
    $query = "SELECT * FROM sub_categories ORDER BY id DESC";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $sno = 1;
    while ($result = mysqli_fetch_assoc($check)) {
        $parent_id = $result["parent_id"];
        $query1 = "SELECT name FROM categories WHERE cate_id=$parent_id";
        $check1 = mysqli_query($conn, $query1);

        if (!$check1) {
            die("Query Failed: " . mysqli_error($conn));
        }

        $parent = mysqli_fetch_assoc($check1);

        echo "<tr>
                <td>".$sno++."</td>
                <td>".$result['cate_id']."</td>
                <td>".$result['name']."</td>
                <td>".$parent['name']."</td>
                <td>".$result['slug_url']."</td>
                <td>".$result['status']."</td>
                <td>".$result['added_on']."</td>
              </tr>";
    }
}


    function slugUrl($string){
          
        $slug = preg_replace('/[^a-zA-Z0-9\s-]/', '',  $string);
        $slug = str_replace(' ','-',$slug);
        $slug = strtolower($slug);
        return $slug;
    }
   


    if(isset($_POST["add-products"])){
        $pro_id=mt_rand(1111,9999);
        $pro_name = $_POST['pro_name'];
        $pro_cate = $_POST['pro_cate'];
        $pro_cate_sub = $_POST['pro_cate_sub'];
        $pro_desc = $_POST['pro_desc'];
        $stock = $_POST['stock'];
        $mrp = $_POST['mrp'];
        $selling_price = $_POST['selling_price'];

        $filename=$_FILES['pro_image']['name'];
        $tempfile=$_FILES['pro_image']['temp_name'];
        $destination='img/uploade/'.$filename;
        move_uploaded_file($tempfile,$destination);

    
        
        $meta_title = $_POST['meta_title'];
        $meta_desc = $_POST['meta_desc'];
        $meta_key = $_POST['meta_key'];
        $status = $_POST['status'];
        $added_on= date('Y-m-d H:i:s');
     
        $query = "INSERT INTO  products(pro_id,pro_name,pro_cate,pro_cate_sub,pro_desc,stock,mrp,selling_price,pro_image,meta_title,meta_desc,meta_key,status,added_on) VALUES'
         ('$pro_name','$pro_cate',' $pro_cate_sub','$pro_desc','$stock',' $mrp',' $filename',' $selling_price','$meta_title',' $meta_desc','$meta_key','$status','$added_on')";
        $check=mysqli_query($conn, $query);
        if($check) {
            ?>
            <script type="text/javascript">alert('data inserted sucessfully');
                window.location.href='view_products.php';
            </script>
    
    
            <?php
        }
    }

?>