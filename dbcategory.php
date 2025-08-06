<?php
include("connection.php"); // code to include database connection file

if(isset($_POST["btn_submit"]))
{
	
	// code to fetch data of control strat
    echo $category = $_POST["required2"];
    echo $cat_id = $_POST["cat_id"];
	//die(0);
	 //code to perform insert operation start
    if($_POST["btn_submit"] == "add")
    {
		 echo $qry="insert into shop_category(category_name)values('$category')";
        //die(0);
        $res=mysqli_query($conn,$qry);
        if(!$res)
        {
                echo "problem in insert";
        }
        else
        {
            header("location:category.php");
        }
	}
    //code to perform update operation start
      if($_POST["btn_submit"] == "update")
    {
		 echo $qry="UPDATE shop_category SET category_name='$category' WHERE category_id=$cat_id";
        //die(0);
        $res=mysqli_query($conn,$qry);
        if(!$res)
        {
                echo "problem in update";
        }
        else
        {
            header("location:category.php");
        }
	}
}
?>