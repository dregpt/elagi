<fieldset>
    <legend></legend>
    <label> Name:</label><br>
    <input type="text" class="txtbx" name="data[behav_nm]" required maxlength="200" value="<?php if(isset($behavior)){echo $behavior->behav_nm;} ?>"><br>
    <label> Details:</label><br>
    <textarea class="txtarea" name="data[detail]" requilred><?php if(isset($behavior)){echo strip_tags(trim($behavior->detail));} ?> </textarea><br>
    <label> Triggers:</label>
    <div class="smalldatalist">
    <?php
    if(isset($behavior)){
        $trigs_array= explode(",",$behavior->trigs);
        triggers_rec_options($trigs_array);
    }else{
        triggers_options();
    }

    ?>
    </div>


    <div class="btns">
        <input type="hidden" value="<?php if(isset($behavior)){echo $behavior->behav_id;}?>" name="data[behav_id]">
        <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
        <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
        <input type="button" class="buttom1" onclick="window.location.href='behavioradd.php?admin&behavioradd'" value="New">


