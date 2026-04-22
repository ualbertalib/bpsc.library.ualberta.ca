<h2><?php echo lang('login_heading');?></h2>
<p><?php echo lang('login_subheading');?></p>
  <?php if($this->session->flashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
          $.jGrowl.defaults.position = 'top-left';
           $.jGrowl("<?php echo $this->session->flashdata('message') ?>");  
          });
         </script>
      <?php endif?>


<div class="row-fluid">
    <div class="span12">
<?php echo form_open("auth/login");?>

 <div class="row-fluid">
    <div class="span3 labels">
  <?php echo lang('login_identity_label', 'identity');?>
     </div>
    <div class="span9">
  <?php echo form_input($identity);?>
</div>
</div>
     <div class="row-fluid">
    <div class="span3 labels">
   <?php echo lang('login_password_label', 'password');?>
     </div>
    <div class="span9">
  <?php echo form_input($password);?>
</div>
</div>
 <div class="row-fluid rem">
    <div class="span3 ">
     
     </div>
    <div class="span9 ">
    <input type="submit" name="submit" value="Login" class="myButton" id="submit"/> 
</div>
</div>
 <div class="row-fluid rem">
    <div class="span3 ">
    
     </div>
    <div class="span9 ">
   
 <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  <?php echo lang('login_remember_label', 'remember');?>
</div>
</div>
 
  <div class="row-fluid">
    <div class="span3">
     </div>
    <div class="span9">
 <a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
</div>
</div>
<?php echo form_close();?>

</div>
</div>
