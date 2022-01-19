<?php
include("core/init.php");
include("head.php"); 

?>

		



<?php include("includes/menues/ther_screenmenu.php");?>

			<div class="screen">
				<div class="leftscreen">Sessions of:
                    <span class="yellowfont">
                        <?php
                        if (isset($_GET['usr_id'])===true){
                            $nm=get_fullname_from_user_id($cn,$_GET['usr_id']);
                            echo $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'];
                        }
                        ?>
                        </span>
                    <br>
                    <?php
                    if( isset($_GET['usr_id'])){
                    ?>

                    <div class="monthform">
                        <fieldset class="">
                            <legend>Select a month to report:</legend>
                            <form class="inlineform" action="ther_sessions.php" method="get">
                                <input type="hidden" name="thrpedit"><input type="hidden" name="ther_sessions">
                                <label> </label>
                                <select class="txtbx" name="month">
                                    <?php
                                    if(isset($_GET['month'])===true){
                                        $month=$_GET['month'];
                                        months_6list_options($month);
                                    }else{
                                        $month=date('Y-m',time());
                                        months_6list_options($month);
                                    }
                                    if(isset($_GET['usr_id'])){

                                         echo"<input type='hidden' name='usr_id' value='{$_GET['usr_id']}'>" ;
                                    }
                                    ?>
                                </select>
                                <input type="submit" class="buttom2" value="Report" >
                            </form>
                        </fieldset>
                    </div>
                    <div class="thrpcont">
                        <div class="ltcont">
                            <div class="sescont"> Worked sessions:
                                <table>
                                    <tr>
                                        <th>S</th>
                                        <th>Session date</th>
                                        <th>Case</th>
                                        <th>Type</th>
                                        <th>Duration</th>
                                    </tr>
                                        <?php
                                        month_thrp_worked_ses_data($cn,$_GET['usr_id'],$_GET['month']);
                                        ?>

                                </table>
                            </div>

                            <div class="exccont"> In-between excuses or absences:
                                <table>
                                    <tr>
                                        <th>S</th>
                                        <th>Session date</th>
                                        <th>Case</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php
                                    month_thrp_inbtwn_excs_data($cn,$_GET['usr_id'],$_GET['month']);
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="rtcont"> Work data:
                            <table class="datatable">

                                <?php
                                if(isset($_GET['month'])===true){
                                    $month=$_GET['month'];
                                }else{
                                    $month=date('Y-m',time());
                                }

                                thrp_ses_type_data_number($cn,$_GET['usr_id'],$month);
                                ?>
                                <tr>
                                    <th class="sideh">All sessions</th>
                                    <td class="data"><?php
                                        echo thrp_worked_ses_number($cn, $_GET['usr_id'], $month) ;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sideh">Hours</td>
                                    <td class="data"><?php echo thrp_worked_hours($cn, $_GET['usr_id'], $month) ; ?></td>
                                </tr>
                                <tr>
                                    <th class="sideh">In-between hours</td>
                                    <td class="data"><?php echo thrp_inbtwn_hours($cn, $_GET['usr_id'], $month) ; ?></td>
                                </tr>
                                <tr>
                                    <th class="sideh">Total hours</td>
                                    <td class="data"><?php echo thrp_hours($cn, $_GET['usr_id'], $month) ; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php } ?>
                </div>
				<div class="rightscreen">Choose therapist: <br>
                    <div class="rightscreendata">
                        <?php
                        if(isset($_GET['month'])===true){
                            $month=$_GET['month'];
                        }else{
                            $month=date('Y-m',time());
                        }
                        month_therapists_list($cn,$month);

                        ?>
                    </div>
                </div>
			</div>
		</div>
		<div class="sidebar">sidebar</div>
	</div>
</div>









<?php include("foot.php"); ?>