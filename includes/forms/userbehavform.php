<fieldset>
    <legend></legend>
    <label> User:</label><br>
    <input type="text" class="txtbx" name="data[behav_nm]" required maxlength="200" value="<?php if(isset($behavior)){echo $user->full_long_name($usr_id);} ?>"><br>
    <label> Note:</label><br>
    <textarea class="txtarea" name="data[note]" requilred><?php if(isset($userbehav)){echo strip_tags(trim($userbehav->note));} ?> </textarea><br>
    <label> Triggers:</label>

    <div class="btns">
        <input type="hidden" value="<?php if(isset($userbehav)){echo $userbehav->usrbhv_id;}?>" name="data[usrbhv_id]">
        <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
        <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
        <input type="button" class="buttom1" onclick="window.location.href='userbehavadd.php?admin&userbehavadd'" value="New">


