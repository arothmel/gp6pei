<?php /* Begin sample webform mail message file */ ?>
<?php global $user?>
Submitted on: <?php echo format_date(time(), 'small')  . "\n" ?>
Submitted by: <?php echo $user->name . " " . $_SERVER['REMOTE_ADDR'] . "\n"?>
  
------------------------------------------------------------------------
  
Candidate Name: <?php echo $form_values['submitted_tree']['nominee_name'] . "\n"  ?>
  
------------------------------------------------------------------------
  
Riding: <?php echo $form_values['submitted_tree']['riding'] . "\n"  ?>
  
------------------------------------------------------------------------
  
EDA? <?php echo $form_values['submitted_tree']['nominee_type'] . "\n"  ?>
  
------------------------------------------------------------------------
  
Application Notes: <?php echo "\n\n"?>
  
<?php echo $form_values['submitted_tree']['application_notes'] . "\n"  ?>
  
------------------------------------------------------------------------
  
Internet Search Notes: <?php echo "\n\n"?>
  
<?php echo $form_values['submitted_tree']['internet_search_results'] . "\n"  ?>
  
------------------------------------------------------------------------
  
Organizer Comments: <?php echo "\n\n"?>
  
<?php echo $form_values['submitted_tree']['organizer_comments'] . "\n"  ?>
  
------------------------------------------------------------------------
  
Biography: <?php echo "\n\n"?>
  
<?php echo $form_values['submitted_tree']['biography']  . "\n" ?>
  
  
------------------------------------------------------------------------
  
  <?php //print_r($form_values) ?>