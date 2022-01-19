<fieldset>
    <legend></legend>
    <label> Name:</label><br>
    <input type="text" class="txtbx" name="data[trig_nm]" required maxlength="200" value="<?php if(isset($trigger)){echo $trigger->trig_nm;} ?>"><br>
    <label> Details:</label><br>
    <textarea class="txtarea" name="data[detail]" requilred><?php if(isset($trigger)){echo strip_tags(trim($trigger->detail));} ?> </textarea><br>
    <div class="startendgrid">
        <label> Bonus:</label><label> Penalty:</label>
        <input type="number" class="txtbx" name="data[bonus]" required value="<?php if(isset($trigger)){echo $trigger->bonus;} ?>">
        <input type="number" class="txtbx" name="data[penalty]"  required value="<?php if(isset($trigger)){echo $trigger->penalty;} ?>">
    </div>
    <input type="radio" name="data[trig_act]" class="txtbx" value="0" <?php if(isset($trigger) && $trigger->trig_act==0){echo " checked";}  ?> required>Percent from basic salary
    <input type="radio" name="data[trig_act]" class="txtbx" value="1" <?php if(isset($trigger) && $trigger->trig_act==1){echo " checked";}  ?> required>Actual value in L.E.
    <div class="startendgrid">
        <label> Minimum threshold:</label><label> Maximum threshold:</label>
        <input type="text" class="txtbx" name="data[thr_min]"  required value="<?php if(isset($trigger)){echo $trigger->thr_min;} ?>">
        <input type="text" class="txtbx" name="data[thr_max]"  required value="<?php if(isset($trigger)){echo $trigger->thr_max;} ?>">
    </div>
        <label> Trigger reset every:</label>
        <select class="txtbx" name="data[trig_reset]"  required >
            <option disabled selected value value=""> -- -- </option>
            <option value="day" <?php if(isset($trigger) && $trigger->trig_reset==='day'){echo " selected";} ?>>Every day</option >
            <option value="week" <?php if(isset($trigger)&& $trigger->trig_reset==='week'){echo " selected";} ?>>Every week</option >
            <option value="month" <?php if(isset($trigger)&& $trigger->trig_reset==='month'){echo " selected";} ?>>Every month</option >
            <option value="year" <?php if(isset($trigger)&& $trigger->trig_reset==='year'){echo " selected";} ?>>Every year</option >
        </select>


    <div class="btns">
        <input type="hidden" value="<?php if(isset($trigger)){echo $trigger->trig_id;}?>" name="data[trig_id]">
        <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
        <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
        <input type="button" class="buttom1" onclick="window.location.href='triggeradd.php?admin&triggeradd'" value="New">


