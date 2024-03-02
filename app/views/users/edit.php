<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('edit_success'); ?>
                <h2 class="card-text">Edit Account</h2>
            <p class="card-text">Please Fill out This form to edit your Account</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="<?php echo URLROOT ;?>/users/edit">
                    <div class="form-group">
                        <label for="name">Name<sub>*</sub></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['name_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="current_password">Current password<sub>*</sub></label>
                        <input type="password" name="current_password" class="form-control form-control-lg <?php echo (!empty($data['current_password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['current_password'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['current_password_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password<sub>*</sub></label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['confirm_password'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ;?> </span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="estado" id="estado" <?php echo ($data['estado']) ? 'checked' : '' ;?>>
                        <label class="form-check-label" for="flexCheckChecked">
                            Active
                        </label>
                        </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Save">
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>