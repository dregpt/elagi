<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>

<!-- <a onClick="confirm('message!')" href="index.php"  ><img src='img/icons/bin-2.png' class="icon" style=""></a> -->

<?php include("includes/menues/admin_screenmenu.php");

if(isset($_GET['usr_id'])){
    $usr_id=$_GET['usr_id']?? false;
}elseif(isset($_POST['data'])){
    $register_data = $_POST['data'];
    $usr_id=$register_data['usr_id'];
}

if(!empty($usr_id)) {
    $sal_set = Salset::find_by_id($usr_id);
if((empty($_POST)===false) && (empty($message)===true)){
			$register_data=$_POST['data'];
//			$array1=array_splice($register_data,5);
//    echo"<pre>";print_r($register_data);echo"</pre>";
    foreach ($register_data as $key => $value){
        if(strstr($key,'percent')){
            $testarray1[$key]=$value;
        }
        if(strstr($key,'services')){
            $testarray3[$key]=$value;
        }

        if(!strstr($key,'percent')){
            if(!strstr($key,'services')) {
                $testarray2[$key]=$value;
            }
        }
    }

if(isset($testarray1 )==true){
    foreach ($testarray1 as $key => $value) {
        $jointval[] = substr($key, 0, 2) . $value;
    }
    $srv_percent['srv_percent'] = join(",", $jointval);
}else{$srv_percent['srv_percent']=0;}
if(isset($testarray3 )==true) {
    foreach ($testarray3 as $key => $value) {
        $jointval1[] = substr($key, 0, 2);

    }
    $taken_services['taken_services'] = join(",", $jointval1);
}else{$taken_services['taken_services']=0;}
    $register_data=array_merge($testarray2, $srv_percent,$taken_services);


// echo"<pre>";print_r($register_data);echo"</pre>";

    $sal_set->merge_attributes($register_data);
    $result = $sal_set->save();


//echo $user->phon1_is_found();
    $message=$sal_set->errors;
    if ($result === true) {
        header("location:salset.php?admin&salset&salupdated&usr_id=".$register_data['usr_id']);
    }

}

if(isset($_GET['salupdated'])){
    $user=User::find_by_id($_GET['usr_id']);
    $fullname=$user->full_name();
    $message[] = "Salary setting for (" . $fullname . ") is updated!";
}




?>
			<div class="screen">
				<form id="payform" action="salset.php" method="post">
				<div class="screencontainer"> 					
					<?php  echo messages($message); ?><br>

                            <?php


                            ?>
                    <div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
                                <fieldset>
                                Set salary for: &#160

                                <span class="yellowfont">
                                    <?php
                                    if(isset($_GET['usr_id'])) {
                                        $user = User::find_by_id($_GET['usr_id']);
                                        echo $user->full_name();
                                    }

                                    ?>
                                </span>
                                <br>
                                    <label>Fixed sallary:</label><br>
                                    <input type="number"  class="txtbx" name="data[sal]" step=1 value="<?php echo $sal_set->sal; ?>"><br>
                                    <label>Regularity bonus percent %: </label><br>
                                    <input type="number" class="txtbx" placeholder="5" name="data[reg_bonus]" value="<?php echo $sal_set->reg_bonus; ?>"><br>
                                    <label>Add bonus in L.E: </label><br>
                                    <input type="number" class="txtbx" name="data[bonus]" value="<?php echo $sal_set->bonus; ?>"><br>
                                    <label>Deduction in L.E: </label><br>
                                    <input type="number" class="txtbx" name="data[deduction]" value="<?php echo $sal_set->deduction; ?>"><br>
                                    <label>Percentage from total revenue %: </label><br>
                                    <input type="number" class="txtbx" name="data[perc_revnue]" value="<?php echo $sal_set->perc_revnue; ?>"><br>
                                </fieldset>
                                <fieldset>
                                    <legend></legend>
                                    <label> Rate category (per worked hour/session):</label><br>

                                        <dive class="tentcols">
                                            <?php
                                            $srv_percent=$sal_set->srv_percent;
                                            if($srv_percent==='0'){
                                                $srv_percent_array[0]=1;
                                            }else{
                                                $string = $sal_set->srv_percent;
                                                $array22 = explode(",", $string);
                                                foreach ($array22 as $key => $value) {
                                                    $srv_percent_array[substr($value, 0, 2)] = substr($value, 2);
                                                }
                                            }
                                            rate_servs($cn,$srv_percent_array);
                                            ?>
                                        </dive>

                                    <label> Rate by:</label><br><input type="hidden" name="rat_by" value="0">
                                    <div class="radiogroup">
                                    <input type="radio" name="data[rat_by]" class="txtbx" value="0" <?php if($sal_set->rat_by==0){echo " checked";}  ?>>Hour
                                    <input type="radio" name="data[rat_by]" class="txtbx" value="1" <?php if($sal_set->rat_by==1){echo " checked";}  ?>>Session
                                    </div>
                                </fieldset>
							</div>
							<div class="formcolumn">
                                <fieldset>
                                    <label title="Percentage from every taken sessions cost">Taken sessions cost percentage  %: </label><br>
                                    <input type="number" class="txtbx" title="Percentage from every taken sessions cost" name="data[taken_cost]" value="<?php echo $sal_set->taken_cost; ?>"><br>
                                    <label title="Percentage from every taken sessions revenue">Taken sessions revenue percentage %: </label><br>
                                    <input type="number" class="txtbx" title="Percentage from every taken sessions revenue" name="data[taken_perc]" value="<?php echo $sal_set->taken_perc; ?>"><br>
                                    <label>Bonus for every taken sessions in L.E: </label><br>
                                    <input type="number" class="txtbx" name="data[taken_bonus]" value="<?php echo $sal_set->taken_bonus; ?>"><br>
                                    <div class="chkbxsrvcont">
                                        <?php
                                        $string= $sal_set->taken_services;
                                        $array33=explode(",",$string);
                                        checkbx_servs($cn,$array33);
                                        ?>
                                    </div>
                                </fieldset>                                <input type="hidden" value="<?php
                                if(isset($_GET['usr_id'])){
                                    echo $_GET['usr_id'];
                                }
                                ?>" name="data[usr_id]">
                                <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
                                <input type="submit" class="buttom1" value="Save" >

                            </div>
						</div>
					</div>

				</div>
				</form>
                <?php
                }
                ?>
                 <div class="rightscreen"> <br>
					<div class="rightscreendata">
                        <?php
                        get_all_workers_names_sal($cn);
                        ?>
					</div>
				</div>
		</div>
		</div>
		<div class="sidebar">
			<table class="inforows">
				<?php
//					include('widgets/indexwid/month_incomes.php');
				?>
			</table>
		</div>
    </div>

    </div>












<?php





include("foot.php"); ?>