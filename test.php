
	<div class="container">
		
		<div class="mainscreen">
		
			<div class="screenmenu">
			
			</div>
			<div class="screen">				
				<div class="leftscreen">Left screen
				
				<?php // test some code:
					echo"<br>";
					echo strtotime('2021-04-30');
					//echo date('Y - m', mktime('2021 - 04 - 30'));
					echo"<br>";
					echo"<br>";
					echo lst_day_of_next_month();
					echo"<br>";
					case_ses_is_set($cn, 121);
					echo $nxtmn=next_month(); echo"n<br>";
					echo strtotime($nxtmn); echo"<br>";
					echo date("Y - M",strtotime($nxtmn)); echo"<br><br>";
					
					
					echo "<pre> Saturday "; 
						print_r(get_nxt_mnth_days_ary("Sat")); 
					echo "<pre> No. of Saturdays: ".count(get_nxt_mnth_days_ary("Sat"));
					
					
					echo "<pre> Sunday "; print_r(get_nxt_mnth_days_ary("Sun")); echo "<pre>No. of Sunday: ".count(get_nxt_mnth_days_ary("Sun"));
					echo "<pre> Monday "; print_r(get_nxt_mnth_days_ary("Mon")); echo "<pre>No. of Monday: ".count(get_nxt_mnth_days_ary("Mon"));
					echo "<pre> Tuesday "; print_r(get_nxt_mnth_days_ary("Tue")); echo "<pre> No. of Tuesdays: ".count(get_nxt_mnth_days_ary("Tue"));
					echo "<pre> Wednesday "; print_r(get_nxt_mnth_days_ary("Wed")); echo "<pre>No. of Wednesdays: ".count(get_nxt_mnth_days_ary("Wed"));
					echo "<pre> Thursday "; print_r(get_nxt_mnth_days_ary("Thu")); echo "<pre>No. of Thursdays: ".count(get_nxt_mnth_days_ary("Thu"));
					echo "<pre> Friday "; print_r(get_nxt_mnth_days_ary("Fri")); echo "<pre>No. of Fridays: ".count(get_nxt_mnth_days_ary("Fri")); echo"<br><br>";
				
				$sat= count(get_nxt_mnth_days_ary("Sat"));
				$mon= count(get_nxt_mnth_days_ary("Mon"));
				$Wed= count(get_nxt_mnth_days_ary("Wed"));
					
					echo $date = date ('d l - n / Y h:i A',strtotime('first Saturday of next month 9 am')); echo"<br>";
 
				
				
				?>
					
					
					
				</div>
				<div class="rightscreen">Right screen</div>
			</div>
		</div>
		<div class="sidebar">
			<table>
				
				<?php
				
					include('widgets/indexwid/usernamewid.php');
					include('widgets/indexwid/rulenamewid.php');
				
				?>

			</table>
		</div>
	</div>
</div>


						




