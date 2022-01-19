<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>

<!-- <a onClick="confirm('message!')" href="index.php"  ><img src='img/icons/bin-2.png' class="icon" style=""></a> -->



<?php include("includes/menues/record_screenmenu.php"); 


if((empty($_POST)===false) && (empty($message)===true)){
			$register_data=$_POST['data'];
	
	//echo"<pre>";print_r($_POST);echo"</pre>";
	//echo"<pre>";print_r($register_data);echo"</pre>";

    $income = new Income($register_data);
    $result=$income->save();
    if($result===true){
        $message[]="Income is successfully recorded";

        $rcvd_by=$income->rcvd_by;
        $amount=$income->amount;
        $details=$income->details;
        $noteargs['submitter']=$income->submitter;
        $noteargs['submit_timestamp']=$income->submit_timestamp;
        $user = User::find_by_id($rcvd_by);
        $full_nm=$user->full_name();
        $msg="{$full_nm} has collected ($amount) L.E. income from ($details)";
        $noteargs['note']=$msg;
        $note_obj= new Note($noteargs);
        $note_submit=$note_obj->save();
        if($note_submit===true){
            mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","New income!","{$msg}");
        }

    }
}

if(isset($_GET['incomedeleted'])){
    $message[]="Income is deleted!";
}




?>
			<div class="screen">
				<form id="payform" action="incomeform.php" method="post">
				<div class="screencontainer"> 					
					<?php  echo messages($message); ?>
					<div class="leftscreen"><?php echo date("F"); ?> income:
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
									<?php
                                    $income= Income::find_all();
                                //    today_income($cn,$income);
                                    month_income($cn,$income,date("Y-m"));
                                    ?>
								</div>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Add new income</legend>
									<label>Amount (L.E.):</label><br>
                                        <input type="number" class="txtbx" name="data[amount]"required title="Enter a value in Egyptian pound"><br>
									<label>Income at:</label><br>
									<select class="txtbx" name="data[month]" required>
                                        <option value="<?php echo date("Y-m",strtotime("first day of this month")); ?>"selected><?php echo date("F Y",strtotime("first day of this month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of +1 month")); ?>" ><?php echo date("F Y",strtotime("first day of +1 month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of +2  month")); ?>" ><?php echo date("F Y",strtotime("first day of +2  month"));?></option>
									</select><br>
                                    <label> Income from:</label><br>
									<textarea class="txtbx" name="data[details]" required></textarea>
                                    <label> Received by:</label><br>
									<select class="txtbx" name="data[rcvd_by]" required>
                                        <?php
                                            users_list_opt($cn,1);
                                        ?>
                                    </select>
                                    <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
                                    <input type="submit" class="buttom1" value="Add income" >
								</fieldset>
							</div>
							<?php
 
                            ?>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen"> <br>
					<div class="rightscreendata">
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">
			<table class="inforows">
				<?php
					include('widgets/indexwid/month_incomes.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>