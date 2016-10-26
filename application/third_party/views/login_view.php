<?php $this->load->view('sections/head_html'); ?>
<body>
    <div class="row">
        <div class="large-5 columns">
            <fieldset>
                <legend>Autentica</legend>
                <?php echo validation_errors(); ?>
                <?php
//    verifylogin
                echo form_open('#', 'data-abide');
                ?>
                <div class="username">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="" required pattern="[a-zA-Z]+"  />
                    <small class="error">Username is required and must be a string.</small>
                </div>
                <div class="passowrd">
                    <label for="password">Password:</label>
                    <input type="password" id="passowrd" name="password" value=""  required pattern="[a-zA-Z]+"   />
                    <small class="error">Password is required and must be a string.</small>
                </div>
                <input class="button" type="submit" value="Login"/>
                </form>
            </fieldset>
        </div>
    </div>
    <?php $this->load->view('sections/footer_scripts'); ?>
    <?php // $this->output->enable_profiler(TRUE); ?>