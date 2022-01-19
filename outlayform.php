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

    $outlay = new Outlay($register_data);
    $result=$outlay->save();
    if($result===true){
        $message[]="Outlay is successfully recorded";

        $expndd_by=$outlay->expndd_by;
        $amount=$outlay->amount;
        $details=$outlay->details;
        $noteargs['submitter']=$outlay->submitter;
        $noteargs['submit_timestamp']=$outlay->submit_timestamp;
        $user = User::find_by_id($expndd_by);
        $full_nm=$user->full_name();
        $msg="{$full_nm} has spent ($amount) L.E. for($details)";
        $noteargs['note']=$msg;
        $note_obj= new Note($noteargs);
        $note_submit=$note_obj->save();
        if($note_submit===true){
            mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","New expenditure!","{$msg}");
        }

    }
}

if(isset($_GET['outlaydeleted'])){
    $message[]="Outlay is deleted!";
}




?>
			<div class="screen">
				<form id="payform" action="outlayform.php" method="post">
				<div class="screencontainer"> 					
					<?php  echo messages($message); ?>
					<div class="leftscreen">Today expenses:
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
									<?php
                                    $outlays= Outlay::find_all();
                                        today_expenses($cn,$outlays);
                                    ?>
								</div>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Add new expense</legend>
									<label>Amount (L.E.):</label><br>
                                        <input type="number" class="txtbx" name="data[amount]"required title="Enter a value in Egyptian pound"><br>
									<label>Expended in:</label><br>
									<select class="txtbx" name="data[month]" required>
                                        <option value="<?php echo date("Y-m",strtotime("first day of this month")); ?>"selected><?php echo date("F Y",strtotime("first day of this month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of +1 month")); ?>" ><?php echo date("F Y",strtotime("first day of +1 month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of +2  month")); ?>" ><?php echo date("F Y",strtotime("first day of +2  month"));?></option>
									</select><br>
                                    <label> Details:</label><br>
									<textarea class="txtbx" name="data[details]" required></textarea>
                                    <label> Expended by:</label><br>
									<select class="txtbx" name="data[expndd_by]" required>
                                        <?php
                                            users_list_opt($cn,1);
                                        ?>
                                    </select>
                                    <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
                                    <input type="submit" class="buttom1" value="Add outlay" >
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
					include('widgets/indexwid/month_outlays.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>