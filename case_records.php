<?php 
include("core/init.php");
include("head.php"); 





?>

		



<?php include("includes/menues/reports_screenmenu.php"); ?>

			<div class="screen">
				<div class="leftcont">
                    <?php
                    if(isset($_GET['casid'])===true){
                    
                    ?>
                    <div class="pagetitle">Records of: 
                        <span class="yellowfont">
                        <?php 
                            if (isset($_GET['casid'])===true){
                                $nm=get_fullname_from_user_id($cn,$_GET['casid']);
                                echo $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'];
                            }					
                        ?>
                        </span>
                    </div>
                    <div class="monthform">
                        <fieldset class="">
								<legend>Select a month for report:</legend>
                                    <form class="inlineform" action="case_records.php" method="get">
                                        <label> </label>
                                        <select class="txtbx" name="month">
                                        <?php   
                                            if(isset($_GET['month'])===true){
                                                months_6list_options($_GET['month']);
                                            }else{
                                                $month=date('Y-m',time());
                                                months_6list_options($month);
                                            }

                                            
                                            
                                        ?>

                                        </select>
                                        <input type="hidden" name="casid" value="<?php if (isset($_GET['casid'])===true){echo $_GET['casid'];} ?>">
                                        <input type="hidden" name="reports" value="">
                                        <input type="hidden" name="case_records" value="">
                                        <input type="submit" class="buttom2" value="Report" >
                            
                                    </form> 
                        </fieldset>
                    </div>
                    <div class="reccasetables">
                        <div class="ltable">Sessions of (<?php 
                                                         if(isset($_GET['month'])===true){
                                                            echo date("F Y",strtotime($_GET['month']));
                                                         }else{
                                                            echo date("F Y", time());
                                                         }
                                                        ?>):
                            <div class="datatrh">
                                <div class="datath">S</div>
                                <div class="datath">Date</div>
                                <div class="datath">Code</div>
                                <div class="datath">Type</div>
                                <div class="datath">Price</div>
                                <div class="datath">Status</div>
                                <div class="datath">Fine</div>

                            </div>
                            
                            <?php 
                                if(isset($_GET['casid'])===true && isset($_GET['month'])===true){
                                    $cas_id= $_GET['casid'];
                                    $month=$_GET['month'];
                                    cas_month_sessions($cn,$cas_id,$month);
                                }elseif(isset($_GET['casid'])===true){
                                    $cas_id= $_GET['casid'];
                                    $month=date("Y-m",time());
                                    cas_month_sessions($cn,$cas_id,$month);
                                }                            
                            ?>


                        </div>
                        <div class="rtable">Payments of (<?php 
                                                         if(isset($_GET['month'])===true){
                                                            echo date("m-Y",strtotime($_GET['month']));
                                                         }else{
                                                            echo date("m-Y", time());
                                                         }
                                                        ?>):
                          <table>
                            <tr>
                                <th >S</th>
                                <th >Date</th>
                                <th >Amount</th>

                            </tr>
                            <?php
                            if(isset($_GET['casid'])===true && isset($_GET['month'])===true){
                                $cas_id= $_GET['casid'];
                                $month=$_GET['month'];
                               echo  cas_month_pay($cn,$cas_id,$month);
                            }elseif(isset($_GET['casid'])===true){
                                $cas_id= $_GET['casid'];
                                $month=date("Y-m",time());
                                echo cas_month_pay($cn,$cas_id,$month);
                            }
                            
                            ?>

                            <tr >
                                <th></th>
                                <th>Total:</th>
                                <th >
                                <?php
                            if(isset($_GET['casid'])===true && isset($_GET['month'])===true){
                                $cas_id= $_GET['casid'];
                                $month=$_GET['month'];
                               echo sum_cas_month_pay($cn,$cas_id,$month);
                            }elseif(isset($_GET['casid'])===true){
                                $cas_id= $_GET['casid'];
                                $month=date("Y-m",time());
                               echo sum_cas_month_pay($cn,$cas_id,$month);
                            }                                ?>
                                
                                </th>
                            </tr>
                        </table>

                        </div>
                    </div>
                        <?php
                    }
                    ?>
                        </div>

                

				<div class="rightscreen">Cases: <br>
					<div class="rightscreendata">
						<?php
                        if(isset($_GET['month'])){
                            $month=$_GET['month'];
                        }else{
                            $month=date("Y-m");
                        }
							rec_case_list($cn,$month);
						?>
					</div>
				</div>	

			</div>


		</div>
		<div class="sidebar">
            <table class="inforows">
				<?php
					include('widgets/indexwid/nocaseswid.php');
					include('widgets/indexwid/Num_lst_month_actv_cases.php');
					include('widgets/indexwid/Num_crnt_month_actv_cases.php');
					include('widgets/indexwid/num_cur_month_new_cases.php');
                    include('widgets/indexwid/Num_nxt_month_actv_cases.php');
                    include('widgets/indexwid/emptyWid.php');
                    include('widgets/indexwid/num_cur_month_services.php');
                    include('widgets/indexwid/emptyWid.php');
                    include('widgets/indexwid/num_prv_month_sessions.php');
                    include('widgets/indexwid/num_cur_month_sessions.php');
                    include('widgets/indexwid/emptyWid.php');
                    include('widgets/indexwid/num_cur_month_taken_sessions.php');
                    include('widgets/indexwid/num_cur_month_takenrebook_sessions.php');
				?>
			</table>
        </div>
	</div>
</div>












<?php include("foot.php"); ?>